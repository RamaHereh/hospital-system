<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\Admin\RayEmpRepositoryInterface;
use App\Http\Requests\Admin\RayEmpRequest;

class RayEmpController extends Controller
{
    private $rayEmployee;

    public function __construct(RayEmpRepositoryInterface $rayEmployee)
    {
        $this->rayEmployee = $rayEmployee;
    }

    public function index()
    {
        return $this->rayEmployee->index();
    }

    public function store(RayEmpRequest $request)
    {
        return $this->rayEmployee->store($request);
    }

    public function update(RayEmpRequest $request, $id)
    {
        return $this->rayEmployee->update($request,$id);
    }

    public function destroy($id)
    {
        return $this->rayEmployee->destroy($id);
    }
}
