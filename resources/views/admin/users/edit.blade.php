@extends('partials.app')

@section('title', 'Users - Edit Pengguna')
@section('content')
<h1 class="h3 mb-4 text-gray-800">Edit Pengguna {{ $user->fullname }}</h1>

<div class="card-body">
    <form action="{{ route('admin.user.update', $user->id) }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
         <label for="email">Alamat Email</label>
         <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Masukan email" value="{{ old('email', $user->email) }}">
         @error('email')
             <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
             </span>
         @enderror
      </div>
      <div class="form-group">
         <label for="fullname">Nama Lengkap</label>
         <input type="text" name="fullname" class="form-control @error('fullname') is-invalid @enderror" id="fullname" placeholder="Nama lengkap" value="{{ old('fullname', $user->fullname) }}">
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
            <option value="0" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="1" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
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
            <option value="1" {{ $user->is_active == 1 ? 'selected' : '' }}>Aktif</option>
            <option value="0" {{ $user->is_active == 0 ? 'selected' : '' }}>Tidak Aktif</option>
         </select>
         @error('status')
             <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
             </span>
         @enderror
      </div>
      <div class="form-group">
         <button type="submit" class="btn btn-primary">Ubah</button>
         <a href="{{ route('users.admin') }}" class="btn btn-secondary">Kembali</a>
      </div>
    </form>
</div>

@endsection