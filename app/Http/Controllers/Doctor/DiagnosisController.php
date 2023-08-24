<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Interfaces\Doctor\DiagnosisRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\Doctor\DiagnosisRequest ;

class DiagnosisController extends Controller
{
    private $diagnosis;

    public function __construct(DiagnosisRepositoryInterface $diagnosis)
    {
        $this->diagnosis = $diagnosis;
    }

    public function store(DiagnosisRequest $request)
    {
        return $this->diagnosis->store($request);
    }

    public function addReview (Request $request)
    {
        return $this->diagnosis->addReview($request);
    }

    public function show($id)
    {
        return $this->diagnosis->show($id);
    }

}
