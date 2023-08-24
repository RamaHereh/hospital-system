<?php

namespace App\Interfaces\Admin;

interface LaboratoryEmpRepositoryInterface
{
    public function index();

    public function store($request);

    public function update($request,$id);

    public function destroy($id);
}
