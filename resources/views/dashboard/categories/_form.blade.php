        <div class="form-group mb-3">
            <x-form.input :value="$category->name" lable="Category Name" />
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
            <x-form.textarea lable="Description" name="description" :value="$category->description" />
        </div>

        <div class="form-group mb-3">
            <x-form.input lable="Image" name="image" type="file" accept='image/*' />

            @if (isset($category->image))
                <div class="mx-5 mt-3">
                    <img src="{{ asset('storage/' . $category->image) }}" height="60">
                </div>
            @endif
        </div>

        <div class="form-group mb-3">
            <div class="mt-2">
                <x-form.radio lable="Status" name="status" :options="['active' => 'Active', 'archived' => 'Archived']" :value="$category->status" />
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">{{ $button_lable ?? 'Save' }}</button>
            </div>
        </div>
