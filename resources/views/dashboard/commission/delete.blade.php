<!-- Modal -->
<div class="modal fade" id="deleteCommissionModal{{ $commission->id }}" tabindex="-1" aria-labelledby="deleteCommissionModalLabel{{ $commission->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCommissionModalLabel{{ $commission->id }}">{{ trans('commission.delete') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ trans('commission.confirm_delete') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trans('app.close') }}</button>
                <form action="{{ url('dashboard/commission/' . $commission->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ trans('app.delete') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>