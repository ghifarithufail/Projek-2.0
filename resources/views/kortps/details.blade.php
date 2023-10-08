@extends('layout.index')
@section('content')
    {{-- <h1 class="title text-center">Koordinator Kecamatan</h1> --}}


    <div class="data">
        <div class="content-data">
            @if ($anggota->isNotEmpty())
                <h3 style="text-align: center;">KOORDINATOR TPS {{ $anggota->first()->tps->tps }}
                    {{ $anggota->first()->tps->kelurahans->nama_kelurahan }} : {{ strtoupper($kortps->nama_koordinator) }}
                </h3>
            @else
                <h3 style="text-align: center;">Koordinator {{ strtoupper($kortps->nama_koordinator) }} </h3>
            @endif
            <hr>
            <form>
                <div class="card-body d-flex justify-content-center">
                    <div class="form-group row">
                        <div class="col-sm-4 mt-2">
                            <input type="text" style="height: 40px" class="form-control" placeholder="Nama" name="nama"
                                id="search_kelurahan">
                        </div>
                        <div class="col-sm-4 mt-2">
                            <input type="text" style="height: 40px" class="form-control" placeholder="NIK" name="nik"
                                id="search_kecamatan">
                        </div>
                        <div class="col-sm-3 mt-2">
                            <select class="form-select" id="verifikasi" name="verifikasi" aria-label="Default select example">
                                <option selected value="">Status Verifikasi</option>
                                <option value="0">Belum</option>
                                <option value="1">Berhasil</option>
                                <option value="2">Gagal</option>
                            </select>
                        </div>
                    </div>
                    <div class="col d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary rounded text-white mt-2 mr-2" style="height: 40px"
                            id="search_btn">Search</button>
                        {{-- <button type="button" class="btn btn-warning rounded text-white" id="reset_btn" style="background-color: #d9d682; margin-left: 20px">Reset</button> --}}
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="data">
        <div class="content-data">
            {{-- <div class="head"> --}}
            <div class="menu d-flex justify-content-end">
                <div class="row">
                    <div class="col">
                        <div class="text-center">
                            @if ($anggota->isNotEmpty() && $anggota->first()->tps)
                                <a
                                    href="{{ route('kortps/excel', ['id' => $kortps->id, 'tps' => $anggota->first()->tps->id] ) }}">
                                    <button type="button" class="btn btn-success"
                                        style="zoom: 0.7; width: 100px">EXCEL</button>
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            @if ($anggota->isNotEmpty() && $anggota->first()->tps)
                                <a href="{{ route('kortps/pdf', ['id' => $kortps->id, 'tps' => $anggota->first()->tps->id]) }}"
                                    target="_blank" id="pdfLink">
                                    <button type="button" class="btn btn-danger"
                                        style="zoom: 0.7; width: 100px">PDF</button>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            {{-- </div> --}}
            <div>
                {{-- <div>
                    <a href="{{ route('kortps/download', ['id' => $kortps->id]) }}">
                        <button>
                            pdf
                        </button>
                    </a>
                </div> --}}
                <div>
                    <div style="display: inline-block; margin-right: 20px;">
                        <b>Korcam : {{ $kortps->korhans->koordinators->nama_koordinator }}</b>
                    </div>
                    <div class="mb-3" style="display: inline-block; margin-right: 20px;">
                        <b>Korlur : {{ $kortps->korhans->nama_koordinator }}</b>
                    </div>
                    <div style="display: inline-block; margin-right: 20px;">
                        <b>Konstituante : {{ $jumlahAnggota }}</b>
                    </div>
                    <div style="display: inline-block; margin-right: 20px;">
                        @if ($anggota->first() && $verifiedCount < $anggota->first()->tps->target)
                            <span class="badge text-bg-warning"
                                style="width: 150px; height: 30px; font-size: 16px; ">Terverifikasi :
                                {{ $verifiedCount }}</span>
                        @elseif($anggota->first() && $verifiedCount == $anggota->first()->tps->target)
                            <span class="badge text-bg-success"
                                style="width: 150px; height: 30px; font-size: 16px; ">Terverifikasi :
                                {{ $verifiedCount }}</span>
                        @elseif($anggota->first())
                            <span class="badge text-bg-danger"
                                style="width: 150px; height: 30px; font-size: 16px; ">Terverifikasi :
                                {{ $verifiedCount }}</span>
                        @endif
                    </div>

                    <div style="display: inline-block;">
                        @if ($anggota->isNotEmpty())
                            <b>Target : {{ $anggota->first()->tps->target }}</b>
                        @else
                            <b>Target : </b>
                        @endif
                    </div>
                </div>

                <table class="table" style="zoom: 0.7">
                    <thead>
                        <tr>
                            <th scope="col">Nama & Phone</th>
                            <th scope="col">No KTP/KK</th>
                            <th scope="col">Tempat/Tgl Lahir</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">RT/RW</th>
                            <th scope="col">Tps</th>
                            {{-- <th scope="col">Bertugas</th>  --}}
                            <th scope="col">Status</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Relawan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($anggota as $data)
                            <tr>
                                <td>
                                    <b>{{ $data->nama_anggota }}</b>
                                    <div>
                                        <small>{{ $data->phone }}</small>
                                    </div>
                                </td>
                                <td>
                                    {{-- <a href="https://cekdptonline.kpu.go.id/{{ $data->nik }}" target="_blank"> --}}
                                    {{ $data->nik }}
                                    {{-- </a> --}}
                                </td>
                                <td>
                                    <b>{{ $data->kabkotas->nama_kabkota }}</b>
                                    <div>
                                        <small>{{ $data->tgl_lahir }}</small>
                                    </div>
                                </td>
                                <td>{{ $data->alamat }}</td>
                                <td>{{ $data->rt }} / {{ $data->rw }}</td>
                                <td>
                                    <b>{{ $data->tps->tps }} {{ $data->tps->kelurahans->nama_kelurahan }}</b>
                                    <div>
                                        <small>{{ $data->tps->kelurahans->kecamatan }}</small>
                                    </div>
                                </td>
                                <td>
                                    @if ($data->status == '0')
                                        Aktif
                                    @elseif($data->status == '1')
                                        Tidak Aktif
                                    @elseif($data->status == '2')
                                        Keluar
                                    @endif
                                </td>
                                <td>{{ $data->keterangan }}</td>
                                <td>
                                    @if ($data->verified == 0)
                                        Belum Diverifikasi
                                    @elseif($data->verified == 1)
                                        Berhasil Verifikasi
                                    @elseif($data->verified == 2)
                                        Gagal Verifikasi
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $anggota->links() }}
            </div>
        </div>
    </div>
    <script>
        document.getElementById('pdfLink').addEventListener('click', function(e) {
            e.preventDefault();
            const pdfUrl = this.getAttribute('href');

            const newWindow = window.open(pdfUrl, '_blank');

            newWindow.addEventListener('load', function() {
                newWindow.print();
            });
        });

    </script>

    {{-- <script>
    $(document).ready(function() {
        setTimeout(function() {
            getTable();
            getSukses();
            getGagal();
            $("#filterForm").submit(function(e) {
                e.preventDefault(); // Prevent the default form submission
                handleFilter();
            });
        }, 800);

        $("#reset_btn").click(function(e) {
            e.preventDefault();
            handleReset();
        });

        // Call the function to update the form fields when the page loads
        updateFormFieldsFromUrl();

        // Handle the download action
        $("#download_data").click(function(e) {
            e.preventDefault();
            handleFilter(); // Call the filter function to get the updated filter values
            var customer = $('input[name="search"]').val();
            var tanggal = $('input[name="date"]').val();
            var startDate = $('input[name="date_start"]').val();
            var endDate = $('input[name="date_end"]').val();
            var tables = $('#tables').val();
            var payment = $('#payment').val();
            var url = '/reservation/download';
            url = url + '?search=' + customer + '&date_start=' + startDate + '&date_end=' + endDate +
                '&tables=' + tables +
                '&payment=' + payment;

            // Use the Helper object to perform the download
            Helper.redirectTo(url);
        });
    });

    function getSukses() {
        axios.post('/report_sukses', {
            search: $('#search').val(),
            date_start: $('#date_start').val(),
            date_end: $('#date_end').val(),
            tables: $('select[name="tables"]').val(),
            payment: $('select[name="payment"]').val(),
        }).then(function(response) {
            $('#report_sukses').html(response.data);
        }).catch(function(error) {
            Helper.handleErrorResponse(error);
        });
    }

    function getTable() {
        axios.post('/report_table', {
            search: $('#search').val(),
            date_start: $('#date_start').val(),
            date_end: $('#date_end').val(),
            tables: $('select[name="tables"]').val(),
            payment: $('select[name="payment"]').val(),
        }).then(function(response) {
            $('#report_table').html(response.data);
        }).catch(function(error) {
            Helper.handleErrorResponse(error);
        });
    }

    function getGagal() {
        axios.post('/report_gagal', {
            search: $('#search').val(),
            date_start: $('#date_start').val(),
            date_end: $('#date_end').val(),
            tables: $('select[name="tables"]').val(),
            payment: $('select[name="payment"]').val(),
        }).then(function(response) {
            $('#report_gagal').html(response.data);
        }).catch(function(error) {
            Helper.handleErrorResponse(error);
        });
    }

    // Define the Helper object
    var Helper = {
        redirectTo: function(url) {
            window.location.href = url;
        }
    };

    // Function to update the form fields with the URL parameters
    function updateFormFieldsFromUrl() {
        var urlParams = new URLSearchParams(window.location.search);
        $('#search').val(urlParams.get('search'));
        $('#date').val(urlParams.get('date'));
        $('#tables').val(urlParams.get('tables'));
        $('#payment').val(urlParams.get('payment'));
        $('#date_start').val(urlParams.get('date_start'));
        $('#date_end').val(urlParams.get('date_end'));
    }

    function handleReset() {
        $('#search').val('');
        $('input[type="date"][name="date"]').val('');
        $('input[type="date"][name="date_start"]').val('');
        $('input[type="date"][name="date_end"]').val('');
        $('#tables').val('');
        $('#payment').val('');
        // After resetting the form fields, you can trigger the filter action to reload the data without the filters
        handleFilter();
    }

    function handleFilter() {
var customer = $('input[name="search"]').val();
var tables = $('#tables').val();
var payment = $('#payment').val();
var startDate = $('input[name="date_start"]').val();
var endDate = $('input[name="date_end"]').val();

// If startDate is empty, set it to the default value
if (startDate == null) {
    startDate = '2020-01-01';
}

// If endDate is empty, set it to the current date
if (endDate == null) {
    var today = new Date();
    var day = today.getDate();
    var month = today.getMonth() + 1; // Months are 0-indexed
    var year = today.getFullYear();
    endDate = year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}

console.log(customer);

// Construct the URL with parameters
var url = '/reservation/download' +
    '?search=' + customer +
    '&tables=' + tables +
    '&payment=' + payment +
    '&date_start=' + startDate +
    '&date_end=' + endDate;

// Use AJAX to load the filtered data without reloading the page
$.ajax({
    type: "GET",
    url: url,
    success: function(data) {
        // Process the returned data and update the relevant parts of your page
        console.log("Filtered data:", data);
        // For example, you can update the summary tables or the main data table
        // with the filtered results returned from the server
    },
    error: function(xhr, status, error) {
        // Handle any errors if necessary
        console.log("Error:", error);
    }
});
}
</script> --}}
@endsection
