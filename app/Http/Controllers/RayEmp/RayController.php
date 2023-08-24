<?php

namespace App\Http\Controllers\RayEmp;

use App\Http\Controllers\Controller;
use App\Interfaces\RayEmp\RayRepositoryInterface;
use App\Http\Requests\RayEmp\RayRequest;

class RayController extends Controller
{

    private $ray;

    public function __construct(RayRepositoryInterface $ray)
    {
        $this->ray = $ray;
    }

    public function index()
    {
       return $this->ray->index();
    }

    public function completedRays()
    {
        return $this->ray->completedRays();
    }

    public function edit($id)
    {
        return $this->ray->edit($id);
    }

    public function show($id)
    {
        return $this->ray->show($id);
    }

    public function update(RayRequest $request, $id)
    {
        return $this->ray->update($request,$id);
    }

}
