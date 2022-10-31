@extends('partials.app')

@section('title', 'Admin Dashboard')
@section('content')
<h1 class="h3 mb-4 text-gray-800 title-filter">Filter Pelanggaran</h1>
<div class="row">
   <div class="col-md-6">
      <button type="button" class="btn btn-success btnActiveFilter btnok">Sedang Aktif</button>
      <button type="button" class="btn btn-danger btnNonActiveFilter">NonAktif</button>
   </div>
   <div class="col-md-6">
     <div class="form-group">
       <input type="date" readonly id="search_fromdate" class="datepicker" placeholder="From date">
     </div>
     <div class="form-group">
       <input type="date" readonly id="search_todate" class="datepicker" placeholder="To date">
     </div>
     <div class="form-group">
       <input type='button' id="btn_search" value="Search" class="btn btn-primary">
     </div>
   </div>
</div>
<div class="row">
   <div class="col-md-12">
      <div class="card-body">
          <div class="table-responsive tb-filter">
              <table class="table table-bordered " id="dataTableFilter" width="100%" cellspacing="0">
                 <thead class="text-center">
                     <tr>
                         <th width="20px">No</th>
                         <th>Nama</th>
                         <th>Email</th>
                         <th>Akses</th>
                         <th>Status</th>
                         <th>Pelaporan</th>
                         <th>Point</th>
                         <th style="width: 20px;">Aksi</th>
                     </tr>
                 </thead>
                 <tbody class="insertTable">
                   
                 </tbody>
              </table>
         </div>
   </div>
</div>
@endsection