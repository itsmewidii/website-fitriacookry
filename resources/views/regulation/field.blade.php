<div class="card-body">
    <div class="row">

        <!-- Input untuk Rekening Nomor -->
        <div class="form-group col-md-12 mb-5">
            <label class="mb-3" for="rek_no"><strong>Nomor Rekening</strong></label>
            <input type="text" name="rek_no" class="form-control" value="{{ isset($data) ? $data->rek_no : '' }}">
            @error('rek_no')
            <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{$message}} !</p>
            @enderror
        </div>

        <!-- Input untuk Nama Rekening -->
        <div class="form-group col-md-12 mb-5">
            <label class="mb-3" for="rek_name"><strong>Nama Rekening</strong></label>
            <input type="text" name="rek_name" class="form-control" value="{{ isset($data) ? $data->rek_name : '' }}">
            @error('rek_name')
            <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{$message}} !</p>
            @enderror
        </div>

        <!-- Input untuk Bank -->
        <div class="form-group col-md-12 mb-5">
            <label class="mb-3" for="bank"><strong>Bank</strong></label>
            <input type="text" name="bank" class="form-control" value="{{ isset($data) ? $data->bank : '' }}">
            @error('bank')
            <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{$message}} !</p>
            @enderror
        </div>

        <!-- Input untuk Keterangan -->
        <div class="form-group col-md-12 mb-5">
            <label class="mb-3" for="description"><strong>Keterangan</strong></label>
            <textarea class="form-control" name="description" rows="3">{{ isset($data) ? $data->description : '' }}</textarea>
            @error('description')
            <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{$message}} !</p>
            @enderror
        </div>

    </div>
</div>
<div class="card-footer d-flex justify-content-center">
    <button class="btn btn-primary mr-1" type="submit">Save</button>
</div>
