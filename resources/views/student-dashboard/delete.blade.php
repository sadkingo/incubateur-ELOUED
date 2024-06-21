<td>
    <div class="dropdown">
        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i>
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item"
               href="{{ route('dashboard.students.edit', $studentGroup->id) }}">
                <i class="bx bx-edit-alt me-2"></i>
                {{ trans('student.edit') }}
            </a>
            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
               data-bs-target="#deleteStudentModal{{ $studentGroup->id }}">
                <i class="bx bx-trash me-2"></i>
                {{ trans('student.delete') }}
            </a>
        </div>
    </div>
</td>

<!-- Delete Modal -->
<div class="modal fade" id="deleteStudentModal{{ $studentGroup->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteStudentModalLabel{{ $studentGroup->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteStudentModalLabel{{ $studentGroup->id }}">{{ trans('student.delete_confirmation') }}</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ trans('student.delete_confirmation') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trans('app.close') }}</button>
                <form action="{{ route('student.account.destroy', $studentGroup->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ trans('student.delete') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
