<div class="card-body">
    <div class="row">

        <!-- Name Input -->
        <div class="form-group col-md-12 fv-row mb-3">
            <label role="name" class="form-label fw-bolder text-dark fs-6">Nama</label>
            <div class="position-relative mb-3">
                <input type="text" name="name" class="form-control form-control-lg form-control-solid"
                    autocomplete="off" value="{{ isset($data) ? $data->name : '' }}" placeholder="Input Name" />
                @error('name')
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
