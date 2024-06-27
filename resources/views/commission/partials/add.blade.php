<div class="modal fade" id="addCommissionModal" tabindex="-1" aria-labelledby="addCommissionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCommissionModalLabel">Add Commission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('commissions.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="rate" class="form-label">Commission Rate</label>
                        <input type="number" class="form-control" id="rate" name="rate" step="0.01"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="rate" class="form-label">Session Fee</label>
                        <input type="number" class="form-control" id="rate" name="session_fee" required>
                    </div>
                    <div class="mb-3">
                        <label for="course_id" class="form-label">Teachers</label>
                        <select class="form-select" id="course_id" name="teacher_id" required>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}">
                                    {{ $teacher->first_name . ' ' . $teacher->first_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
