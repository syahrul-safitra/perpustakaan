<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            /* height: 100vh; */
        }

        .container {
            width: 1000px;
            margin: 0 auto;
        }

        .kopsurat {
            padding: 20px 20px 5px 20px;
            display: flex;
            justify-content: center;
        }

        .kopsurat img {
            width: 65px;
        }

        .table-1 {
            padding: 3px;
            /* width: 100%; */
            /* border-bottom: 5px solid black; */
        }

        .tengah {
            text-align: center;
            padding: 0 20px;
        }

        .garis {
            width: 100%;
            height: 3px;
            background-color: black;
            margin-bottom: 5px;
        }

        .main {
            width: 100%;
            border: 1px solid black;
            border-collapse: collapse;
        }

        .main th,
        .main td {
            padding: 5px;
        }

        .main .no {
            text-align: center;
            /* background-color: aqua; */
        }
    </style>
</head>

<body>

    <div class="container " style="margin-top: 10px">

        <div class="kopsurat">
            <table class="table-1">
                <tr>
                    <td>
                        <img src="{{ asset('img/logo/tutwuri.png') }}" alt="" />
                    </td>

                    <td class="tengah">
                        <h4>SMP NEGERI 19 TANJUNG JABUNG TIMUR </h4>
                        <P>Jl. Lintas Samudra Desa Pematang Rahim,36764</P>
                    </td>
                </tr>
            </table>
        </div>

        <div class="garis">
        </div>


        <!-- table content -->
        <div class="content">

            <center>

                <h3 style="margin-top: 10px">Laporan Buku</h3><br>
                <h4>Periode {{ date('d-m-Y', strtotime($tanggal_awal)) }} -
                    {{ date('d-m-Y', strtotime($tanggal_akhir)) }}</h4>
            </center>
            <br>

            <div class="garis">
            </div>

            <table class="main" border="1" bordercollapse="collapse">
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Kategori</th>
                    <th>Tahun Terbit</th>
                    <th>Stok</th>
                </tr>
                @foreach ($data as $d)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $d->id_buku }}</td>
                        <td>{{ $d->judul }}</td>
                        <td>{{ $d->penulis }}</td>
                        <td>{{ $d->category->nama }}</td>
                        <td>{{ $d->tahun_terbit }}</td>
                        <td>{{ $d->stok }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

</body>

</html>
