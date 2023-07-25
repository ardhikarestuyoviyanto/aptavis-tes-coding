<div class="card-header bg-primary text-white">
    INPUT SKOR SINGLE
</div>
<form action="{{ url('skor/create-single') }}" method="post">
    @csrf
    <div class="card-body">
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label for="klub_1" class="form-label">Klub 1 dan Skor</label>
                    <select name="klub_1" class="form-select @error('klub_1') is-invalid @enderror">
                        <option value="">- PILIH TIM KLUB 1 -</option>
                        @foreach ($klub as $k)
                            <option {{ @old('klub_1') == $k?->id ? 'selected' : '' }} value="{{ $k?->id }}">-
                                {{ $k?->nama_klub }} -</option>
                        @endforeach
                    </select>
                    @error('klub_1')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <input type="number" name="skor_klub_1"
                        class="form-control mt-1 @error('skor_klub_1') is-invalid @enderror"
                        placeholder="Skor Tim KLUB 1" value="{{ @old('skor_klub_1') }}" id="">
                    @error('skor_klub_1')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <hr>
                <div class="mb-3">
                    <label for="klub_2" class="form-label">Klub 2 dan Skor</label>
                    <select name="klub_2" class="form-select @error('klub_2') is-invalid @enderror ">
                        <option value="">- PILIH TIM KLUB 2 -</option>
                        @foreach ($klub as $k)
                            <option {{ @old('klub_2') == $k?->id ? 'selected' : '' }} value="{{ $k?->id }}">-
                                {{ $k?->nama_klub }} -</option>
                        @endforeach
                    </select>
                    @error('klub_2')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <input type="number" name="skor_klub_2"
                        class="form-control mt-1 @error('skor_klub_2') is-invalid @enderror"
                        placeholder="Skor Tim KLUB 2" value="{{ old('skor_klub_1') }}" id="">
                    @error('skor_klub_2')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="d-grid gap-2 mt-3">
            <button class="btn btn-success" type="submit">Simpan</button>
        </div>
    </div>
</form>
