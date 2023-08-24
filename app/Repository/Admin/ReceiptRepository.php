<?php


namespace App\Repository\Admin;


use App\Interfaces\Admin\ReceiptRepositoryInterface;
use App\Models\CashAccount;
use App\Models\Patient;
use App\Models\DebtAccount;
use App\Models\Receipt;
use Illuminate\Support\Facades\DB;

class ReceiptRepository implements ReceiptRepositoryInterface
{

    public function index()
    {
        $receipts =  Receipt::all();
        return view('dashboard.admin.receipts.index',compact('receipts'));
    }

    public function create()
    {
        $debtAccounts = DebtAccount::all();
        return view('dashboard.admin.receipts.create',compact('debtAccounts'));
    }

    public function show($id)
    {
        $receipt = Receipt::findorfail($id);
        return view('dashboard.admin.receipts.print',compact('receipt'));
    }

    public function store($request)
    {
        DB::beginTransaction();

        try{
            $receiptAccount = new Receipt();
            $receiptAccount->date =date('y-m-d');
            $receiptAccount->patient_id = $request->patient_id;
            $receiptAccount->amount = $request->amount;
            $receiptAccount->description = $request->description;
            $receiptAccount->save();
           
            $cashAccount = new CashAccount();
            $cashAccount->date =date('y-m-d');
            $cashAccount->receipt_id = $receiptAccount->id;
            $cashAccount->patient_id = $receiptAccount->patient_id;
            $cashAccount->amount = $request->amount;
            $cashAccount->save();
            
            DebtAccount::where('patient_id', $request->patient_id)
            ->update(['amount' => DB::raw('amount - ' . $request->amount)]);
        
            DB::commit();
            session()->flash('add');
            return redirect()->route('receipts.index');
        }

        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function edit($id)
    {
        $receipt = Receipt::findorfail($id);
        $patients = Patient::all();
        return view('dashboard.admin.receipts.edit',compact('receipt','patients'));
    }

    public function update($request)
    {
        DB::beginTransaction();

        try{

            $receiptAccount = Receipt::findorfail($request->id);
            $oldAccount = $receiptAccount->amount;

            $receiptAccount->date =date('y-m-d');
            $receiptAccount->patient_id = $request->patient_id;
            $receiptAccount->amount = $request->amount;
            $receiptAccount->description = $request->description;
            $receiptAccount->save();

            $cashAccount = CashAccount::where('receipt_id',$request->id)->first();
            $cashAccount->date =date('y-m-d');
            $cashAccount->receipt_id = $receiptAccount->id;
            $cashAccount->patient_id = $receiptAccount->patient_id;
            $cashAccount->amount = $request->amount;
            $cashAccount->save();
            
            DebtAccount::where('patient_id', $request->patient_id)
            ->update([
                'amount' => DB::raw('amount + ' . $oldAccount . ' - ' . $request->amount)
            ]);

            DB::commit();
            session()->flash('edit');
            return redirect()->route('receipts.index');
        }

        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $receipt =  Receipt::findorfail($id);
            $oldAccount = $receipt->amount;
            DebtAccount::where('patient_id', $receipt->patient_id)
            ->update([
                'amount' => DB::raw('amount + ' . $oldAccount )
            ]);
            $receipt->delete();
            
            session()->flash('delete');
            return redirect()->back();
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
