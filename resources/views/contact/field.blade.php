<div class="card-body">
    <div class="row">

        <!-- Nama -->
        <div class="form-group-cs col-lg-6 col-md-6 col-sm-12 mb-3">
            <label for="name" class="form-label"><strong>Nama Lengkap</strong></label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
            @error('name')
                <p class="text-danger font-italic font-weight-bold mt-1" style="font-size: 12px;">{{$message}}!</p>
            @enderror
        </div>

        <!-- Email -->
        <div class="form-group-cs col-lg-6 col-md-6 col-sm-12 mb-3">
            <label for="email" class="form-label"><strong>Email</strong></label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
            @error('email')
                <p class="text-danger font-italic font-weight-bold mt-1" style="font-size: 12px;">{{$message}}!</p>
            @enderror
        </div>

        <!-- Nomor WhatsApp -->
        <div class="form-group-cs col-lg-6 col-md-6 col-sm-12 mb-3">
            <label for="no_wa" class="form-label"><strong>Nomor Telepon</strong></label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text-cs">+62</span>
                </div>
                <input type="text" name="no_wa" id="no_wa" class="form-control" value="{{ old('no_wa') }}" placeholder="Masukkan No Telepon">
            </div>
            @error('no_wa')
                <p class="text-danger font-italic font-weight-bold mt-1" style="font-size: 12px;">{{$message}}!</p>
            @enderror
        </div>

        <!-- Alamat -->
        <div class="form-group-cs col-lg-12 col-md-12 col-sm-12 mb-3">
            <label for="message" class="form-label"><strong>Alamat</strong></label>
            <textarea name="message" class="form-control ckeditor-custom-height" id="message" rows="5">{{ old('message') }}</textarea>
            @error('message')
                <p class="text-danger font-italic font-weight-bold mt-1" style="font-size: 12px;">{{$message}}!</p>
            @enderror
        </div>

    </div>
</div>
<div class="card-footer d-flex justify-content-between">
    <a href="{{ route($route . 'index') }}" class="btn btn-secondary">Kembali</a>
    <button class="btn btn-primary mr-1" type="submit">Save</button>
</div>
