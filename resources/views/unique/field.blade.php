<div class="card-body">
    <div class="row">

        <!-- Code Input -->
        <div class="form-group col-md-6 fv-row mb-3">
            <label role="code" class="form-label fw-bolder text-dark fs-6">Code</label>
            <div class="position-relative mb-3">
                <input type="text" name="code" class="form-control form-control-lg form-control-solid"
                    autocomplete="off" value="{{ isset($data) ? $data->code : '' }}" placeholder="Input code" />
                @error('code')
                    <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }} !</p>
                @enderror
            </div>
        </div>

        <!-- Info Input -->
        <div class="form-group col-md-6 fv-row mb-3">
            <label for="info" class="form-label fw-bolder text-dark fs-6">Info</label>
            <input type="text" name="info" id="info" class="form-control form-control-lg form-control-solid"
                autocomplete="off" value="{{ old('info', isset($data) ? $data->info : '') }}" placeholder="Input info" />
            @error('info')
                <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }} !</p>
            @enderror
        </div>

        <!-- Lat Input -->
        <div class="form-group col-md-6 fv-row mb-3">
            <label for="lat" class="form-label fw-bolder text-dark fs-6">Latitude</label>
            <input type="text" name="lat" id="lat" class="form-control form-control-lg form-control-solid"
                autocomplete="off" value="{{ old('lat', isset($data) ? $data->lat : '') }}" placeholder="Input latitude" />
            @error('lat')
                <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }} !</p>
            @enderror
        </div>

        <!-- Long Input -->
        <div class="form-group col-md-6 fv-row mb-3">
            <label for="long" class="form-label fw-bolder text-dark fs-6">Longitude</label>
            <input type="text" name="long" id="long" class="form-control form-control-lg form-control-solid"
                autocomplete="off" value="{{ old('long', isset($data) ? $data->long : '') }}" placeholder="Input longitude" />
            @error('long')
                <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }} !</p>
            @enderror
        </div>

    </div>
</div>
<div class="card-footer d-flex justify-content-between">
    <a href="{{ route($route . 'index') }}" class="btn btn-secondary">Kembali</a>
    <button class="btn btn-primary mr-1" type="submit">Save</button>
</div>
