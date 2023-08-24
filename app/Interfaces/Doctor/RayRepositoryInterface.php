<?php

namespace App\Interfaces\Doctor;

interface RayRepositoryInterface
{
    public function store($request);

    public function update($request,$id);

    public function show($id);

    public function destroy($id);
}
