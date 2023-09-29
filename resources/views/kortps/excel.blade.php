<table class="table" id="data-table" style="zoom: 0.85;">
    <thead>
        <tr>
            <td>
                <B>RAIHAN TARGET KONSTITUEN PER TPS JEJARING KARYAWAN</B>
            </td>
        </tr>
        <tr>
            <th>koord.Kecamatan : {{$kortps->korhans->koordinators->nama_koordinator}}</th>
        </tr>
        <tr>
            <th>koord.Kelurahan : {{$kortps->korhans->nama_koordinator}}</th>
        </tr>
        <tr>
            <th>koord.TPS : {{$kortps->nama_koordinator}}</th>
        </tr>
        <tr>
            @php
            $item = $anggota->first();
            @endphp
        
            @if ($item)
            <th>TPS : {{$item->tps->tps}} - {{$item->tps->kelurahans->nama_kelurahan}} - {{$item->tps->kelurahans->kecamatan}}</th>

            @else
            <th>TPS : </th>
            @endif
        </tr>
        <tr>
            <th>Konstituante : {{$jumlahAnggota}}</th>
        </tr>
        <tr></tr>
        <tr>
            <th>No</th>
            <th scope="col">Nama</th>
            <th scope="col">Phone</th>
            <th scope="col">No KTP</th>
            <th scope="col">Tempat/Tgl Lahir</th>
            <th scope="col">Alamat</th>
            <th scope="col">RT/RW</th>  
        </tr>
    </thead>
    <tbody>
        @php
            $row = 1;
        @endphp
            @foreach ($anggota as $data)
                            <tr>
                                <td>{{$row++}}</td>
                                <td>{{$data->nama_anggota}}</td>
                                <td>{{$data->phone}}</td>
                                <td>
                                    {{$data->nik}}
                                </td>
                                <td>
                                    <b>{{$data->kabkotas->nama_kabkota}}</b>
                                    <div>
                                        <small>{{$data->tgl_lahir}}</small>
                                    </div>
                                </td>
                                <td>{{$data->alamat}}</td>
                                <td>{{$data->rt}} / {{$data->rw}}</td>
                            </tr>
                        @endforeach
    </tbody>
</table>
