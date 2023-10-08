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
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Phone</th>
                            <th scope="col">No KTP</th>
                            <th scope="col" class="text-center">Konstituante</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($korhan as $item)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$item->nama_koordinator}}</td>
                            <td>{{$item->phone}}</td>
                            <td>{{$item->nik}}</td>
                            <td class="text-center">{{$item->anggota_count}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

