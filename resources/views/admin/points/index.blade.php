@extends('partials.app')

@section('title', 'Point - Pelanggaran Semua Pengguna')
@section('content')
<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-users"></i> Point Pelanggaran</h1>
@include('partials.messages')
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead class="text-center">
                <tr>
                    <th width="20px">No</th>
                    <th>Nama</th>
                    <th>Point</th>
                    <th>Total</th>
                    <th style="width: 20px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
               
            </tbody>
        </table>
    </div>
    <div class="row">
       <div class="col-md-6">
          {{-- {{ $users->links() }} --}}
       </div>
    </div>
</div>

@endsection