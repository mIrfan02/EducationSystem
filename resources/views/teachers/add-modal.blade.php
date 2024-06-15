<div class="modal fade" id="addTeacherModal" tabindex="-1" aria-labelledby="addTeacherModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTeacherModalLabel">Add Teacher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('teachers.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="contact_no" class="form-label">Contact No</label>
                        <input type="text" class="form-control" id="contact_no" name="contact_no" value="{{ old('contact_no') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="teacherEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="teacherEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="teacherPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="teacherPassword" name="password" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Teacher</button>
                </div>
            </form>
        </div>
    </div>
</div>
