<?php

namespace TanerInCode\Fonzip;
use TanerInCode\Fonzip\Classes\FonzipDataManager;

/**
 *  This is a Laravel package..
 *
 * Fonzip Payment Type laravel adaptation manager.
 *
 * This class is working on :
 *  - Payment Sending,
 *  - Response Handling,
 *  - Logging response exceptions or successfully scenario
 *  - Route Sharing
 * */
class Fonzip extends FonzipDataManager
{

    public function apiRoutes() {
        include ('./routes.php');
    }

}
