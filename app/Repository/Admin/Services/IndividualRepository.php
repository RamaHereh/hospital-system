<?php


namespace App\Repository\Admin\Services;

use App\Interfaces\Admin\Services\IndividualRepositoryInterface;
use App\Models\Individual;

class IndividualRepository implements IndividualRepositoryInterface
{

    public function index()
    {
        $individualServices = Individual::all();
        return view('dashboard.admin.services.individuals.index',compact('individualServices'));
    }

    public function store($request)
    {
        try {
            $individualService = new Individual();
            $individualService->name = $request->name;
            $individualService->price = $request->price;
            $individualService->description = $request->description;
            $individualService->status = 1;
            $individualService->save();

            session()->flash('add');
            return redirect()->route('individual_services.index');

        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request, $id)
    {
        try {

            $individualService = Individual::findOrFail($id);
            $individualService->name = $request->name;
            $individualService->price = $request->price;
            $individualService->description = $request->description;
            $individualService->status = $request->status;
            $individualService->save();

            session()->flash('edit');
            return redirect()->route('individual_services.index');

        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        Individual::destroy($id);
        session()->flash('delete');
        return redirect()->route('individual_services.index');
    }
}
