@extends('partials.app')

@section('title', 'Admin Dashboard')
@section('content')
<h1 class="h3 mb-4 text-gray-800 title-filter">Filter Pelanggaran</h1>
<div class="row">
   <div class="col-md-6">
      <button type="button" class="btn btn-success btnActiveFilter btnok">Sedang Aktif</button>
      <button type="button" class="btn btn-danger btnNonActiveFilter">NonAktif</button>
   </div>
   <div class="col-md-2">
     <div class="form-group">
       <select name="month" id="month" class="form-control month">
        
        @for($c=0; $c<$jlh_bln; $c+=1){ 
          @if($c < 9) {
            <option value="{{ "0".$c + 1 }}">{{ $bulan[$c] }}</option>"
          @else
            <option value="{{ $c + 1 }}">{{ $bulan[$c] }}</option>"
          @endif
         @endfor
        
       </select>
       
     </div>
   </div>
   <div class="col-md-2">
     <div class="form-group">
       <select name="year" id="year" class="form-control">
        @for($i = 2020; $i <= date('Y'); $i++)
         <option value="{{ $i }}">{{ $i }}</option>
        @endfor
       </select>
     </div>
   </div>
   <div class="col-md-2">
     <input type="button" id="filter" value="Cari" class="btn btn-primary btn_search">
     <button type="button" name="refresh" id="refresh" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Muat Ulang"><i class="fa fa-spinner"></i></button>
   </div>
   {{-- <div class="row input-daterange">
       <div class="col-md-4">
           <input type="text" name="from_date" id="from_date" width="276" class="datepicker" placeholder="From Date" readonly />
       </div>
       <div class="col-md-4">
           <input type="text" name="to_date" id="to_date" width="276" class="datepicker" placeholder="To Date" readonly />
       </div>
       <div class="col-md-4">
           <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
           
       </div>
   </div> --}}
</div>
<div class="row">
   <div class="col-md-12">
      <div class="card-body">
          <div class="table-responsive tb-filter">
              <table class="table table-bordered " id="dataTableFilter" width="100%" cellspacing="0">
                 <thead class="text-center">
                     <tr>
                         <th width="20px">No</th>
                         <th>Pelaku</th>
                         <th>Email</th>
                         <th>Pelaporan</th>
                         <th>Point</th>
                         {{-- <th style="width: 20px;">Aksi</th> --}}
                     </tr>
                 </thead>
                 <tbody class="insertTable">
                   
                 </tbody>
              </table>
         </div>
   </div>
</div>
@endsection