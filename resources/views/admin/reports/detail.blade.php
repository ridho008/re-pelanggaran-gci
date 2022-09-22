@extends('partials.app')
@php
// $titleDetail = $report->users->fullname;
@endphp
@section('title', 'Perincian Data Pelaporan '. "" .' - GCI')
@section('content')


{{-- <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-file"></i> </h1> --}}
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<div class="card-body">
    <div class="row">
       <div class="col-md-8">
          <div class="card border-left-info shadow h-100 py-2">
               <div class="card-body">
                   <div class="row no-gutters align-items-center">
                       <div class="col mr-2">
                           @foreach($report as $r)
                           <div class="text-xs font-weight-bold text-uppercase mb-1">
                           <h3 class="text-success">Perincian Data Pelaporan <strong> 
                              
                              @if($r->reporting == null)
                              <p class="text-warning font-weight-bold">Belum Terkonfirmasi</p>
                              @else
                              {{ $r->report->fullname }}
                              @endif
                           </strong></h3>
                           @include('partials.messages')
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="h6 mb-0 font-weight-bold text-gray-800">Judul Pelanggaran</div>
                                    <p>{{ $r->title }}</p>
                              </div>
                           </div>
                              <div class="row">
                                 <div class="col-md-4">
                                    <div class="h6 mb-0 font-weight-bold text-gray-800">Nama Pelanggaran</div>
                                    @if($r->user_id == null)
                                       <p class="text-warning font-weight-bold">Belum Terkonfirmasi</p>
                                    @else
                                       {{ $r->users->fullname }}
                                    @endif
                                 </div>
                                 <div class="col-md-4">
                                    <div class="h6 mb-0 font-weight-bold text-gray-800">Tanggal Pelaporan</div>
                                    <p>{{ date('d-m-Y', strtotime($r->reporting_date)) }}</p>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="h6 mb-0 font-weight-bold text-gray-800">Status</div>
                                    <p>
                                       @if($r->status === 0)
                                       <span class="alert-success">Setujui</span>
                                       @elseif($r->status === 1)
                                       <span class="alert-danger">Tolak</span>
                                       @else
                                       <span class="alert-info">Proses Verifikasi</span>
                                       @endif
                                    </p>
                                 </div>
                              </div>
                           </div>
                              <div class="row">
                                 <div class="col-md-4">
                                    <div class="h6 mb-0 font-weight-bold text-gray-800">Isi Laporan Pelanggaran</div>
                                    <p>
                                       {{ strip_tags($r->description) }}
                                    </p>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="h6 mb-0 font-weight-bold text-gray-800">Pelapor</div>

                                    @if($r->reporting == null)
                                    <p class="text-warning font-weight-bold">Belum Terkonfirmasi</p>
                                    @else
                                    {{ $r->report->fullname }}
                                    @endif
                                 </div>
                                 @if($r->reply_comment != null)
                                 <div class="col-md-4">
                                    <div class="h6 mb-0 font-weight-bold text-gray-800">Balasan</div>
                                    <p>
                                       {{ strip_tags($r->reply_comment) }}
                                    </p>
                                 </div>
                                 @endif
                              </div>
                              <div class="row">
                                 <div class="col-md-2">
                                    <form action="{{ route('admin.report.detail.status', $r->id) }}" method="post" class="form-inline">
                                       @csrf
                                       @method('put')
                                       <div class="form-group">
                                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#replyModal">
                                            Balas
                                          </button>
                                       </div>
                                    </form>
                                 </div>
                                 <div class="col-md-2">
                                    <form action="{{ route('admin.report.detail.buttonAgreeAdmin', $r->id) }}" method="post" class="form-inline">
                                       @csrf
                                       @method('put')
                                       <div class="form-group">
                                          <button type="submit" class="btn btn-primary" onclick="return confirm('Yakin ?')"><i class="fas fa-check"></i> Setujui</button>
                                       </div>
                                    </form>
                                 </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                       <a href="{{ route('reports.admin') }}" class="btn btn-secondary">Kembali</a>
                                    </div>
                                 </div>
                              </div>
                              
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <div class="col-md-4 text-center">
          {{-- <img src="{{ asset('assets/img/pelaporan/'. $report->proof_fhoto) }}" class="img-thumbnail rounded-circle"> --}}
           <!-- Trigger the Modal -->
          <img id="myImg" class="rounded-circle" src="{{ asset('assets/img/pelaporan/'. $r->proof_fhoto) }}" alt="{{ $r->proof_fhoto }}" style="width:100%;max-width:300px">
  
          <!-- The Modal -->
          <div id="myModal" class="modal-photo">

            <!-- The Close Button -->
            <span class="close">&times;</span>

            <!-- Modal Content (The Image) -->
            <img class="modal-content-photo" id="img01">

            <!-- Modal Caption (Image Text) -->
            <div id="caption"></div>
          </div> 
            <label>Bukti Foto Pelanggaran</label>
       </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="replyModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="replyModalLabel">Balas Pelaporan {{ $r->fullname }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{ route('admin.report.comment', $r->id) }}" method="post">
               @csrf
               @method('post')
               <div class="form-group">
                  <label><strong>Isi Laporan Pelanggaran</strong></label>
                  <p>{{ strip_tags($r->description) }}</p>
               </div>
               <div class="form-group">
                  <label for="reply"><strong>Balas Pesan</strong></label>
                  <textarea name="reply" id="editor1" cols="30" rows="10" class="form-control @error('user_id') is-invalid @enderror">{{ old('reply', $r->reply_comment) }}</textarea>
                  @error('reply')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
               </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    @endforeach
</div>
<script src="{{ asset('assets/js/script.js') }}"></script>
@endsection