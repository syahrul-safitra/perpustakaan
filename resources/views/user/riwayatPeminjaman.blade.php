@extends('user.layouts.main')

@section('container')
    <div class="container-fluid"><!-- Row -->
        <div class="row">

            <!-- DataTable with Hover -->
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Riwayat Peminjaman</h6>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Judul</th>
                                    <th>Tanggal Peminjaman</th>
                                    <th>Tanggal Tenggat</th>
                                    <th>Tanggal Dikembalikan</th>
                                    <th>Status</th>
                                    <th>Denda</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($data as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->user->name }}</td>
                                        <td>{{ $data->book->judul }}</td>
                                        <td>{{ $data->tanggal_peminjaman }}</td>
                                        <td>{{ $data->tanggal_pengembalian }}</td>
                                        <td>{{ $data->tanggal_dikembalikan }}</td>
                                        <td><span
                                                class="{{ $data->status == 'dipinjam' ? 'badge badge-warning' : 'badge badge-success' }}">{{ $data->status }}</span>
                                        </td>
                                        @php

                                            if ($data->status == 'dipinjam') {
                                                $tanggal_sekarang = new DateTime(date('Y-m-d'));
                                                $tanggal_pengembalian = new DateTime($data->tanggal_pengembalian);

                                                $selisih = $tanggal_sekarang->diff($tanggal_pengembalian);

                                                $selisih = (int) $selisih->format('%r%a');

                                                if ($selisih < 0) {
                                                    $selisih = $selisih * -1 * 5000;
                                                } else {
                                                    $selisih = 0;
                                                }
                                            } else {
                                                $selisih = 0;
                                            }

                                        @endphp
                                        <td>{{ $selisih }}</td>
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
