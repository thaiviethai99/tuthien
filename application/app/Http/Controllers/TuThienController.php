<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class TuThienController extends Controller
{
    public function home()
    {
    	return view('tuthien.home');
    }
}
