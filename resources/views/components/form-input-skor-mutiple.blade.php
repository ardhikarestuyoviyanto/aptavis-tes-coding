<div class="card-header bg-primary text-white">
    INPUT MULTIPLE
</div>
<div class="card-header">
    <button class="btn btn-secondary btn-sm" type="button" id="add-form" style="float: right">
        <i class="fas fa-plus"></i> Add
    </button>
</div>
<div class="card-body">
    {{-- Ini alert untuk validasi jika ada nama klub sama dalam satu pertandingan --}}
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form action="{{ url('skor/create-multiple') }}" method="post">
        @csrf
        <div id="multiple-content">
            @foreach (old('klub_1', [1]) as $key => $index)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="klub_1" class="form-label">Klub 1 dan Skor</label>
                            <select name="klub_1[]" class="form-select @error('klub_1.' . $key) is-invalid @enderror">
                                <option value="">- PILIH TIM KLUB 1 -</option>
                                @foreach ($klub as $k)
                                    <option {{ @old('klub_1.' . $key) == $k?->id ? 'selected' : '' }}
                                        value="{{ $k?->id }}">- {{ $k?->nama_klub }} -
                                    </option>
                                @endforeach
                            </select>
                            @error('klub_1.' . $key)
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <input type="number" name="skor_klub_1[]"
                                class="form-control mt-1 
                                @error('skor_klub_1.' . $key) is-invalid @enderror"
                                placeholder="Skor Tim KLUB 1" value="{{ old('skor_klub_1.' . $key) }}">
                            @error('skor_klub_1.' . $key)
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label for="klub_2" class="form-label">Klub 2 dan Skor</label>
                            <select name="klub_2[]" class="form-select @error('klub_2.' . $key) is-invalid @enderror">
                                <option value="">- PILIH TIM KLUB 2 -</option>
                                @foreach ($klub as $k)
                                    <option {{ @old('klub_2.' . $key) == $k?->id ? 'selected' : '' }}
                                        value="{{ $k?->id }}">- {{ $k?->nama_klub }} -
                                    </option>
                                @endforeach
                            </select>
                            @error('klub_2.' . $key)
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <input type="number" name="skor_klub_2[]"
                                class="form-control mt-1 @error('skor_klub_2.' . $key) is-invalid @enderror"
                                placeholder="Skor Tim KLUB 2" value="{{ old('skor_klub_2.' . $key) }}">
                            @error('skor_klub_2.' . $key)
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{-- Jika Add Total Form Lebih dari 0 Maka Muncul Button Hapus  --}}
                        @if ($loop->index > 0)
                            <button type="button" class="btn btn-danger btn-sm remove-form">
                                <i class="fas fa-trash"></i>
                                Remove
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-grid gap-2 mt-3">
            <button class="btn btn-success" type="submit">Simpan</button>
        </div>
    </form>
</div>
<script>
    // Ketika Button Add Diklik Maka Akan Append 
    // Komponen formHtml kedalam elemen dengan id="#multiple-content"
    $(document).ready(function() {
        $("#add-form").click(function() {
            var formHtml = `
    <div class="card mb-3">
        <div class="card-body">
            <div class="mb-3">
                <label for="klub_1" class="form-label">Klub 1 dan Skor</label>
                <select name="klub_1[]" class="form-select">
                    <option value="">- PILIH TIM KLUB 1 -</option>
                    @foreach ($klub as $k)
                        <option {{ @old('klub_1') == $k?->id ? 'selected' : '' }}
                            value="{{ $k?->id }}">- {{ $k?->nama_klub }} -</option>
                    @endforeach
                </select>
                <input type="number" name="skor_klub_1[]" class="form-control mt-1" placeholder="Skor Tim KLUB 1">
            </div>
            <hr>
            <div class="mb-3">
                <label for="klub_2" class="form-label">Klub 2 dan Skor</label>
                <select name="klub_2[]" class="form-select">
                    <option value="">- PILIH TIM KLUB 2 -</option>
                    @foreach ($klub as $k)
                        <option {{ @old('klub_2') == $k?->id ? 'selected' : '' }}
                            value="{{ $k?->id }}">- {{ $k?->nama_klub }} -</option>
                    @endforeach
                </select>
                <input type="number" name="skor_klub_2[]" class="form-control mt-1" placeholder="Skor Tim KLUB 2">
            </div>
            <button type="button" class="btn btn-danger btn-sm remove-form"><i class="fas fa-trash"></i> Remove</button>
        </div>
    </div>
    `;

            $("#multiple-content").append(formHtml);
        });

        // Remove Card Dengan Dengan Fungsi $(this) Ketika
        // .remove-form diklik
        $(document).on("click", ".remove-form", function() {
            $(this).closest(".card").remove();
        });
    });
</script>
