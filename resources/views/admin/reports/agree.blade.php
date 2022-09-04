@extends('partials.app')

@section('title', 'Pelaporan Kebersihan - GCI')
@section('content')


<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-file"></i> Pelaporan</h1>
@include('partials.messages')
<div class="row">
   <div class="col-md-6">
      <a href="{{ route('admin.report.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data</a>
   </div>
   <div class="col-md-6">
      <a href="{{ route('admin.report.agree') }}" class="btn btn-success float-right ml-1"><i class="fas fa-check"></i> Setujui</a>
      <a href="" class="btn btn-info float-right ml-1">Proses Verifikasi</a>
      <a href="" class="btn btn-danger float-right ml-1">Tolak</a>
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
                          <th>Pengguna</th>
                          <th>Bukti</th>
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
                           <td>{{ $report->fullname }}</td>
                           <td>
                              @if($report->proof_fhoto != null)
                              <img src="{{ asset('assets/img/pelaporan/' . $report->proof_fhoto) }}" alt="{{ $report->proof_fhoto }}" width="100">
                              @else
                              <span class="alert-danger">Foto Belum Diupload.</span>
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

@endsection