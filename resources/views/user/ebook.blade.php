@extends('user.layouts.main')

@section('container')
    <div class="container-fluid">

        {{-- Search & Category --}}
        <div class="row">
            @if (session()->has('success'))
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissible mx-auto" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('success') }}
                    </div>
                </div>
            @endif
            <div class="col-lg-8 mb-3">
                <form action="" method="GET">
                    <div class="d-flex">
                        <input type="hidden" name="category" value="{{ request('category') }}">
                        <input type="text" name="search" class="form-control rounded-pill"
                            style="background-color: #F8F9FD" placeholder="Cari...">
                        <button class="btn btn-primary">Cari</button>
                    </div>
                </form>
            </div>

            <div class="col-lg-4 mb-3">
                <form action="" method="GET">
                    <div class="d-flex">
                        <select name="category" id="category" class="form-control rounded-pill"
                            style="background-color: #F8F9FD">
                            <option value="">Semua</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->nama }}">{{ $category->nama }}</option>
                            @endforeach
                        </select>

                        <button class="btn btn-primary">Cari</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- List Book --}}
        <div class="row" id="container-list-book">
            @foreach ($ebooks as $book)
                <div class="col-sm-1 col-md-3 col-lg-2 mb-3">
                    <div class="card" style="width: 100%;">
                        <img src="{{ asset('files/' . $book->gambar) }}" class="card-img-top" style="height:300px"
                            alt="...">
                        <div class="card-body">
                            <p class="card-text"><a href="{{ url('/siswa?category=' . $book->category->nama) }}"><span
                                        class="badge badge-success">{{ $book->category->nama }}</span></a>
                            </p>

                            @php
                                $parJudul = $book->judul;
                                $parPenulis = $book->penulis;

                                if (Str::length($parJudul) > 10) {
                                    $parJudul = Str::substr($parJudul, 0, 10) . '...';
                                }

                                if (Str::length($parPenulis) > 15) {
                                    $parJudul = Str::substr($parPenulis, 0, 10) . '...';
                                }

                            @endphp
                            <h5 class="card-title">{{ $parJudul }}</h5>
                            <p class="card-text">{{ $parPenulis }}</p>
                            <a href="{{ url('ebook/' . $book->id) }}" class="btn btn-primary">Lihat</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
