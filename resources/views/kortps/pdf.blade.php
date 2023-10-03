<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Ghifari</title>
</head>

<body>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #000;
            /* Add a border style here */
            padding: 8px;
            text-align: left;
        }
    </style>

    <div class="data">
        <div class="content-data">
            {{-- <div class="head"> --}}
            <div class="menu d-flex justify-content-end">
                <div class="row">
                    <div class="col">
                    </div>
                </div>
            </div>
            <div>
                <div>
                    <div>
                        <td>
                            <B>RAIHAN TARGET KONSTITUEN PER TPS JEJARING KARYAWAN</B>
                        </td>
                    </div>
                    <div>

                        <th>koord.Kecamatan : {{ $kortps->korhans->koordinators->nama_koordinator }}</th>
                    </div>
                    <div>

                        <th>koord.Kelurahan : {{ $kortps->korhans->nama_koordinator }}</th>
                    </div>
                    <div>
                        <th>koord.TPS : {{ $kortps->nama_koordinator }}</th>
                    </div>
                    <div>
                        <th>jmlh.Konstituante : {{ $jumlahAnggota }}</th>
                    </div>

                    <div class="mb-3">
                        @php
                            $item = $anggota->first();
                        @endphp

                        @if ($item)
                            <th>TPS : {{ $item->tps->tps }} - {{ $item->tps->kelurahans->nama_kelurahan }} -
                                {{ $item->tps->kelurahans->kecamatan }}</th>
                        @endif
                    </div>
                </div>
                <table class="table" style="zoom: 0.7">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Phone</th>
                            <th scope="col">No KTP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($anggota as $data)
                            <tr>
                                <td class="text-center">{{$no++}}</td>
                                <td>
                                    {{ $data->nama_anggota }}
                                </td>
                                <td>{{ $data->phone }}</td>
                                <td>
                                    {{ $data->nik }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
