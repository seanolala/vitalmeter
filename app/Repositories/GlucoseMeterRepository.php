<?php

namespace App\Repositories;

use App\Model\GlucoseMeter;

class GlucoseMeterRepository {
    
    protected $glucoseMeter;
    
    public function __construct(GlucoseMeter $glucoseMeter) {
        $this->glucoseMeter = $glucoseMeter;
    }
    
}