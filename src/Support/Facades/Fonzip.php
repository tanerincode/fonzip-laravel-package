<?php


namespace TanerInCode\Fonzip\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static sendPayment(array $request)
 */
class Fonzip extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Fonzip';
    }
}
