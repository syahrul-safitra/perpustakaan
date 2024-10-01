@extends('admin.layouts.main')

@section('container')
    <div class="row">
        <div class="col-lg-10">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Form Buku</h6>
                </div>
                <div class="card-body">
                    <form action="{{ url('book') }}" method="POST" enctype=multipart/form-data>
                        @csrf
                        <div class="form-group">
                            <label for="id_buku">Kode Buku</label>
                            <input type="text" id="id_buku" name="id_buku" value="{{ @old('id_buku') }}"
                                class="form-control  @error('id_buku')
                                is-invalid
                            @enderror">
                            @error('id_buku')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" id="judul" name="judul" value="{{ @old('judul') }}"
                                class="form-control  @error('judul')
                                is-invalid
                            @enderror">
                            @error('judul')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="penulis">Penulis</label>
                            <input type="text" id="penulis" name="penulis" value="{{ @old('penulis') }}"
                                class="form-control  @error('penulis')
                                is-invalid
                            @enderror">
                            @error('penulis')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tahun_terbit">Tahun Terbit</label>
                            <input type="date" id="tahun_terbit" name="tahun_terbit" value="{{ @old('tahun_terbit') }}"
                                class="form-control  @error('tahun_terbit')
                                is-invalid
                            @enderror">
                            @error('tahun_terbit')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="stok">Stok</label>
                            <input type="number" id="stok" name="stok" value="{{ @old('stok') }}"
                                class="form-control @error('stok') is-invalid
                            @enderror">

                            @error('stok')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            @error('category_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <select class="select2-single form-control" style="width: 100%" name="category_id"
                                id="kategori">
                                <option value="">Pilih</option>
                                @if (@old('category_id'))
                                    @foreach ($categories as $categori)
                                        @if (@old('category_id') == $categori->id)
                                            <option value="{{ $categori->id }}" selected>{{ $categori->nama }}</option>
                                        @endif
                                    @endforeach
                                @else
                                    @foreach ($categories as $categori)
                                        <option value="{{ $categori->id }}">{{ $categori->nama }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="rak">Rak</label>
                            <input type="text" id="rak" name="rak" value="{{ @old('rak') }}"
                                class="form-control @error('rak') is-invalid
                            @enderror">

                            @error('rak')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="gambar">Gambar</label>
                            <input type="file" onchange="previewImage()" id="image" name="gambar"
                                class="form-control @error('gambar') 'is-invalid' @enderror">
                            <img src="" alt="" id="img-preview" width="300px;height:300px">
                            @error('gambar')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            @error('deskripsi')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input id="x" type="hidden" value="{{ @old('deskripsi') }}" name="deskripsi">
                            <trix-editor input="x"></trix-editor>
                        </div>


                        <a href="{{ url('category') }}" class="btn btn-warning">Batal</a>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
