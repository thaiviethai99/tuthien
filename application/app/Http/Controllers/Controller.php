<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Contracts\Auth\Guard;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $urlHostApi='';
    public $urlHostPayment;
    public function __construct(){
        $this->urlHostApi=env('APP_URL_ORACLE');
        $this->urlHostPayment=env('APP_URL_PAYMENT');
    }
}
