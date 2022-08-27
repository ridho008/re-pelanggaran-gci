@extends('partials.app')

@section('title', 'Verifikasi Laporan - GCI')
@section('content')
<div class="card-body">
   <div class="row">
      <div class="col-md-12">
         <div class="table-responsive">
             <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                 <thead>
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
                    @forelse($reports as $report)
                       <tr>
                          <td>{{ $no++ }}</td>
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
                             @else
                             <span class="alert-warning">Tolak</span>
                             @endif
                          </td>
                          <td>
                             <a href="{{ route('admin.report.edit', $report->id) }}" class="btn btn-info btn-block mb-1"><i class="fas fa-edit"></i></a>
                             <form action="{{ route('admin.report.destroy', $report->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-block" onclick="return confirm('Yakin ?')"><i class="fas fa-trash-alt"></i></button>
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
      </div>
   </div>
</div>
@endsection