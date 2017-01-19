<?php

namespace App\Http\Controllers\Meter;

use App\Http\Controllers\ApiBaseController;
use Illuminate\Http\Request;
use App\Model\GlucoseMeter;

class GlucoseMeterController extends ApiBaseController {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $success = true;
        $msg = 'Get glucsoe meter list successfully';
        $meter = GlucoseMeter::all();
        
        return parent::standardResponseStrut(
            $success,$msg,$meter
        );
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $success = true;
        $msg = 'Get glucsoe meter successfully';
        $meter = GlucoseMeter::find($id);
        
        if(!$meter) {
            $success = false;
            $msg = 'Glucose meter with id ['.$id.'] not found';
            $meter = [];
        }
        
        return parent::standardResponseStrut(
            $success,$msg,$meter
        );
    }
    
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $success = true;
        $msg = 'Add glucsoe meter successfully';
        
        $meter = new GlucoseMeter;
        
        $payload = json_decode($request->getContent());
        $meter->location = $payload->location;
        $meter->provider = $payload->provider;
        
        if(!$meter->save()) {
            $success = false;
            $msg = 'Unable to add glucsoe meter';
        } 
        
        return parent::standardResponseStrut(
            $success,$msg,$meter
        );
    }

}