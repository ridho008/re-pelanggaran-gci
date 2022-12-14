<a href="{{ route('admin.report.agree') }}" class="btn btn-success btn-sm float-right ml-1 {{ (Request::path() == 'admin/report/agree' ? 'active' : '') }} mt-1"><i class="fas fa-check-circle"></i> Setujui</a>
<a href="{{ route('admin.report.verification') }}" class="btn btn-info btn-sm float-right ml-1 {{ (Request::path() == 'admin/report/verification' ? 'active' : '') }} mt-1"><i class="fas fa-clipboard-list"></i> Proses Verifikasi</a>
<a href="{{ route('admin.report.reject') }}" class="btn btn-danger btn-sm float-right ml-1 {{ (Request::path() == 'admin/report/reject' ? 'active' : '') }} mt-1"><i class="fas fa-times-circle"></i> Tolak</a>
<a href="{{ route('reports.admin') }}" class="btn mt-1 btn-secondary btn-sm float-right ml-1 {{ (Request::path() == 'admin/reports' ? 'active' : '') }} mt-1"><i class="fas fa-border-all"></i> Lihat Semua</a>
<span class="float-right mt-2 mr-2"><i class="fas fa-bars"></i> Semua</span>
