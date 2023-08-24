<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\Admin\SectionRepositoryInterface;
use App\Http\Requests\Admin\SectionRequest;

class SectionController extends Controller
{

    private $section;

    public function __construct(SectionRepositoryInterface $section)
    {
        $this->section = $section;
    }

    public function index()
    {
      return  $this->section->index();

    }

    public function show($id)
    {
       return $this->section->show($id);
    }

    public function store(SectionRequest $request)
    {
        return $this->section->store($request);
    }

    public function update(SectionRequest $request, $id)
    {
        return $this->section->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->section->destroy($id);
    }
}
