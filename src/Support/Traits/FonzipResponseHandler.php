<?php


namespace TanerInCode\Fonzip\Support\Traits;


trait FonzipResponseHandler
{
    public function handleResponse(int $type = 1, array $data = [])
    {
        if ( $this == 1 ){
            return self::generateErrorResponse($data);
        }

        return [
            'success' => 200,
            ''
        ];
    }

    private function generateErrorResponse($data)
    {
        return response()->json([
            'success' => false,
            'code' => 400,
            'type' => 'bad_request',
            'message' => trans('fonzip:errors.validation_error'),
            'data' => $data
        ], 200);
    }
}
