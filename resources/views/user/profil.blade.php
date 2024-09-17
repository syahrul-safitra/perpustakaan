@extends('user.layouts.main')

@section('container')
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-8 mx-auto">
                <div class="card mb-3">
                    <div>
                        <img src="{{ asset('img/logo/bg.jpg') }}" class="img-fluid w-100 h-80" alt="FOTO SEKOLAH">
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Profil Sekolah</h6>
                    </div>

                    <table class="table align-items-center table-flush table-hover">
                        <tr>
                            <th>NPSN</th>
                            <th>:</th>
                            <th>10504188</th>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <th>:</th>
                            <th>SMP NEGERI 19 TANJAB. TIMUR</th>
                        </tr>
                        <tr>
                            <th>Kepala Perpustakaan</th>
                            <th>:</th>
                            <th>SUPTAMI,S.PD</th>
                        </tr>
                        <tr>
                            <th>No HP</th>
                            <th>:</th>
                            <th>XXXXXXX</th>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <th>:</th>
                            <th>XXXXXXX</th>
                        </tr>
                    </table>
                </div>

                <div class="card mb-3">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Profil</h6>
                    </div>

                    <table class="table align-items-center table-flush table-hover">
                        <tr>
                            <th>NIS</th>
                            <th>:</th>
                            <th>{{ $user->nis }}</th>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <th>:</th>
                            <th>{{ $user->name }}</th>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <th>:</th>
                            <th>{{ $user->email }}</th>
                        </tr>
                        <tr>
                            <th>Foto</th>
                            <th>:</th>
                            <th><img src="{{ asset('files/' . $user->gambar) }}" class="img-fluid"></th>
                        </tr>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
