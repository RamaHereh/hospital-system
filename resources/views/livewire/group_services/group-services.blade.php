<div>

{{--    @if ($catchError)--}}
{{--        <div class="alert alert-danger" id="success-danger">--}}
{{--            <button type="button" class="close" data-dismiss="alert">x</button>--}}
{{--            {{ $catchError }}--}}
{{--        </div>--}}
{{--    @endif--}}

    @if ($serviceSaved)
        <div class="alert alert-info">تم حفظ البيانات بنجاح.</div>
    @endif

    @if ($serviceUpdated)
        <div class="alert alert-info">تم تعديل البيانات بنجاح.</div>
    @endif

    @if($showTable)
        @include('livewire.group_services.index')
    
    @else
         <form wire:submit.prevent="saveGroup" autocomplete="off">
            @csrf
            <div class="form-group">
                <label>اسم المجموعة</label>
                <input wire:model="nameGroup" type="text" class="form-control" required>
            </div>

            <div class="form-group">
                <label>ملاحظات</label>
                <textarea wire:model="notes" name="notes" class="form-control" rows="5"></textarea>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <div class="col-md-12">
                        <button class="btn btn-outline-primary"
                                wire:click.prevent="addService">إضافة خدمة فرعية
                        </button>
                    </div>
                </div>


                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr class="table-primary">
                                <th>اسم الخدمة</th>
                                <th width="200">العدد</th>
                                <th width="200">العمليات</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($groupItems as $index => $group_item)
                                <tr>
                                    <td>
                                        @if($group_item['is_saved'])
                                            <input type="hidden" name="groupItems[{{$index}}][service_id]"
                                                   wire:model="groupItems.{{$index}}.service_id"/>
                                            @if($group_item['service_name'] && $group_item['service_price'])
                                                {{ $group_item['service_name'] }}
                                                ({{ number_format($group_item['service_price'], 2) }})
                                            @endif
                                        @else
                                            <select name="groupItems[{{$index}}][service_id]"
                                                    class="form-control{{ $errors->has('groupItems.' . $index) ? ' is-invalid' : '' }}"
                                                    wire:model="groupItems.{{$index}}.service_id">
                                                <option value="">-- choose product --</option>
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}">
                                                    {{$service->name}}
                                                    ({{ number_format($service->price, 2) }})
                                                    </option>
                                                @endforeach
                                            </select>

                                            @if($errors->has('groupItems.' . $index))
                                                <em class="invalid-feedback">
                                                    {{ $errors->first('groupItems.' . $index) }}
                                                </em>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        @if($group_item['is_saved'])
                                            <input type="hidden" name="groupItems[{{$index}}][quantity]"
                                                   wire:model="groupItems.{{$index}}.quantity"/>
                                            {{ $group_item['quantity'] }}
                                        @else
                                            <input type="number" name="groupItems[{{$index}}][quantity]"
                                                   class="form-control" wire:model="groupItems.{{$index}}.quantity"/>
                                        @endif
                                    </td>
                                    <td>
                                        @if($group_item['is_saved'])
                                            <button class="btn btn-sm btn-primary"
                                                    wire:click.prevent="editService({{$index}})">
                                                تعديل
                                            </button>
                                        @elseif($group_item['service_id'])
                                            <button class="btn btn-sm btn-success mr-1"
                                                    wire:click.prevent="saveService({{$index}})">
                                                تاكيد
                                            </button>
                                        @endif
                                        <button class="btn btn-sm btn-danger"
                                                wire:click.prevent="removeService({{$index}})">حذف
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>


                    <div class="col-lg-4 ml-auto text-right">
                        <table class="table pull-right">
                            <tr>
                                <td style="color: red">الاجمالي</td>
                                <td>
                                  <input type="text"  class="form-control w-75 d-inline"
                                           wire:model="totalBeforeDiscount" readonly>
                                </td>
                            </tr>

                            <tr>
                                <td style="color: red">قيمة الخصم</td>
                                <td width="125">
                                    <input type="text" class="form-control w-75 d-inline"
                                           wire:model="discountValue">
                                </td>
                            </tr>

                            <tr>
                                <td style="color: red">الإجمالي بعد الخصم </td>
                                <td width="125">
                                    <input type="text"  class="form-control w-75 d-inline"
                                           wire:model="totalAfterDiscount" readonly>
                                           
                                </td>
                                
                            </tr>

                            <tr>
                                <td style="color: red">نسبة الضريبة</td>
                                <td>
                                    <input type="text" name="taxes" class="form-control w-75 d-inline" min="0"
                                           max="100" wire:model="taxes"> %
                                </td>
                            </tr>
                            <tr>
                                <td style="color: red">الإجمالي مع الضريبة</td>
                                <td>
                                <input type="text"  class="form-control w-75 d-inline"
                                           wire:model="totalWithTax" readonly>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <br/>
                    <div>
                        <input class="btn btn-outline-success" type="submit" value="تاكيد البيانات">
                    </div>
                </div>
            </div>

        </form>
    @endif


</div>

