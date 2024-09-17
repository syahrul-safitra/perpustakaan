@extends('admin.layouts.main')

@section('container')
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
                    <h6 class="m-0 font-weight-bold text-primary">Riwayat Peminjaman</h6>
                </div>

                <div class="card-header d-flex justify-content-between">
                    <button class="btn btn-info" id="" data-target="#exampleModal" data-toggle="modal">
                        Cetak Laporan
                    </button>

                    <div>
                        <form action="" class="d-flex" method="GET">
                            <input type="text" class="form-control" name="search" placeholder="cari..">
                            <button class="btn btn-primary">Cari</button>
                        </form>
                    </div>

                </div>

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
                            <form action="{{ url('cetak/peminjaman') }}" method="POST">
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
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover mb-3" id="dataTableHover">
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
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($peminjaman as $data)
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
                                            $selisih = $data->denda;
                                        }

                                    @endphp
                                    <td>{{ $selisih }}</td>
                                    <td>
                                        <div class="d-flex" style="gap:1rem">

                                            @if ($data->status == 'dipinjam')
                                                {{-- For Return --}}
                                                <button class="btn btn btn-success" id=""
                                                    data-target="#modalReturn{{ $data->id }}" data-toggle="modal"
                                                    style="padding-top: 2px; padding-bottom: 2px; padding-left: 5px; padding-right: 5px">
                                                    <i class="bi bi-bookmark-check-fill"></i>
                                                </button>
                                            @endif

                                            <!-- Modal -->
                                            <div class="modal fade" id="modalReturn{{ $data->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="modalReturnLabel" aria-hidden="true">
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
                                                            <p>
                                                                {{ $data->user->name }} akan mengembalikan buku
                                                                {{ $data->book->judul }}
                                                                dengan denda {{ $selisih }}
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-primary"
                                                                data-dismiss="modal">Batal</button>
                                                            <form action="{{ url('kembalikan/' . $data->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <input type="hidden" name="denda"
                                                                    value="{{ $selisih }}">
                                                                <input type="hidden" name="tanggal_dikembalikan"
                                                                    value="{{ date('Y-m-d') }}">
                                                                <button type="submit"
                                                                    class="btn btn-info">Simpan</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- For Delete --}}
                                            <button class="btn btn btn-danger" id=""
                                                data-target="#modalDelete{{ $data->id }}" data-toggle="modal"
                                                style="padding-top: 2px; padding-bottom: 2px; padding-left: 5px; padding-right: 5px">
                                                <i class="bi bi-trash"></i>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="modalDelete{{ $data->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="modalDeleteLabel" aria-hidden="true">
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
                                                            <p>Anda akan menghapus data peminjaman milik
                                                                {{ $data->user->name }}
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-primary"
                                                                data-dismiss="modal">Batal</button>
                                                            <form action="{{ url('pinjam/' . $data->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $peminjaman->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
