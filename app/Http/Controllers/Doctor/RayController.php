<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Interfaces\Doctor\RayRepositoryInterface;
use App\Http\Requests\Doctor\RayRequest ;

class RayController extends Controller
{
    private $ray;

    public function __construct(RayRepositoryInterface $ray)
    {
        $this->ray = $ray;
    }

    public function store(RayRequest $request)
    {
        return $this->ray->store($request);
    }

    public function update(RayRequest $request, $id)
    {
        return $this->ray->update($request,$id);
    }

    public function show($id)
    {
        return $this->ray->show($id);
    }

    public function destroy($id)
    {
        return $this->ray->destroy($id);
    }
}
