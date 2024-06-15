<div class="modal fade" id="addCourseTeacher" tabindex="-1" aria-labelledby="addCourseTeacherLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCourseTeacherLabel">Assign Course to {{ $teacher->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="assignCourseForm" action="{{ route('assign-course', ['teacher' => $teacher->id]) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="courseSelect" class="form-label">Select Course</label>
                        <select class="form-select" id="courseSelect" name="course_id" required>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Assign Course</button>
                </div>
            </form>
        </div>
    </div>
</div>
