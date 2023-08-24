<?php

namespace App\Http\Controllers\Admin\Services;

use App\Http\Controllers\Controller;
use App\Interfaces\Admin\Services\InsuranceRepositoryInterface;
use App\Http\Requests\Admin\Services\InsuranceRequest;

class InsuranceController extends Controller
{

    private $insurance;

    public function __construct(InsuranceRepositoryInterface $insurance)
    {
        $this->insurance = $insurance;
    }

    public function index()
    {
        return $this->insurance->index();
    }

    public function create()
    {
        return $this->insurance->create();
    }

    public function store(InsuranceRequest $request)
    {
        return $this->insurance->store($request);
    }

    public function edit($id)
    {
        return $this->insurance->edit($id);
    }

    public function update(InsuranceRequest $request, $id)
    {
        return $this->insurance->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->insurance->destroy($id);
    }
}

