        <div class="form-group mb-3">
            <x-form.input :value="$product->name ?? ''" lable="Product Name" />
        </div>

        <div class="form-group mb-3">
            <label for="category_id">Parent Category</label>
            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                <option value="">Primary Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{-- {{ old('category_id', $) == $category->id ? 'selected' : '' }} --}} @selected(old('category_id', $product->category->id ?? "") == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <x-form.textarea lable="Description" name="description" :value="$product->description ?? ''" />
        </div>

        <div class="form-group mb-3">
            <x-form.input lable="Image" name="image" type="file" accept='image/*' />

            @if (isset($product->image))
                <div class="mx-5 mt-3">
                    <img src="{{ asset('storage/' . $product->image) }}" height="60">
                </div>
            @endif
        </div>

        <div class="form-group mb-3">
            <x-form.input lable="Price" name="price" :value="$product->price ?? ''" />
        </div>
        <div class="form-group mb-3">
            <x-form.input lable="Compare Price" name="compare_price" :value="$product->compare_price ?? ''" />
        </div>
        <div class="form-group mb-3">
            <x-form.input lable="Tags" name="tags" :value="$tags ?? ''" />
        </div>


        <div class="form-group mb-3">
            <div class="my-4">
                <x-form.radio lable="status" name="status" :options="['active' => 'Active', 'drift' => 'Drift', 'archived' => 'Archived']" :value="$product->status ?? '' " />
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-primary">{{ $button_lable ?? 'Save' }}</button>
            </div>
        </div>

        @push('styles')
            <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
        @endpush
        @push('scripts')
            <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
            <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>

            <script>
                var inputElm = document.querySelector('[name=tags]'),
                    tagify = new Tagify(inputElm);
            </script>
        @endpush
