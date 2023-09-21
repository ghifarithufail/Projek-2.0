@extends('layout.index')
@section('content')

    {{-- <h1 class="title text-center">Koordinator Kecamatan</h1> --}}


    <div class="data">
        <div class="content-data">

            <h3 style="text-align: center;">Tambah User</h3>
        </div>
    </div>

    <div class="data">
        <div class="content-data">
            {{-- <div class="head"> --}}
            {{-- <div class="menu d-flex justify-content-end">
					<div class="row">
						<div class="col">
							<div class="text-right">
								<button type="button" class="btn btn-success">Tambah +</button>
							</div>
						</div>
					</div>
					<div class="head">
						<div class="menu">
							<i class='bx bx-dots-horizontal-rounded icon'></i>
							<ul class="menu-link">
								<li><a href="#">PDF</a></li>
								<li><a href="#">Excel</a></li>
							</ul>
						</div>
					</div>
				</div> --}}

            {{-- </div> --}}
            <form action="{{ route('user/store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-12">
                        <label for="nama">Nama</label>
                        <div class="form-group">
                            <input id="nama" name="name" type="text" value="{{ old('name') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3">
                        <label for="username">username</label>
                        <div class="form-group">
                            <input id="username" name="username" type="text" value="{{ old('username') }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3">
                        <label for="username">password</label>
                        <div class="form-group">
                            <input id="password" name="password" type="text" value="{{ old('password') }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3">
                        <label for="email">email</label>
                        <div class="form-group">
                            <input id="email" name="email" type="text" value="{{ old('email') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3">
                        <label for="status">status</label>
                        <div class="form-group">
                            <input id="status" name="status" type="text" value="{{ old('status') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3">
                        <label for="role">role</label>
                        <div class="form-group">
                            <input id="role" name="role" type="text" value="{{ old('role') }}" class="form-control">
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-block form-control text-white" >Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
