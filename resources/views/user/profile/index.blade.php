@extends('partials.app')

@section('title', 'Profil Saya')
@section('content')
<h1 class="h3 mb-4 text-gray-800">Profil Saya</h1>
@include('partials.messages')
<div class="row">
   <div class="col-md-12">
      <div class="card-body">
         <div class="row">
            <div class="col-md-4">
               <img src="{{ asset('assets/img/' . $user->image) }}" id="output" alt="{{ $user->fullname  }}" class="img-thumbnail rounded-circle">
            </div>
            <div class="col-md-8">
               <form action="{{ route('updateProfile', $user->id) }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="old_image" required value="{{ old('image', $user->image) }}">
                  @error('old_image')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
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
                     <label for="image">Foto</label>
                     <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror" accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                     @error('image')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <button type="submit" class="btn btn-primary">Perbarui</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection