<?php

namespace App\Http\Controllers\Admin\Services;

use App\Http\Controllers\Controller;
use App\Interfaces\Admin\Services\AmbulanceRepositoryInterface;
use App\Http\Requests\Admin\Services\AmbulanceRequest;

class AmbulanceController extends Controller
{

    private $ambulance;

    public function __construct(AmbulanceRepositoryInterface $ambulance)
    {
        $this->ambulance = $ambulance;
    }

    public function index()
    {
        return $this->ambulance->index();
    }

    public function create()
    {
        return $this->ambulance->create();
    }

    public function store(AmbulanceRequest $request)
    {
        return $this->ambulance->store($request);
    }

    public function edit($id){

        return $this->ambulance->edit($id);
    }

    public function update(AmbulanceRequest $request, $id)
    {
       return $this->ambulance->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->ambulance->destroy($id);
    }
}
