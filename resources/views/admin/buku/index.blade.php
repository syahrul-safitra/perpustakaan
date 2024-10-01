@extends('admin.layouts.main')

@section('container')
    <!-- Row -->
    <div class="row">
        <!-- DataTable with Hover -->
        <div class="col-lg-12">

            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('success') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('error') }}
                </div>
            @endif

            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Buku</h6>
                </div>
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                    <div class="flex">
                        @can('admin')
                            <a class="btn btn-primary" href="{{ url('book/create') }}">Tambah</a>
                        @endcan
                        <button class="btn btn-info" data-target="#cetakLaporan" data-toggle="modal">Cetak</button>

                        {{-- Modal cetak laporan :  --}}
                        <div class="modal fade" id="cetakLaporan" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        {{-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> --}}
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ url('cetak/book') }}" method="POST">
                                        <div class="modal-body">
                                            <p>Masukan tanggal awal dan akhir</p>
                                        </div>
                                        <div class="modal-footer">
                                            @csrf
                                            <input type="date" class="form-control" name="tanggal_awal">
                                            <input type="date" class="form-control" name="tanggal_akhir">
                                            <button type="submit" class="btn btn-primary">Cetak</button>
                                        </div>
                                </div>
                                </form>
                            </div>
                        </div>


                    </div>
                    <div>
                        <form class="d-flex justify-content-between" action="">

                            <input class="form-control" type="text" name="search" placeholder="cari...">
                            <button class="btn btn-primary">Cari</button>
                        </form>
                    </div>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Kode Buku</th>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Kategori</th>
                                <th>Tahun Terbit</th>
                                <th>Stok</th>
                                <th>Rak</th>
                                <th>Deskripsi</th>
                                @can('admin')
                                    <th>Aksi</th>
                                @endcan
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($books as $book)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $book->id_buku }}</td>
                                    <td>{{ $book->judul }}</td>
                                    <td>{{ $book->penulis }}</td>
                                    <td>{{ $book->category->nama }}</td>
                                    <td>{{ $book->tahun_terbit }}</td>
                                    <td>{{ $book->stok }}</td>
                                    <td>{{ $book->rak }}</td>
                                    <td>
                                        @php
                                            $result = str_replace(['<div>', '</div>'], ' ', $book->deskripsi);

                                            if (strlen($result) > 50) {
                                                $result = substr($result, 0, 50);

                                                $result = $result . '...';
                                            }
                                        @endphp

                                        {!! $result !!}
                                    </td>
                                    @can('admin')
                                        <td>
                                            <div class="d-flex" style="gap:1rem">
                                                <a href="{{ url('book/' . $book->id . '/edit') }}" class="btn btn-warning"
                                                    style="padding-top: 2px; padding-bottom: 2px; padding-left: 5px; padding-right: 5px"><i
                                                        class="bi bi-pencil-square"></i></a>

                                                <button class="btn btn btn-danger" id=""
                                                    data-target="#exampleModal{{ $book->id }}" data-toggle="modal"
                                                    style="padding-top: 2px; padding-bottom: 2px; padding-left: 5px; padding-right: 5px">
                                                    <i class="bi bi-trash"></i>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal{{ $book->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                {{-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> --}}
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Anda akan menghapus data buku {{ $book->judul }}</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-primary"
                                                                    data-dismiss="modal">Batal</button>
                                                                <form action="{{ url('book/' . $book->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $books->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
    <!--Row-->
@endsection
