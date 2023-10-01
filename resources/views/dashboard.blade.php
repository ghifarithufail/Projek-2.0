@extends('layout.index')
@section('content')
    {{-- <h1 class="title text-center">Koordinator Kecamatan</h1> --}}


    <div class="data">
        <div class="content-data">
            <h3 style="text-align: center;">Dashboard</h3>
            <hr>
        </div>
    </div>
    <div class="info-data">
        <div class="card">
            <div class="head">
                <div>
                    <h2>{{number_format($user)}}</h2>
                    <p>USER</p>
                </div>
                <i class='bx bxs-user-plus icon'></i>
            </div>
        </div>
        <div class="card">
            <div class="head">
                <div>
                    <h2>{{number_format($korcam)}}</h2>
                    <p>KORCAM</p>
                </div>
                <i class='bx bxs-bank icon' ></i>
            </div>
        </div>
        <div class="card">
            <div class="head">
                <div>
                    <h2>{{number_format($korhan)}}</h2>
                    <p>KORHANS</p>
                </div>
                <i class='bx bxs-school icon' ></i>
            </div>
        </div>
        <div class="card">
            <div class="head">
                <div>
                    <h2>{{number_format($kortps)}}</h2>
                    <p>KORTPS</p>
                </div>
                <i class='bx bx-home icon' ></i>
            </div>

        </div>
        <div class="card">
            <div class="head">
                <div>
                    <h2>{{number_format($anggota)}}</h2>
                    <p>ANGGOTA</p>
                </div>
                <i class='bx bxs-user icon' ></i>
            </div>
        </div>
        <div class="card">
            <div class="head">
                <div>
                    <h2>{{number_format($verifikasi)}}</h2>
                    <p>ANGGOTA BERHASIL VERIFIKASI</p>
                </div>
                <i class='bx bxs-user-check icon' ></i>
            </div>
        </div>
    </div>

    <div class="data">
        <div class="content-data">
            {{-- <div class="head"> --}}
				<div class="menu d-flex justify-content-end">
					<div class="row">
						<div class="col">
						</div>
					</div>
					{{-- <div class="head">
						<div class="menu">
							<i class='bx bx-dots-horizontal-rounded icon'></i>
							<ul class="menu-link">
								<li><a href="#">PDF</a></li>
								<li><a href="#">Excel</a></li>
							</ul>
						</div>
					</div> --}}
				</div>
				
            {{-- </div> --}}
            <div>
                {!! $chart->container() !!}
                {{-- <table class="table" style="zoom: 0.7">
                    <thead>
                        <tr>
                            <th scope="col">Nama & Phone</th>
                            <th scope="col">No KTP</th>
                            <th scope="col">Tempat/Tgl Lahir</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">RT/RW</th>
                            <th scope="col">Kelurahan / Kecamatan</th>
                            <th scope="col">Bertugas</th> 
                            <th scope="col">Keterangan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Dibuat</th>
                            <th scope="col">TPS</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                </table> --}}
            </div>
            
        </div>
    </div>
    <script src="{{ $chart->cdn() }}"></script>

    {{ $chart->script() }}
@endsection
