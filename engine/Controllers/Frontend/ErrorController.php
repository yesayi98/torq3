<?php


namespace Controllers\Frontend;

use Core\Components\Controller;

class ErrorController extends Controller
{
    /**
     * @parameter leon|2
     * @parameter gago|3
     */
    public function index(){
        die('this is error controller');
    }

}