<?php

namespace App\Http\Controllers\Admin\Services;

use App\Http\Controllers\Controller;
use App\Interfaces\Admin\Services\IndividualRepositoryInterface;
use App\Http\Requests\Admin\Services\IndividualRequest;

class IndividualController extends Controller
{

    private $individual;

    public function __construct(IndividualRepositoryInterface $individual)
    {
        $this->individual = $individual;
    }

    public function index()
    {
     return $this->individual->index();
    }

    public function store(IndividualRequest $request)
    {
        return $this->individual->store($request);
    }

    public function update(IndividualRequest $request, $id)
    {
       return $this->individual->update($request, $id);

    }

    public function destroy($id)
    {
        return $this->individual->destroy($id);
    }
}
