<!-- Edit Modal -->
<div class="modal fade" id="editTeachCourseModal{{ $course->pivot->id }}" tabindex="-1" aria-labelledby="editTeachCourseModalLabel{{ $course->pivot->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTeachCourseModalLabel{{ $course->pivot->id }}">Edit Assigned Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('teacher.courses.update', ['teacher' => $teacher->id, 'pivot_id' => $course->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="courseSelect" class="form-label">Select Course</label>
                        <select class="form-select" id="courseSelect" name="course_id" required>
                            @foreach ($courses as $c)
                            <option value="{{ $c->id }}" @if ($c->id == $course->id) selected @endif>{{ $c->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
