<div class="modal fade" id="editModal{{ $category->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $category->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $category->id }}">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="editCategoryName{{ $category->id }}" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="editCategoryName{{ $category->id }}" name="name" value="{{ $category->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="editCategoryStatus{{ $category->id }}" class="form-label">Status</label>
                        <select class="form-control" id="editCategoryStatus{{ $category->id }}" name="status" required>
                            <option value="enabled" {{ $category->status == 'enabled' ? 'selected' : '' }}>Enabled</option>
                            <option value="disabled" {{ $category->status == 'disabled' ? 'selected' : '' }}>Disabled</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
