<div class="modal fade" id="editCommissionModal-{{ $commission->id }}" tabindex="-1"
    aria-labelledby="editCommissionModalLabel-{{ $commission->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCommissionModalLabel-{{ $commission->id }}">Edit Commission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('commissions.update', $commission->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit-rate-{{ $commission->id }}" class="form-label">Commission Rate</label>
                        <input type="number" class="form-control" id="edit-rate-{{ $commission->id }}" name="rate"
                            value="{{ $commission->rate }}" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-session_fee-{{ $commission->id }}" class="form-label">Session Fee</label>
                        <input type="number" class="form-control" id="edit-session_fee-{{ $commission->id }}"
                            name="session_fee" value="{{ $commission->session_fee }}" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-course_id-{{ $commission->id }}" class="form-label">Course</label>
                        <select class="form-select" id="edit-course_id-{{ $commission->id }}" name="course_id"
                            required>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}"
                                    {{ $course->id == $commission->course_id ? 'selected' : '' }}>{{ $course->title }}
                                </option>
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
