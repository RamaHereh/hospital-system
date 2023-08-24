<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Interfaces\Doctor\LaboratoryRepositoryInterface;
use App\Http\Requests\Doctor\LaboratoryRequest ;

class LaboratoryController extends Controller
{
    private $laboratory;

    public function __construct(LaboratoryRepositoryInterface $laboratory)
    {
        $this->laboratory = $laboratory;
    }

    public function store(LaboratoryRequest $request)
    {
        return $this->laboratory->store($request);
    }

    public function update(LaboratoryRequest $request, $id)
    {
        return $this->laboratory->update($request,$id);
    }

    public function show($id)
    {
        return $this->laboratory->show($id);
    }

    public function destroy($id)
    {
        return $this->laboratory->destroy($id);
    }
}
