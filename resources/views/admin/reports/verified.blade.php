@extends('partials.app')

@section('title', 'Verifikasi Laporan - GCI')
@section('content')
<script>
   $(function () {
     $('[data-toggle="tooltip"]').tooltip()
   })
</script>
<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-file"></i> Verifikasi Data Pelaporan</h1>
@include('partials.messages')
<div class="card-body">
   <div class="row">
      <div class="col-md-12">
         <div class="table-responsive">
             <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                 <thead>
                     <tr>
                         <th>No</th>
                         <th>Pelanggar</th>
                         <th>Bukti</th>
                         <th>Pelapor</th>
                         <th>Tanggal Laporan</th>
                         <th>Status</th>
                     </tr>
                 </thead>
                 <tbody>
                    @php
                    $no = 1;
                    @endphp
                    @forelse($reports as $report)
                       <tr>
                          <td>{{ $no++ }}</td>
                          <td>{{ $report->users->fullname }}</td>
                          <td>
                             @if($report->proof_fhoto != null)
                             <img src="{{ asset('assets/img/pelaporan/' . $report->proof_fhoto) }}" alt="{{ $report->proof_fhoto }}" width="100">
                             @else
                             <span class="alert-danger">Foto Belum Diupload.</span>
                             @endif
                          </td> 
                          <td>
                           @if($report->reporting == null)
                              <p class="text-warning font-weight-bold">Belum Terkonfirmasi</p>
                           @else
                           {{ $report->report->fullname }}
                           @endif
                           </td>
                          <td>{{ date('d-m-Y', strtotime($report->reporting_date)) }}</td>
                          <td>
                           {{-- <form action="{{ route('admin.report.status', $report->id) }}" method="post" class="form-inline"> --}}
                           <form action="{{ route('admin.report.status', $report->id) }}" method="post" class="form-inline">
                              @csrf
                              @method('put')
                              <input type="hidden" name="user_id" value="{{ $report->users->id }}">
                              <input type="hidden" name="typevio_id" value="{{ $report->typesViolations->sum_points }}">
                              {{-- Setujui --}}
                             @if($report->status === 0)
                             <div class="form-group">
                                <select name="status" class="form-control">
                                   <option value="">-- Status --</option>
                                   <option value="0" {{ $report->status === 0 ? "selected" : ""  }}>Setujui</option>
                                   <option value="1" {{ $report->status === 1 ? "selected" : ""  }}>Tolak</option>
                                   <option value="2" {{ $report->status === 2 ? "selected" : ""  }}>Proses Verifikasi</option>
                                </select>
                              </div>
                              <div class="form-group mx-sm-3">
                                 <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-check"></i></button>
                              </div>
                              <div class="form-group">
                                <a data-toggle="tooltip" data-placement="top" title="Detail" href="{{ route('admin.report.detail', $report->id) }}" class="btn btn-secondary btn-sm"><i class="fas fa-info"></i></a>
                             </div>
                             {{-- <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-check"></i> Setuju</a> --}}
                              {{-- Tolak --}}
                             @elseif($report->status === 1)
                             <div class="form-group">
                                <select name="status" class="form-control">
                                   <option value="">-- Status --</option>
                                   <option value="0" {{ $report->status === 0 ? "selected" : ""  }}>Setujui</option>
                                   <option value="1" {{ $report->status === 1 ? "selected" : ""  }}>Tolak</option>
                                   <option value="2" {{ $report->status === 2 ? "selected" : ""  }}>Proses Verifikasi</option>
                                </select>
                             </div>
                             <div class="form-group mx-sm-3">
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-check"></i></button>
                             </div>
                             <div class="form-group">
                                <a data-toggle="tooltip" data-placement="top" title="Detail" href="{{ route('admin.report.detail', $report->id) }}" class="btn btn-secondary btn-sm"><i class="fas fa-info"></i></a>
                             </div>
                             @else
                             <div class="form-group">
                                <select name="status" class="form-control">
                                   <option value="">-- Status --</option>
                                   <option value="0" {{ $report->status === 0 ? "selected" : ""  }}>Setujui</option>
                                   <option value="1" {{ $report->status === 1 ? "selected" : ""  }}>Tolak</option>
                                   <option value="2" {{ $report->status === 2 ? "selected" : ""  }}>Proses Verifikasi</option>
                                </select>
                              </div>
                             <div class="form-group mx-sm-3">
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-check"></i></button>
                             </div>
                             <div class="form-group">
                                <a data-toggle="tooltip" data-placement="top" title="Detail" href="{{ route('admin.report.detail', $report->id) }}" class="btn btn-secondary btn-sm"><i class="fas fa-info"></i></a>
                             </div>
                             {{-- <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-times"></i> Tolak</a> --}}
                             @endif
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
   <div class="row">
      <div class="col-md-6">
         {{ $reports->links() }}
      </div>
   </div>
</div>


@endsection