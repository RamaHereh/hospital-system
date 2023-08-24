<?php


namespace App\Interfaces\Admin\Services;


interface AmbulanceRepositoryInterface
{
    // Get Ambulance data
    public function index();
    // show form add
    public function create();
    //insert data
    public function store($request);
    //show form edit
    public function edit($id);
    //update data
    public function update($request, $id);
    //delete data
    public function destroy($id);

}
