@extends('partials.app')

@section('title', 'Users - Tambah Pengguna')
@section('content')
<h1 class="h3 mb-4 text-gray-800">Tambah Data Pengguna</h1>
<div class="card-body">
    <form action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
         <label for="email">Alamat Email</label>
         <input type="email" name="email" autofocus="on" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Masukan email" value="{{ old('email') }}">
         @error('email')
             <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
             </span>
         @enderror
      </div>
      <div class="form-group">
         <label for="fullname">Nama Lengkap</label>
         <input type="text" name="fullname" class="form-control @error('fullname') is-invalid @enderror" id="fullname" placeholder="Nama lengkap" value="{{ old('fullname') }}">
         @error('fullname')
             <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
             </span>
         @enderror
      </div>
      <div class="form-group">
         <label for="password">Password</label>
         <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Kata sandi">
         @error('password')
             <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
             </span>
         @enderror
      </div>
      <div class="form-group">
         <label for="role">Hak Akses</label>
         <select name="role" id="role" name="role" class="form-control">
            <option value="">-- Hak Akses --</option>
            <option value="0">Admin</option>
            <option value="1">User</option>
         </select>
         @error('role')
             <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
             </span>
         @enderror
      </div>
      <div class="form-group">
         <label for="is_active">Status</label>
         <select name="is_active" id="is_active" name="is_active" class="form-control">
            <option value="">-- Status --</option>
            <option value="1">Aktif</option>
            <option value="0">Tidak Aktif</option>
         </select>
         @error('status')
             <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
             </span>
         @enderror
      </div>
      <div class="form-group">
         <button type="submit" class="btn btn-primary">Tambah</button>
         <a href="{{ route('users.admin') }}" class="btn btn-secondary">Kembali</a>
      </div>
    </form>
</div>

@endsection