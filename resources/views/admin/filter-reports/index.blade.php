@extends('partials.app')

@section('title', 'Filter Pelaporan Point Karyawan - Report GCI')
@section('content')
<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-users"></i> Filter Pelaporan Point Karyawan</h1>
@include('partials.messages')
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTableFilterReport" width="100%" cellspacing="0">
            <thead class="text-center">
               <tr>
                   {{-- <th width="20px">No</th> --}}
                   <th>Pelaku</th>
                   <th>Email</th>
                   <th>Pelaporan</th>
                   <th>Point</th>
                   <th style="width: 20px;">Aksi</th>
               </tr>
            </thead>
            <tbody class="coba"></tbody>
        </table>
    </div>
    <div class="row">
       {{-- <div class="col-md-6">
          {{ $users->links() }}
       </div> --}}
    </div>
</div>

@endsection