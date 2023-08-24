<?php

namespace App\Interfaces\Admin;

interface DoctorRepositoryInterface
{
    public function index();

    public function create();

    public function store($request);

    public function update($request, $id);

    public function destroy($request);

    public function edit($id);

    public function updatePassword($request);

    public function updateStatus($request);

}
