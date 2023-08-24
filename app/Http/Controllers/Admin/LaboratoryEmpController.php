<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\Admin\LaboratoryEmpRepositoryInterface;
use App\Http\Requests\Admin\LaboratoryEmpRequest;

class LaboratoryEmpController extends Controller
{

    private $laboratoryEmployee;

    public function __construct(LaboratoryEmpRepositoryInterface $laboratoryEmployee)
    {
        $this->laboratoryEmployee = $laboratoryEmployee;
    }

    public function index()
    {
        return $this->laboratoryEmployee->index();
    }

    public function store(LaboratoryEmpRequest $request)
    {
        return $this->laboratoryEmployee->store($request);
    }

    public function update(LaboratoryEmpRequest $request, $id)
    {
        return $this->laboratoryEmployee->update($request,$id);
    }

    public function destroy($id)
    {
        return $this->laboratoryEmployee->destroy($id);
    }
}
