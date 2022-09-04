@extends('partials.app')

@section('title', 'Users - Pengguna')
@section('content')
<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-users"></i> Pengguna</h1>
@include('partials.messages')
<div class="row">
   <div class="col-md-6">
      <a href="{{ route('admin.user.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data</a>
   </div>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Akses</th>
                    <th style="width: 20px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
               @foreach($users as $key => $user)
               <tr>
                  <td>{{ $key + $users->firstitem() }}</td>
                  <td>{{ $user->fullname }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->role }}</td>
                  <td>
                     <a href="{{ url('admin/user/edit/' . $user->id) }}" class="btn btn-info btn-block mb-1"><i class="fas fa-edit"></i></a>
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
       <div class="col-md-6">
          {{ $users->links() }}
       </div>
    </div>
</div>

@endsection