<div class="modal fade" id="editSessionModal{{ $session->id }}" tabindex="-1"
    aria-labelledby="editSessionModalLabel{{ $session->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSessionModalLabel{{ $session->id }}">Edit Session</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('sessions.update', $session->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_date_{{ $session->id }}" class="form-label">Date</label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror"
                            id="edit_date_{{ $session->id }}" name="date" value="{{ old('date', $session->date) }}"
                            required>
                        @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="edit_start_time_{{ $session->id }}" class="form-label">Start Time</label>
                        <input type="time" class="form-control @error('start_time') is-invalid @enderror"
                            id="edit_start_time_{{ $session->id }}" name="start_time"
                            value="{{ old('start_time', $session->start_time) }}" required>
                        @error('start_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="edit_end_time_{{ $session->id }}" class="form-label">End Time</label>
                        <input type="time" class="form-control @error('end_time') is-invalid @enderror"
                            id="edit_end_time_{{ $session->id }}" name="end_time"
                            value="{{ old('end_time', $session->end_time) }}" required>
                        @error('end_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="edit_title_{{ $session->id }}" class="form-label">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                            id="edit_title_{{ $session->id }}" name="title"
                            value="{{ old('title', $session->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="edit_meeting_link_{{ $session->id }}" class="form-label">Meeting Link</label>
                        <input type="url" class="form-control @error('meeting_link') is-invalid @enderror"
                            id="edit_meeting_link_{{ $session->id }}" name="meeting_link"
                            value="{{ old('meeting_link', $session->meeting_link) }}" required>
                        @error('meeting_link')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    @php
                        use App\Models\Commission; // apne model ka path use karein

                        $teacherId = auth()->user()->id; // currently logged-in teacher ka ID
                        $sessionFee = Commission::where('teacher_id', $teacherId)->pluck('session_fee')->first(); // session_fee fetch karein
                    @endphp

                    <div class="mb-3" style="display: block;">
                        <label for="fee_per_hour" class="form-label">Fee/Hour In $</label>
                        <input type="number" step="0.01"
                            class="form-control @error('fee_per_hour') is-invalid @enderror" id="fee_per_hour"
                            name="fee_per_hour" value="{{ old('fee_per_hour', $sessionFee) }}">
                        @error('fee_per_hour')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="edit_session_type_{{ $session->id }}" class="form-label">Session Type</label>
                        <select class="form-select @error('session_type') is-invalid @enderror"
                            id="edit_session_type_{{ $session->id }}" name="session_type" required>
                            <option value="individual" {{ $session->session_type == 'individual' ? 'selected' : '' }}>
                                Individual</option>
                            <option value="group" {{ $session->session_type == 'group' ? 'selected' : '' }}>Group
                            </option>
                        </select>
                        @error('session_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <input type="hidden" name="teacher_id" value="{{ auth()->user()->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Session</button>
                </div>
            </form>
        </div>
    </div>
</div>
