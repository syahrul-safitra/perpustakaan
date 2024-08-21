@extends('admin.layouts.main')

@section('container')
    <div class="row">
        <div class="col-lg-10">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Form Kategori</h6>
                </div>
                <div class="card-body">
                    <form action="{{ url('category/' . $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama">Nama Kategori</label>
                            <input type="text" id="nama" name="nama" value="{{ @old('nama', $category->nama) }}"
                                class="form-control  @error('nama')
                                is-invalid
                            @enderror">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <a href="{{ url('category') }}" class="btn btn-warning">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
