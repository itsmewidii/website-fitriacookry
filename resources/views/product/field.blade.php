<div class="card-body">
    <div class="row">

        <!-- Category Selection -->
        <div class="form-group col-md-6 fv-row mb-3">
            <label role="category" class="form-label fw-bolder text-dark fs-6">Kategori</label>
            <div class="position-relative mb-3">
                <select name="category_id" class="form-control form-control-lg form-control-solid">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }} !</p>
                @enderror
            </div>
        </div>

        <!-- Name Input -->
        <div class="form-group col-md-6 fv-row mb-3">
            <label role="name" class="form-label fw-bolder text-dark fs-6">Nama</label>
            <div class="position-relative mb-3">
                <input type="text" name="name" class="form-control form-control-lg form-control-solid"
                    autocomplete="off" value="{{ isset($data) ? $data->name : '' }}" placeholder="Input Name" />
                @error('name')
                    <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }} !</p>
                @enderror
            </div>
        </div>

        <!-- Price Input -->
        <div class="form-group col-md-6 fv-row mb-3">
            <label role="price" class="form-label fw-bolder text-dark fs-6">Harga</label>
            <div class="position-relative mb-3">
                <input type="number" name="price" class="form-control form-control-lg form-control-solid"
                    autocomplete="off" value="{{ isset($data) ? $data->price : '' }}" placeholder="Input Price" />
                @error('price')
                    <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }} !</p>
                @enderror
            </div>
        </div>

        <!-- Quantity Input -->
        <div class="form-group col-md-6 fv-row mb-3">
            <label role="qty" class="form-label fw-bolder text-dark fs-6">Jumlah</label>
            <div class="position-relative mb-3">
                <input type="number" name="qty" class="form-control form-control-lg form-control-solid"
                    autocomplete="off" value="{{ isset($data) ? $data->qty : '' }}" placeholder="Input Quantity" />
                @error('qty')
                    <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }} !</p>
                @enderror
            </div>
        </div>

        <!-- Status Input -->
        <div class="form-group col-md-6 fv-row mb-3">
            <label role="status" class="form-label fw-bolder text-dark fs-6">Status</label>
            <div class="position-relative mb-3">
                <select name="status" class="form-control form-control-lg form-control-solid">
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="non-active" {{ old('status') == 'non-active' ? 'selected' : '' }}>Non-active</option>
                </select>
                @error('status')
                    <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }} !</p>
                @enderror
            </div>
        </div>

        <!-- Image Upload Input -->
        <div class="form-group col-md-6 fv-row mb-3">
            <label role="image" class="form-label fw-bolder text-dark fs-6">Gambar Produk</label>
            <div class="position-relative mb-3">
                <input type="file" name="image" class="form-control form-control-lg form-control-solid" />
                @error('image')
                    <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }} !</p>
                @enderror
            </div>
        </div>

        <!-- Description Input -->
        <div class="form-group col-md-12 fv-row mb-3">
            <label role="description" class="form-label fw-bolder text-dark fs-6">Keterangan</label>
            <div class="position-relative mb-3">
                <textarea name="description" class="form-control form-control-lg form-control-solid mb-3" rows="4" placeholder="Input Description">{{ isset($data) ? $data->description : '' }}</textarea>
                @error('description')
                    <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }} !</p>
                @enderror
            </div>
        </div>

    </div>
</div>
<div class="card-footer d-flex justify-content-between">
    <a href="{{ route($route . 'index') }}" class="btn btn-secondary">Kembali</a>
    <button class="btn btn-primary mr-1" type="submit">Save</button>
</div>
