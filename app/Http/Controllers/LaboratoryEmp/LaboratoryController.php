<?php

namespace App\Http\Controllers\LaboratoryEmp;

use App\Http\Controllers\Controller;
use App\Interfaces\LaboratoryEmp\LaboratoryRepositoryInterface;
use App\Http\Requests\LaboratoryEmp\LaboratoryRequest;

class LaboratoryController extends Controller
{
    
    private $laboratory;

    public function __construct(LaboratoryRepositoryInterface $laboratory)
    {
        $this->laboratory = $laboratory;
    }

    public function index()
    {
        return $this->laboratory->index();
    }

    public function completedLabs()
    {
        return $this->laboratory->completedLabs();
    }

    public function edit($id)
    {
        return $this->laboratory->edit($id);
    }

    public function show($id)
    {
        return $this->laboratory->show($id);
    }

    public function update(LaboratoryRequest $request, $id)
    {
        return $this->laboratory->update($request,$id);
    }

}
