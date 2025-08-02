        <div class="form-group mb-3">
            <label for="name">Category Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $category->name) }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="parent_id">Parent Category</label>
            <select name="parent_id" id="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
                <option value="">Primary Category</option>
                @foreach ($parents as $parent)
                    <option value="{{ $parent->id }}"
                        {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>
                        {{ $parent->name }}
                    </option>
                @endforeach
            </select>
            @error('parent_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $category->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="image">Image</label>
            <input type="file" name="image" id="image"
                class="form-control @error('image') is-invalid @enderror accept='image/*'">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if (isset($category->image))
                <div class="mx-5 mt-3">
                    <img src="{{ asset('storage/' . $category->image) }}" height="60">

                </div>
            @endif
        </div>

        <div class="form-group mb-3">
            <label for="status">Status</label>
            <div class="mt-2">
                <div class="form-check form-check-inline">

                    <input type="radio" class="form-check-input @error('status') is-invalid @enderror" name="status"
                        value="active" {{ old('status', $category->status) == 'active' ? 'checked' : '' }}
                        id="status-active">

                    <label class="form-check-label" for="status-active">Active</label>
                </div>
                <div class="form-check form-check-inline">

                    <input type="radio" class="form-check-input @error('status') is-invalid @enderror" name="status"
                        value="archived" {{ old('status', $category->status) == 'archived' ? 'checked' : '' }}
                        id="status-archived">

                    <label class="form-check-label" for="status-archived">Archived</label>
                </div>
                @error('status')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror

            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">{{ $button_lable ?? 'Save' }}</button>
            </div>
        </div>
