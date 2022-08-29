@extends('partials.app')

@section('title', 'Perincian Data Pelaporan '. "$report->fullname" .' - GCI')
@section('content')


{{-- <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-file"></i> </h1> --}}
<div class="card-body">
    <div class="row">
       <div class="col-md-8">
          <div class="card border-left-info shadow h-100 py-2">
               <div class="card-body">
                   <div class="row no-gutters align-items-center">
                       <div class="col mr-2">
                           <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                           <h3>Perincian Data Pelaporan <strong> {{ $report->fullname }}</strong></h3>
                           @include('partials.messages')
                              <div class="row">
                                 <div class="col-md-4">
                                    <div class="h6 mb-0 font-weight-bold text-gray-800">Nama Lengkap</div>
                                    <p>{{ $report->fullname }}</p>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="h6 mb-0 font-weight-bold text-gray-800">Tanggal Pelaporan</div>
                                    <p>{{ date('d-m-Y', strtotime($report->reporting_date)) }}</p>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="h6 mb-0 font-weight-bold text-gray-800">Status</div>
                                    <p>
                                       @if($report->status === 0)
                                       <span class="alert-success">Setuju</span>
                                       @else
                                       <span class="alert-warning">Tolak</span>
                                       @endif
                                    </p>
                                 </div>
                              </div>
                           </div>
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="h6 mb-0 font-weight-bold text-gray-800">Isi Laporan Pelanggaran</div>
                                    <p>
                                       {{ strip_tags($report->description) }}
                                    </p>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="h6 mb-0 font-weight-bold text-gray-800">Balasan</div>
                                    <p>
                                       {{ strip_tags($report->reply_comment) }}
                                    </p>
                                 </div>
                                 <div class="row">
                                    <div class="col">
                                       <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#replyModal">
                                         Balas
                                       </button>
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
          <img src="{{ asset('assets/img/pelaporan/'. $report->proof_fhoto) }}" class="img-thumbnail rounded-circle">
            <label>Bukti Foto Pelanggaran</label>
       </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="replyModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="replyModalLabel">Balas Pelaporan {{ $report->fullname }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{ route('admin.report.comment', $report->id) }}" method="post">
               @csrf
               @method('post')
               <div class="form-group">
                  <label><strong>Isi Laporan Pelanggaran</strong></label>
                  <p>{{ $report->description }}</p>
               </div>
               <div class="form-group">
                  <label for="reply"><strong>Balas Pesan</strong></label>
                  <textarea name="reply" id="editor1" cols="30" rows="10" class="form-control @error('user_id') is-invalid @enderror">{{ old('reply') }}</textarea>
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
</div>
@endsection