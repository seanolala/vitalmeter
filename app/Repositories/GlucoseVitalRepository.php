<?php

namespace App\Repositories;

use App\Model\GlucoseVital;

class GlucoseVitalRepository {
    
    protected $glucoseVital;
    
    public function __construct(GlucoseVital $glucoseVital) {
        $this->glucoseVital = $glucoseVital;
    }
    
    public function getAll() {
        $vital = $this->glucoseVital->all();
        if(is_null($vital)) {
            $vital = [];
        }
        
        return $vital;
    }
    
    public function getRecordTimeAfter($recordTimeAfter) {
        $vital = $this->glucoseVital
            ->where('record_time','>',$recordTimeAfter)
            ->get();
        
        if(is_null($vital)) {
            $vital = [];
        }
        
        return $vital;
    }
    
    public function getById($id) {
        $vital = $this->glucoseVital
            ->find($id);
        
        if(is_null($vital)) {
            $vital = [];
        }
        
        return $vital;
    }
}