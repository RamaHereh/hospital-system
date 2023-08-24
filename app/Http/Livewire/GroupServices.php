<?php

namespace App\Http\Livewire;

use App\Models\Group;
use App\Models\Individual;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GroupServices extends Component
{
    public $showTable = true,$updateMode = false;
    public $serviceSaved = false, $serviceUpdated = false;
    public $nameGroup, $notes;
    public $totalBeforeDiscount,$discountValue=0 ,$totalAfterDiscount,$taxes=0 ,$totalWithTax;
    public $groupItems = [];
    public $services = [];
    public $groupId;
    public $showModal = false;

    public function mount()
    {
        $this->services = Individual::all();
    }

    public function render()
    {
       $total=0;
        foreach ($this->groupItems as $groupItem) {
            if ($groupItem['is_saved'] && $groupItem['service_price'] && $groupItem['quantity']) {
                $total += $groupItem['service_price'] * $groupItem['quantity'];
            }
        }
        $this->totalBeforeDiscount= $total ;
        $this->totalAfterDiscount = $this->totalBeforeDiscount - ((is_numeric($this->discountValue) ? $this->discountValue : 0));
        $this->totalWithTax = $this->totalAfterDiscount * (1 + (is_numeric($this->taxes) ? $this->taxes : 0) / 100);

        return view('livewire.group_services.group-services', [
            'groups'=>Group::all(),
        ]);

    }
 
    public function create(){

        $this->serviceUpdated = false;
        $this->serviceSaved = false;
        $this->showTable = false;

    }

    public function addService()
    {
        foreach ($this->groupItems as $key => $groupItem) {
            if (!$groupItem['is_saved']) {
                $this->addError('groupItems.' . $key, 'يجب حفظ هذا الخدمة قبل إنشاء خدمة جديدة.');
                return;
            }
        }

        $this->groupItems[] = [
            'service_id' => '',
            'quantity' => 1,
            'is_saved' => false,
            'service_name' => '',
            'service_price' => 0
        ];

        $this->serviceSaved = false;
    }

    public function editService($index)
    {
        foreach ($this->groupItems as $key => $groupItem) {
            if (!$groupItem['is_saved']) {
                $this->addError('groupItems.' . $key, 'This line must be saved before editing another.');
                return;
            }
        }

        $this->groupItems[$index]['is_saved'] = false;
    }


    public function saveService($index)
    {
        $this->resetErrorBag();
        $service = $this->services->find($this->groupItems[$index]['service_id']);
        $this->groupItems[$index]['service_name'] = $service->name;
        $this->groupItems[$index]['service_price'] = $service->price;
        $this->groupItems[$index]['is_saved'] = true;
    }

    public function removeService($index)
    {
        unset($this->groupItems[$index]);
        $this->groupItems = array_values($this->groupItems);
    }

    public function saveGroup()
    {

        if($this->updateMode){

            $groups = Group::find($this->groupId);
            $groups->total_before_discount = $this->totalBeforeDiscount;
            $groups->discount_value = $this->discountValue;
            $groups->total_after_discount = $this->totalAfterDiscount;
            $groups->tax_rate = $this->taxes;
            $groups->total_with_tax = $this->totalWithTax;
            $groups->name=$this->nameGroup;
            $groups->notes=$this->notes;
            $groups->save();
  
            $groups->services()->detach();
            foreach ($this->groupItems as $groupItem) {
                $groups->services()->attach($groupItem['service_id'],['quantity' => $groupItem['quantity']]);
            }

            $this->reset('groupItems', 'nameGroup', 'notes','discountValue','taxes');
            $this->serviceUpdated = true;
            $this->showTable = true;

        }

        else{

            $groups = new Group();
            $groups->total_before_discount = $this->totalBeforeDiscount;
            $groups->discount_value = $this->discountValue;
            $groups->total_after_discount = $this->totalAfterDiscount;
            $groups->tax_rate = $this->taxes;
            $groups->total_with_tax = $this->totalWithTax;
            $groups->name=$this->nameGroup;
            $groups->notes=$this->notes;
            $groups->save();

            foreach ($this->groupItems as $groupItem) {
                $groups->services()->attach($groupItem['service_id'],['quantity' => $groupItem['quantity']]);
            }

            $this->reset('groupItems', 'nameGroup', 'notes','discountValue','taxes');
            $this->serviceSaved = true;
            $this->showTable = true;

        }

    }

    public function edit($id)
    {
        $this->serviceSaved = false;
        $this->serviceUpdated = false;
        $this->showTable = false;
        $this->updateMode = true;

        $group = Group::where('id',$id)->first();
        $this->groupId = $id;

        $this->reset('groupItems', 'nameGroup', 'notes');
        $this->nameGroup=$group->name;
        $this->notes=$group->notes;

        $this->discountValue = intval($group->discount_value);
        $this->taxes = intval($group->tax_rate);
        $this->serviceSaved = false;

        foreach ($group->services as $serviceGroup)
        {
            $this->groupItems[] = [
                'service_id' => $serviceGroup->id,
                'quantity' => $serviceGroup->pivot->quantity,
                'is_saved' => true,
                'service_name' => $serviceGroup->name,
                'service_price' => $serviceGroup->price
            ];
        }
    }


    public function delete($id){
        Group::destroy($id);
        return redirect()->route('group_services');
    }

}
