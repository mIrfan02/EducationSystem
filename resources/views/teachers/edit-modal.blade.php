<div class="modal fade" id="editTeacherModal{{ $teacher->id }}" tabindex="-1" aria-labelledby="editTeacherModalLabel{{ $teacher->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTeacherModalLabel{{ $teacher->id }}">Edit Teacher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('teachers.update', $teacher->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="teacherFirstName{{ $teacher->id }}" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="teacherFirstName{{ $teacher->id }}" name="first_name" value="{{ $teacher->first_name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="teacherLastName{{ $teacher->id }}" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="teacherLastName{{ $teacher->id }}" name="last_name" value="{{ $teacher->last_name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="teacherContactNo{{ $teacher->id }}" class="form-label">Contact No</label>
                        <input type="text" class="form-control" id="teacherContactNo{{ $teacher->id }}" name="contact_no" value="{{ $teacher->contact_no }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="teacherName{{ $teacher->id }}" class="form-label">Name</label>
                        <input type="text" class="form-control" id="teacherName{{ $teacher->id }}" name="name" value="{{ $teacher->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="teacherEmail{{ $teacher->id }}" class="form-label">Email</label>
                        <input type="email" class="form-control" id="teacherEmail{{ $teacher->id }}" name="email" value="{{ $teacher->email }}" required>
                    </div>
                    <!-- Password fields can be omitted if not changing password -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Teacher</button>
                </div>
            </form>
        </div>
    </div>
</div>
