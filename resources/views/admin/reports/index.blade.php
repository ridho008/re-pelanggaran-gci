@extends('partials.app')

@section('title', 'Pelaporan Kebersihan - GCI')
@section('content')


<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-file"></i> Semua Pelaporan</h1>
@include('partials.messages')
<div class="row">
   <div class="col-md-6">
      <a href="{{ route('admin.report.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data</a>
   </div>
   <div class="col-md-6">
      @include('partials.menu-status-report')
   </div>
</div>
<div class="row mt-2">
   <div class="col-md-6">
      <a href="{{ route('excel.reports.admin') }}" data-toggle="tooltip" data-placement="top" title="Cetak Excel" class="btn btn-success"><i class="fas fa-file-excel"></i></a>
      <a href="{{ route('pdf.reports.admin') }}" data-toggle="tooltip" data-placement="top" title="Cetak PDF" class="btn btn-danger"><i class="fas fa-file-pdf"></i></a>
   </div>
   <div class="col-md-6">
      <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModalLong">
        Cetak Excel Berdasarkan Tanggal
      </button>
   </div>
</div>
<div class="row">
   <div class="col-md-12">
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                  <thead class="text-center">
                      <tr>
                          <th>No</th>
                          <th>Judul</th>
                          <th>Pelanggar</th>
                          <th>Bukti</th>
                          <th>Pelapor</th>
                          <th>Tanggal Laporan</th>
                          <th>Status</th>
                          <th style="width: 20px;">Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                     @php
                     $no = 1;
                     @endphp
                     @forelse($reports as $key => $report)
                        <tr>
                           <td>{{ $key + $reports->firstitem() }}</td>
                           <td>{{ $report->title == null ? "judul kosong" : $report->title }}</td>
                           <td>
                              @if($report->user_id == null)
                                 <p class="text-warning font-weight-bold">Belum Terkonfirmasi</p>
                              @else
                                 {{ $report->users->fullname }}
                              @endif
                           </td>
                           <td>
                              @if(!$request)
                              <span class="alert alert-danger">Format tidak sesuai</span>
                              @else
                                 @if($report->proof_fhoto)
                                 <img src="{{ asset('/assets/img/pelaporan/users/' . $report->proof_fhoto) }}" alt="{{ $report->proof_fhoto }}" width="100">
                                 @else
                                 <span class="alert-danger">Foto Belum Diupload.</span>
                                 @endif
                              
                              @endif
                           </td> 
                           <td>
                           @if($report->reporting == null)
                              <p class="text-warning font-weight-bold">Belum Terkonfirmasi</p>
                           @else
                              {{ $report->report->fullname }}
                           @endif
                           </td>
                           <td>{{ $report->reporting_date }}</td>
                           <td>
                              @if($report->status === 0)
                              <span class="alert-success">Setuju</span>
                              @elseif($report->status === 1)
                              <span class="alert-danger">Tolak</span>
                              @else
                              <span class="alert-primary">Proses Verifikasi</span>
                              @endif
                           </td>
                           <td>
                              <a href="{{ route('admin.report.edit', $report->id) }}" class="btn btn-info btn-circle btn-block mb-1"><i class="fas fa-edit"></i></a>
                              <a href="{{ route('admin.report.detail', $report->id) }}" class="btn btn-secondary btn-circle btn-block mb-1"><i class="fas fa-info"></i></a>
                              <form action="{{ route('admin.report.destroy', $report->id) }}" method="post">
                                 @csrf
                                 @method('DELETE')
                                 <button type="submit" class="btn btn-danger btn-block btn-circle" onclick="return confirm('Yakin ?')"><i class="fas fa-trash-alt"></i></button>
                              </form>
                           </td>
                        </tr>
                        @empty
                           <tr>
                              <td colspan="6" class="bg-danger text-center text-light">Data Laporan Kosong.</td>
                           </tr>
                     @endforelse
                  </tbody>
              </table>
          </div>
          <div class="row">
             <div class="col-md-6">
                {{ $reports->links() }}
             </div>
          </div>
      </div>
   </div>
</div>

<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Cetak Excel Berdasarkan Tanggal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('excel.reports.date.admin') }}" method="get">
           <div class="row">
              <div class="col-md-12">
                 <div class="form-group">
                    <label for="from_date">Dari Tanggal</label>
                    <input type="date" name="from_date" class="form-control">
                 </div>
                 <div class="form-group">
                    <label for="to_date">Hingga Tanggal</label>
                    <input type="date" name="to_date" class="form-control">
                 </div>
              </div>
           </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
           <button type="submit" class="btn btn-primary">Cari</button>
         </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection