@extends('partials.app')

@section('title', 'Ubah Data Pelaporan - GCI')
@section('content')


<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-file"></i> Ubah Data Pelaporan</h1>

<div class="card-body">
    <div class="row">
       <div class="col-md-8">
          <form action="{{ route('admin.report.update', $report->id) }}" method="post" enctype="multipart/form-data">
             @csrf
             @method('put')
             <input type="hidden" name="old_proof_fhoto" value="{{ $report->proof_fhoto }}">
             <div class="form-group">
                <label for="title">Judul Pelanggaran</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $report->title) }}" autofocus="on">
                @error('title ')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
             </div>
             <div class="form-group">
                <label for="types_id">Jenis Pelanggaran</label>
                <select name="types_id" id="types_id" class="form-control">
                   <option value="">-- Jenis Pelanggaran --</option>
                   @forelse($typesV as $tv)
                   @isset($tv)
                     <option value="{{ $tv->id }}" {{ ($report->typesViolations->id == $tv->id ? "selected" : '') }}>{{ $tv->name_violation }} - {{ $tv->sum_points }}</option>
                     @endisset
                   @empty
                   <option value="">masih kosong</option>
                   @endforelse
                </select>
                @error('types_id ')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
             </div>
             <div class="form-group">
                <label for="user_id">Pengguna</label>
                <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror">
                   <option value="">-- Pilih Pengguna --</option>
                   @forelse($user as $u)
                     <option value="{{ $u->id }}" {{ ($report->user->id == $u->id ? "selected" : '') }}>{{ $u->fullname }}</option>
                   @empty
                   @endforelse
                </select>
                @error('user_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
             </div>
             <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea name="description" class="form-group" id="editor1" cols="30" rows="10" value="{{ old('description') }}">{{ old('description', $report->description) }}</textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
             </div>
             <div class="form-group">
                <label for="reporting_date">Tanggal Lihat Pelanggaran</label>
                <input type="date" name="reporting_date" class="form-control @error('reporting_date') is-invalid @enderror" value="{{ old('reporting_date', $report->reporting_date) }}">
                @error('reporting_date ')
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
             <div class="form-group">
               <label for="status">Status</label>
               <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                  <option value="">-- Pilih Status --</option>
                  <option value="0" {{ $report->status === 0 ? "selected" : "" }}>Setujui</option>
                  <option value="2" {{ $report->status === 2 ? "selected" : "" }}>Proses Verifikasi</option>
                  <option value="1" {{ $report->status === 1 ? "selected" : "" }}>Tolak</option>
               </select>
               @error('status')
                   <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
               @enderror
             </div>
             <div class="form-group">
               <button type="submit" class="btn btn-primary">Ubah</button>
               <a href="{{ route('reports.admin') }}" class="btn btn-secondary">Kembali</a>
             </div>
          </form>
       </div>
       <div class="col-md-4">
         <div class="form-group text-center">
            <img src="{{ asset('assets/img/pelaporan/'. $report->proof_fhoto) }}" class="img-thumbnail rounded-circle" id="output">
            <label>Bukti Foto Pelanggaran</label>
         </div>
       </div>
    </div>
</div>
@endsection