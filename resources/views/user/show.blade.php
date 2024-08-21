@extends('user.layouts.main')

@section('container')
    <div class="container">

        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible mx-auto" style="width: 500px" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('error') }}
            </div>
        @endif

        <img src="{{ asset('files/' . $book->gambar) }}" class="rounded mx-auto d-block img-fluid mb-5" alt="Gambar"
            style="width: 500px;height:500px">

        <h5>Judul : {{ $book->judul }}</h5>
        <h5>Penulis : {{ $book->penulis }}</h5>
        <h5>Tahun Terbit : {{ $book->tahun_terbit }}</h5>
        <h5>Kategori : {{ $book->category->nama }}</h5>
        <h5>Stok : {{ $book->stok }}</h5>
        <a href="{{ url('files/' . $book->berkas) }}" class="btn btn-success"
            style="padding-top: 2px; padding-bottom: 2px; padding-left: 5px; padding-right: 5px"><i class="fas fa-book"
                style="margin-right:5px"></i>Baca Buku</a>
        <p style="text-align: center">{!! $book->deskripsi !!}</p>

        @if ($book->stok == 0)
            <button class="btn btn-danger mb-5">Stok Habis</button>
        @else
            {{-- <form action="{{ url('pinjam') }}" method="POST">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                <button class="btn btn-info mb-5">Pinjam</button>
            </form> --}}

            <button class="btn btn btn-info mb-3" id="" data-target="#exampleModal{{ $book->id }}"
                data-toggle="modal">Pinjam
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal{{ $book->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            {{-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> --}}
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Anda akan meminjam buku dengan judul {{ $book->judul }}, dan batas
                                peminjaman tujuah hari
                                kedepan dan denda perhari Rp.5000, apakah anda setuju?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
                            <form action="{{ url('pinjam') }}" method="post">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                                <button type="submit" class="btn btn-info">Setuju</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
