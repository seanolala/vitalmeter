<?php

namespace App\Http\Controllers\Vital;

use App\Http\Controllers\ApiBaseController;
use Illuminate\Http\Request;
use App\Repositories\GlucoseVitalRepository;

class GlucoseVitalController extends ApiBaseController {
    
    /**
     * @var GlucoseVitalRepository
     *
     */
    protected $glucoseVitalRepository;

    
    /**
     * GlucoseVitalController constructor.
     * @param GlucoseVitalRepository $glucoseVitalRepository
     */
    public function __construct(GlucoseVitalRepository $glucoseVitalRepository)
    {
        $this->glucoseVitalRepository = $glucoseVitalRepository;
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $success = true;
        $msg = 'Get glucsoe vital list successfully';
        $vital = $this->glucoseVitalRepository->getAll();
                    
        if(empty($vital)) {
            $success = false;
            $msg = 'Glucose vital list is empty';
        }
            
        return parent::standardResponseStrut(
            $success,$msg,$vital
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
        $msg = 'Get glucsoe vital successfully';
        $vital = $this->glucoseVitalRepository->getById($id);
        
        if(empty($vital)) {
            $success = false;
            $msg = 'Glucose vital with id ['.$id.'] not found';
        }
        
        return parent::standardResponseStrut(
            $success,$msg,$vital
        );
    }
}