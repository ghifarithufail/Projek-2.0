<table class="table" style="zoom: 0.7">
    <thead>
        <tr>
            <th>KORHAN : {{$data->nama_koordinator}}</th>
            <th>JMLH KORTPS : {{$jumlahKortps}}</th>
            <th>KONSTITUANTE : {{$jumlahKonstituante}}</th>
        </tr>
        <tr></tr>
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
                    <small> - {{$item->tgl_lahir}}</small>
                </div>
            </td>
            <td>{{$item->alamat}}</td>
            <td>{{$item->rt}} / {{$item->rw}}</td>
            <td>
                <b>
                    {{$item->kelurahans->nama_kelurahan}} - 
                </b>
                <div>
                    <small> {{$item->kelurahans->kecamatan}} - {{$item->kelurahans->kabkota}}</small>
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