@extends('partials.app')

@section('title', 'Users - Pengguna')
@section('content')
<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-users"></i> Pengguna</h1>
@include('partials.messages')
<div class="row">
   <div class="col-md-6">
      <a href="{{ route('admin.user.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data</a>
      <a href="{{ route('export.users.admin') }}" data-toggle="tooltip" data-placement="top" title="Cetak Excel" class="btn btn-success"><i class="fas fa-file-excel"></i></a>
      <a href="{{ route('pdf.users.admin') }}" data-toggle="tooltip" data-placement="top" title="Cetak PDF" class="btn btn-danger"><i class="fas fa-file-pdf"></i></a>
   </div>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTableAll" width="100%" cellspacing="0">
            <thead class="text-center">
                <tr>
                    <th width="20px">No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Akses</th>
                    <th>Status</th>
                    <th style="width: 20px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
               @php
               $no = 1;
               @endphp
               @foreach($users as $key => $user)
               <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $user->fullname }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->role }}</td>
                  <td>
                     @if($user->is_active == 0)
                        <span class="badge badge-danger btn-sm">Tidak Aktif</span>
                     @elseif($user->is_active == 1)
                        <span class="badge badge-success btn-sm">Aktif</span>
                     @endif
                  </td>
                  <td>
                     <a href="{{ url('admin/user/edit/' . $user->id) }}" class="btn btn-info btn-block mb-1"><i class="fas fa-edit"></i></a>
                     @if($user->is_active == 0)
                     <a href="{{ route('isActive.users.admin', $user->id) }}" onclick="return confirm('Yakin ?')" class="btn btn-success btn-block mb-1" data-toggle="tooltip" data-placement="top" title="Aktifkan"><i class="fas fa-check"></i></a>
                     @elseif($user->is_active == 1)
                     <a href="{{ route('isNonActive.users.admin', $user->id) }}" onclick="return confirm('Yakin ?')" class="btn btn-warning btn-block mb-1" data-toggle="tooltip" data-placement="top" title="Non Aktifkan"><i class="fas fa-times"></i></a>
                     @endif
                     <form action="{{ route('admin.user.destroy', $user->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-block" onclick="return confirm('Yakin ?')"><i class="fas fa-trash-alt"></i></button>
                     </form>
                  </td>
               </tr>
               @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
       {{-- <div class="col-md-6">
          {{ $users->links() }}
       </div> --}}
    </div>
</div>

@endsection