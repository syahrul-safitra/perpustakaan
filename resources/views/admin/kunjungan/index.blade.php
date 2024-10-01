@extends('admin.layouts.main')

@section('container')
    <div class="col-lg-12">

        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('success') }}
            </div>
        @endif

        <div class="card mb-4">

            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Pengunjung</h6>

            </div>

            <div class="table-responsive p-3">

                <div class="card-header d-flex">

                    @can('admin')
                        <a href="{{ url('kunjungan/create') }}" class="btn btn-primary" style="margin-right: 10px">Tambah</a>
                    @endcan

                    <button class="btn btn-info" id="" data-target="#exampleModal" data-toggle="modal">
                        Cetak Laporan
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    {{-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> --}}
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ url('cetak/kunjungan') }}" method="POST">
                                    <div class="modal-body">
                                        <p>Masukan tanggal awal dan akhir</p>
                                    </div>
                                    <div class="modal-footer">
                                        @csrf
                                        <input type="date" class="form-control" name="tanggal_awal" required>
                                        <input type="date" class="form-control" name="tanggal_akhir" required>
                                        <button type="submit" id="btn-password" class="btn btn-primary">Cetak</button>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Keperluan</th>
                            @can('admin')
                                <th>Aksi</th>
                            @endcan
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($data as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->tanggal }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->kelas }}</td>
                                <td>{{ $data->keperluan }}</td>

                                @can('admin')
                                    <td>
                                        <button class="btn btn btn-danger" id=""
                                            data-target="#exampleModal{{ $data->id }}" data-toggle="modal"
                                            style="padding-top: 2px; padding-bottom: 2px; padding-left: 5px; padding-right: 5px">
                                            <i class="bi bi-trash"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{ $data->id }}" tabindex="-1"
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
                                                        <p>Anda akan menghapus data pengunjung {{ $data->nama }}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-primary"
                                                            data-dismiss="modal">Batal</button>
                                                        <form action="{{ url('kunjungan/' . $data->id) }}" method="post">
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
