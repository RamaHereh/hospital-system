<!-- Modal -->
<div class="modal fade" id="edit{{ $individualService->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('Services.edit_Service')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('individual_services.update', $individualService) }}" method="post">
                {{ method_field('patch') }}
                {{ csrf_field() }}
                @csrf
                <div class="modal-body">
                    <label for="name">{{trans('Services.name')}}</label>
                    <input type="text" name="name" id="name" value="{{$individualService->name}}" class="form-control"><br>

                    <input type="hidden" name="id" value="{{$individualService->id}}" class="form-control"><br>

                    <label for="price">{{trans('Services.price')}}</label>
                    <input type="number" name="price" id="price" value="{{$individualService->price}}" class="form-control"><br>

                    <label for="description">{{trans('Services.description')}}</label>
                    <textarea class="form-control" name="description" id="description" rows="5">{{$individualService->description}}</textarea>

                    <div class="form-group">
                        <label for="status">{{trans('doctors.Status')}}</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="{{$individualService->status}}" selected>{{$individualService->status == 1 ? trans('doctors.Enabled'):trans('doctors.Not_enabled')}}</option>
                            <option value="1">{{trans('doctors.Enabled')}}</option>
                            <option value="0">{{trans('doctors.Not_enabled')}}</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('dashboard/sections_trans.Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{trans('dashboard/sections_trans.submit')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
