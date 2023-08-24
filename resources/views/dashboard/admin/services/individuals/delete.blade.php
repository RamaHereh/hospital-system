<!-- Modal -->
<div class="modal fade" id="delete{{ $individualService->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('Services.delete_Service')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('individual_services.destroy', $individualService) }}" method="post">
                {{ method_field('delete') }}
                {{ csrf_field() }}
            <div class="modal-body">
                <input type="hidden" name="id" value="{{ $individualService->id }}">
                <h5>{{trans('dashboard/sections_trans.Warning')}} </h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('dashboard/sections_trans.Close')}}</button>
                <button type="submit" class="btn btn-danger">{{trans('dashboard/sections_trans.submit')}}</button>
            </div>
            </form>
        </div>
    </div>
</div>