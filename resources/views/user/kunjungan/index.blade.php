@extends('user.layouts.main')

@section('container')
    <div class="container-fluid"><!-- Row -->
        <div class="row">

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
                        <h6 class="m-0 font-weight-bold text-primary">Riwayat Peminjaman</h6>

                    </div>

                    <div class="table-responsive p-3">

                        <a href="{{ url('kunjungan/create') }}" class="btn btn-primary mb-3">Tambah</a>

                        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Keperluan</th>
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--Row-->
    </div>
@endsection
