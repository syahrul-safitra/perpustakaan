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

        @if ($book->kunci)
            <button class="btn btn-danger"
                style="padding-top: 2px; padding-bottom: 2px; padding-left: 5px; padding-right: 5px" id=""
                data-target="#exampleModal" data-toggle="modal">
                <i class="fas fa-book" style="margin-right:5px"></i>Baca Buku
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            {{-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> --}}
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ url('files/' . $book->berkas) }}" method="get">
                            <div class="modal-body">
                                <p>Masukan password</p>
                                <input type="text" id="input-password" class="form-control" required>
                            </div>
                            <div class="modal-footer">
                                @csrf
                                <button type="submit" id="btn-password" class="btn btn-primary">submit</button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        @else
            <a href="{{ url('files/' . $book->berkas) }}" class="btn btn-success"
                style="padding-top: 2px; padding-bottom: 2px; padding-left: 5px; padding-right: 5px"><i class="fas fa-book"
                    style="margin-right:5px"></i>Baca Buku</a>
        @endif

        <p style="text-align: center">{!! $book->deskripsi !!}</p>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
        crossorigin="anonymous"></script>

    <script type="">
        $(document).ready(function() {
            $("#btn-password").click(function(e) {

                e.preventDefault();
                let form = $(this).closest('form');

                let inputPassword = $('#input-password').val()

                if (inputPassword == "{{$password}}") {
                    form.submit();
                } else {
                    alert('password salah');
                }

            });
        });
    </script>
@endsection
