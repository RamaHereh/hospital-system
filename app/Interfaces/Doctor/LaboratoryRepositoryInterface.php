<?php

namespace App\Interfaces\Doctor;

interface LaboratoryRepositoryInterface
{
    public function store($request);

    public function update($request,$id);

    public function show($id);

    public function destroy($id);
}
