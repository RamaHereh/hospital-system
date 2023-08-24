<?php


namespace App\Interfaces\Admin\Services;


interface IndividualRepositoryInterface
{

    // Get SingleServices
    public function index();

    // store SingleServices
    public function store($request);

    // update SingleServices
    public function update($request, $id);

    // destroy SingleServices
    public function destroy($id);


}
