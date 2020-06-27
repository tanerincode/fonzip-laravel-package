<?php


namespace TanerInCode\Fonzip\Support\Facades;


use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

trait Requester
{
    public $base_url;
    public $options;
    public $client;

    public function setter(bool $verify = true)
    {
        //https://fonzip.com/api/v1-1/dokuman
        $this->base_url = config('fonzip.base_url');
        $this->options = [
            "headers" => [
                'Content-type' => 'application/json',
                'Accept'       => 'application/json',
                'APPKEY'       => config('fonzip.application_key'),
            ],
            "verify"  => $verify,
            "debug"   => false
        ];
    }

    public function sendRequest(string $endpoint = null, bool $verify = false, array $form_params = [], string $method = "POST")
    {
        $this->setter($verify);

        $this->options[RequestOptions::JSON] = $form_params;

        self::LogGenerator(2, $form_params);

        try {

            $client = new Client([
                "base_uri" => $this->base_url,
            ]);

        $result = $client->request($method, $endpoint, $this->options);
        $response = json_decode($result->getBody()->getContents(), true);
        self::logGenerator(2, $response);

        return $response;

        }catch (\Exception $exception){

            self::logGenerator(1, [
                'message' => $exception->getMessage(),
                'code' => $exception->getCode(),
                'user' => (Auth::check()) ? Auth::id() : null,
                'endpoint' => $endpoint
            ]);

            return [
                'success' => false,
                'code' => $exception->getCode(),
                'type' => 'guzzle_exception',
                'message' => $exception->getMessage()
            ];
        }

    }

    public function logGenerator( int $type = 1, array $form_params = []): void
    {
        $logData = $form_params;
        if(isset($logData['cc_no'])){
            $logData['cc_no'] = "****-****-****-".(substr($logData['cc_no'], -4));
            $logData['cvv'] = "***";
        }

        if ( config('fonzip.logging') == 'cloudwatch' && $type == 1)
        {
            Log::channel(config('fonzip.error_log_channel'))->info('fonzip_payment : error_log', [
                'data' => $logData
            ]);

        } else {
            Log::info('fonzip_payment :', [
                'data' => $logData
            ]);
        }

    }
}
