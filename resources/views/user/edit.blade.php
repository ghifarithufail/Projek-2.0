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
            <form action="{{ route('user/update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-12">
                        <label for="nama">Nama</label>
                        <div class="form-group">
                            <input id="nama" name="name" type="text" value="{{ $user->name }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3">
                        <label for="username">username</label>
                        <div class="form-group">
                            <input id="username" name="username" type="text" value="{{ $user->username }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3">
                        <label for="username">password</label>
                        <div class="form-group">
                            <input id="password" name="password" type="password"  class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3">
                        <label for="email">email</label>
                        <div class="form-group">
                            <input id="email" name="email" type="text" value="{{ $user->email }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3">
                        <label for="status">status</label>
                        <div class="form-group">
                            <select class="form-select" name="status" aria-label="Default select example" required>
                            <option value="{{$user->status}}">
                                @if ($user->status == 0)
                                    Aktif
                                @elseif ($user->status == 1)
                                    Tidak Aktif
                                @elseif ($user->status == 2)
                                    Keluar
                                @endif
                            </option>
                            <option value="0">Aktif</option>
                            <option value="1">Non Aktif</option>
                            <option value="2">Keluar</option>
                        </select>

                        </div>
                    </div>
                    <div class="col-sm-12 mt-3">
                        <label for="role">role</label>
                        <div class="form-group">
                            <select class="form-select" name="role" aria-label="Default select example" required>
                                <option value="{{$user->role}}">
                                    @if ($user->role == 1)
                                        Admin
                                    @elseif ($user->role == 2)
                                        Korcam
                                    @elseif ($user->role == 3)
                                        Korhan
                                    @elseif ($user->role == 4)
                                        Kortps
                                    @elseif ($user->role == 5)
                                        Owner
                                    @endif
                                </option>
                                <option value="2">Korcam</option>
                                <option value="1">Admin</option>
                                <option value="3">Korhan</option>
                                <option value="4">Kortps</option>
                                <option value="5">Owner</option>
                            </select>
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
