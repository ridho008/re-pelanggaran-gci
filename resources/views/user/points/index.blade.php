@extends('partials.app')

@section('title', 'Point Saya')
@section('content')
<h1 class="h3 mb-4 text-gray-800">Pelanggaran Saya</h1>
@include('partials.messages')
<div class="row">
   @forelse($points as $point)
   <div class="col-md-4">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">{{ $point->reports->title }}</h6>
          </div>
          <div class="card-body">
              <ul class="list-group list-group-flush">
                  <li class="list-group-item"><strong>Status</strong> 
                    @if($point->status == 2)
                       <span class="badge badge-info">Proses Verifikasi</span>
                    @elseif($point->status == 0)
                       <span class="badge badge-success">Setuju</span>
                    @elseif($point->status == 1)
                       <span class="badge badge-danger">Tolak</span>
                    @endif
                   </li>
                  <li class="list-group-item"><strong>Tanggal Pelaporan</strong> {{ date('d-m-Y', strtotime($point->reports->reporting_date)) }}</li>
                  {{-- <li class="list-group-item"><strong>Pelaku</strong>
                    @if($point->user_id == null || $point->user_id == 0)
                       <span class="text-warning">Belum Terkonfirmasi</span>
                       @else
                       {{ $point->users->fullname }}
                    @endif
                  </li> --}}
                </ul>
                <div class="card-body text-center">
                   <button type="button" data-id="{{ $point->id }}" class="btn btn-info btn-sm formMyPointDetail" data-toggle="modal" data-target="#myPointDetailModal"><i class="fas fa-info"></i> Rincian</button>
                 </div>
          </div>
      </div>
   </div>
   @empty
      <div class="row">
         <div class="col-md-12 mt-4">
            <div class="alert alert-warning"><i class="fas fa-exclamation-circle"></i> <strong>Peringatan</strong>, Point masih kosong.</div>
         </div>
      </div>
   @endforelse
</div>
<div class="row">
   <div class="col-md">
      {{ $points->links() }}
   </div>
</div>

<div class="modal fade" id="myPointDetailModal" tabindex="-1" role="dialog" aria-labelledby="myPointDetailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myPointDetailModalLabel">Rincian Point</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div class="row">
            <div class="col-md-6">
               <img src="" class="img-thumbnail getImgPoint">
               <input type="hidden" value="{{ url('/') }}" class="base-url">
            </div>
            <div class="col-md-6">
               <ul class="list-group list-group-flush">

                 <li class="list-group-item title">Judul</li>
                 <li class="list-group-item point">Point</li>
                 <li class="list-group-item violation">Pelanggaran</li>
                 <li class="list-group-item description">Deskripsi</li>
                 <li class="list-group-item reporting_date">Tanggal Pelaporan</li>
                 <li class="list-group-item reply_comment">Pesan</li>
               </ul>
            </div>
         </div>
      </div>
    </div>
  </div>
</div>
@endsection