<?php
namespace App\Interfaces\Admin;


interface SectionRepositoryInterface
{

    public function index();

    public function store($request);

    public function update($request,$id);

    public function destroy($id);

    public function show($id);

}
