<?php

namespace App\Interfaces\Admin;

interface RayEmpRepositoryInterface
{
    public function index();

    public function store($request);

    public function update($request,$id);

    public function destroy($id);

}
