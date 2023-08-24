<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\Admin\DoctorRepositoryInterface;
use App\Http\Requests\Admin\DoctorRequest ;
use Illuminate\Http\Request;

class DoctorController extends Controller
{

    private $doctor;

    public function __construct(DoctorRepositoryInterface $doctor)
    {
        $this->doctor = $doctor;
    }

    public function index()
    {
        return $this->doctor->index();
    }

    public function create()
    {
        return $this->doctor->create();
    }

    public function store(DoctorRequest  $request)
    {
        return $this->doctor->store($request);
    }

    public function edit($id)
    {
        return $this->doctor->edit($id);
    }

    public function update(DoctorRequest  $request, $id)
    {
        return $this->doctor->update($request, $id);
    }

    public function destroy(Request $request)
    {
        return $this->doctor->destroy($request);
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ]);

        return $this->doctor->updatePassword($request);
    }

    public function updateStatus(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|in:0,1',
        ]);
        return $this->doctor->updateStatus($request);
    }
}
