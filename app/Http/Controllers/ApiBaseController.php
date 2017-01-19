<?php

namespace App\Http\Controllers;

use Input;
use Illuminate\Http\Request;

class ApiBaseController extends Controller {
    
    /**
     * Standard api response strcuture.
     *
     * @param  Boolean $success Api task is sucessful or not
     * @param  String $msg Message in detail
     * @param  Array $result Result for the api task
     * @return \Illuminate\Http\Response
     */
    static function standardResponseStrut($success,$msg,$result) {
        return response()->json([
            'success'=>$success,
            'msg'=>$msg,
            'result'=>$result
        ]); 
    }
}