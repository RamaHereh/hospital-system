<?php

namespace App\Interfaces\Doctor;

interface DiagnosisRepositoryInterface
{
    public function store($request);

    public function addReview($request);

    public function show($id);
    
}
