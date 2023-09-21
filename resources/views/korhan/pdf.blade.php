<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Ghifari</title>
  </head>
  <body>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
    
        th, td {
            border: 1px solid #000; /* Add a border style here */
            padding: 8px;
            text-align: left;
        }
    </style>
    <div class="data">
        <div class="content-data mb-4">
            <h3 style="text-align: center;">Koordinator Kelurahan : {{$data->nama_koordinator}}</h3>
        </div>
    </div>

    <div class="data">
        <div class="content-data">
            <div>
                <div>
                    <div class="mb-3" style="display: inline-block; margin-right: 20px;">
                        <b>Jumlah Kortps : {{$jumlahKortps}}</b>
                    </div>
                    <div class="mb-3" style="display: inline-block; margin-right: 20px;">
                        <b>Konstituante : {{$jumlahKonstituante}}</b>
                    </div>
                </div>
                <table class="table" style="zoom: 0.7">
                    <thead>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">Phone</th>
                            <th scope="col">No KTP</th>
                            <th scope="col">Tempat/Tgl Lahir</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">RT/RW</th>
                            <th scope="col">Kelurahan / Kecamatan</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-center">TPS</th>
                            <th scope="col">Konstituante</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($korhan as $item)
                        <tr>
                            <td>{{$item->nama_koordinator}}</td>
                            <td>{{$item->phone}}</td>
                            <td>{{$item->nik}}</td>
                            <td>
                                {{$item->kabkotas->nama_kabkota}}
                                <div>
                                    <small>{{$item->tgl_lahir}}</small>
                                </div>
                            </td>
                            <td>{{$item->alamat}}</td>
                            <td>{{$item->rt}} / {{$item->rw}}</td>
                            <td>
                                <b>
                                    {{$item->kelurahans->nama_kelurahan}}
                                </b>
                                <div>
                                    <small>{{$item->kelurahans->kecamatan}} - {{$item->kelurahans->kabkota}}</small>
                                </div>
                            </td>
                            <td>{{$item->keterangan}}</td>
                            <td>
                                @if ($item->status == '0')
                                    Aktif
                                @elseif($item->status == '1')
                                    Tidak Aktif
                                @elseif($item->status == '2')
                                    Keluar
                                @endif
                            </td>
                            <td>
                                <ul>
                                @foreach ($item->tps_pivot as $row)
                                    <li>{{$row->tps}} {{$row->kelurahans->nama_kelurahan}}</li>
                                @endforeach
                                </ul>
                            </td>
                            <td class="text-center">{{$item->anggotas_count}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

