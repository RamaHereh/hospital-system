<?php

namespace App\Interfaces\LaboratoryEmp;

interface LaboratoryRepositoryInterface
{
    public function index();

    public function completedLabs();

    public function edit($id);

    public function update($request,$id);
    
    public function show($id);
}
