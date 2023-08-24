<?php

namespace App\Interfaces\RayEmp;

interface RayRepositoryInterface
{
    public function index();
    public function completedRays();
    public function edit($id);
    public function update($request,$id);
    public function show($id);
}
