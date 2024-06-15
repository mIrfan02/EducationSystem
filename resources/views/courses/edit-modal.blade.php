<div class="modal fade" id="editCourseModal{{ $course->id }}" tabindex="-1" aria-labelledby="editCourseModalLabel{{ $course->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCourseModalLabel{{ $course->id }}">Edit Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editCourseForm{{ $course->id }}" action="{{ route('courses.update', $course->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- Use PUT method for update -->
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editCourseTitle{{ $course->id }}" class="form-label">Course Title</label>
                        <input type="text" class="form-control" id="editCourseTitle{{ $course->id }}" name="title" value="{{ $course->title }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="editCategorySelect{{ $course->id }}" class="form-label">Category</label>
                        <select class="form-select" id="editCategorySelect{{ $course->id }}" name="category_id" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $course->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editCourseDescription{{ $course->id }}" class="form-label">Description</label>
                        <textarea class="form-control" id="editCourseDescription{{ $course->id }}" name="description" rows="3">{{ $course->description }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Course</button>
                </div>
            </form>
        </div>
    </div>
</div>
