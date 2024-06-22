@foreach($projects as $project)
    <!-- كود عرض المشروع -->

    <!-- نموذج تأكيد الحذف -->
    <div class="modal fade" id="deleteProjectModal{{ $project->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('student.project.destroy', $project->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id" value="{{ $project->id }}">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ trans('project.delete') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>{{ trans('project.delete_confirmation') }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{ trans('app.close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ trans('app.delete') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endforeach

