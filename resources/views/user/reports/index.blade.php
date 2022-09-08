@extends('partials.app')

@section('title', 'Pelaporan Kebersihan - GCI')
@section('content')

<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-file"></i> Pelaporan</h1>
@include('partials.messages')
<div class="row">
   <div class="col-md-6">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reportModal">
        Buat Laporan
      </button>
      {{-- <a href="{{ route('user.report.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> </a> --}}
   </div>
   
</div>
<div class="row">
   @forelse($reports as $report)
   <div class="col-md-4 mt-4">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $report->title }}</h6>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Status</strong> {{ $report->status == 2 ? "Proses Verifikasi" }}</li>
                <li class="list-group-item">{{ date('d-m-Y', strtotime($report->reporting_date)) }}</li>
                <li class="list-group-item"><strong>Pelaku</strong></li>
              </ul>
        </div>
    </div>
   </div>
   @empty
   <div class="alert alert-warning">Pelaporan masih kosong.</div>
   @endforelse
</div>
<div class="row">
   <div class="col">
      <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="reportModalLabel">Buat Pelaporan Pelanggaran</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{ route('user.report.create') }}" method="post" enctype="multipart/form-data">
                 @csrf
                 @method('post')
                 <div class="row">
                    <div class="col-md-6">
                       <div class="form-group">
                           <label for="title">Judul Pelanggaran</label>
                           <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" autofocus="on">
                           @error('title ')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                           @enderror
                        </div>
                        <div class="form-group">
                           <label for="description">Keterangan</label>
                           <textarea name="description" class="form-group" id="editor1" cols="30" rows="10" value="{{ old('description') }}"></textarea>
                           @error('description')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                           @enderror
                        </div>
                        <div class="form-group">
                           <label for="proof_fhoto">Bukti Foto</label>
                           <input type="file" name="proof_fhoto" class="form-control-file @error('proof_fhoto') is-invalid @enderror"  accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                           @error('proof_fhoto')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Pelapor</label>
                            <p>{{ auth()->user()->fullname }}</p>
                         </div>
                       
                       <div class="form-group">
                          <label for="reporting_date">Tanggal Lihat Pelanggaran</label>
                          <input type="date" name="reporting_date" class="form-control @error('reporting_date') is-invalid @enderror" value="{{ old('reporting_date', date('Y-m-d')) }}">
                          @error('reporting_date ')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                       </div>
                       <div class="form-group">
                          <img src="" class="img-thumbnail rounded-circle" id="output">
                       </div>
                    </div>
                 </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
   </div>
</div>
@endsection