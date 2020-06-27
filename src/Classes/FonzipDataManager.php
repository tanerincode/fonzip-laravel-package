<?php


namespace TanerInCode\Fonzip\Classes;


use App\Models\Ngo;
use Illuminate\Support\Facades\Validator;
use TanerInCode\Fonzip\Models\Donation;
use TanerInCode\Fonzip\Support\Facades\Requester;
use TanerInCode\Fonzip\Support\Traits\FonzipResponseHandler;

class FonzipDataManager
{
    use FonzipResponseHandler, Requester;

    public function sendPayment(array $data)
    {
        $rules = [
            'payment_type'    => 'required',
            'secure'          => 'required',
            'cardholder_name' => 'required',
            'email'           => 'required',
            'gsm'             => 'required',
            'cc_no'           => 'required',
            'exp_month'       => 'required',
            'exp_year'        => 'required',
            'cvv'             => 'required',
            'amount'          => 'required',
            'ngo_id'          => 'required',
        ];

        $validator = Validator::make($data, $rules);
        if ( $validator->fails() )
        {
            return $this->handleResponse(1, (array) $validator->errors());
        }

        $creatingData = [
            'ngo_id'       => $data['ngo_id'],
            'name'         => $data['cardholder_name'],
            'gsm'          => $data['gsm'],
            'email'        => $data['email'],
            'user_message' => $data['message'],
            'amount'       => $data['amount'],
            'remember'     => isset($data['remember']) && $data['remember'] == "true" ? 1 : 0,
            'ips'          => ip2long(request()->ip()),
            'device'       => request()->userAgent(),
        ];

        $accessToken = self::getAccessToken($data['ngo_id']);
        if ( isset($accessToken['success']) && $accessToken['success'] == false ){
            return $this->handleResponse(1, $accessToken);
        }

        $data['access_token'] = $accessToken;
        $data = self::clearData($data);

        $result = $this->sendRequest('bagis/yap', isset($data['verify']) ? $data['verify'] : true, $data, 'POST');

        $creatingData['trace_id'] =  isset($result['trace_id']) ? $result['trace_id'] : null;
        $creatingData['result'] =  isset($result['result']) ? $result['result'] : null;
        $creatingData['message'] =  isset($result['message']) ? $result['message'] : null;

        Donation::create($creatingData);

        return $result;
    }

    public static function getAccessToken($ngo_id)
    {
        try {
            $ngo = Ngo::select('access_token')->where('id', $ngo_id)->first();
        }catch (\Exception $exception) {
            return ['success' => false, 'code' => $exception->getCode(), 'message' => $exception->getMessage()];
        }
        return !is_null($ngo) ? $ngo->access_token : false;
    }

    public function clearData(array $data)
    {
        return [
            "payment_type"    => 'cc',
            "secure"          => true,
            "access_token"    => $data['access_token'],
            "cardholder_name" => $data['cardholder_name'],
            "email"           => $data['email'],
            "cc_no"           => str_replace('-', '', str_replace(' ', '', $data['cc_no'])),
            "exp_month"       => trim($data['exp_month']),
            "exp_year"        => trim($data['exp_year']),
            "cvv"             => trim($data['cvv']),
            "amount"          => $data['amount'],
            "ip_address"      => request()->ip(),
            "remember"        => isset($data['remember']) && $data['remember'] == "true",
        ];
    }
}
