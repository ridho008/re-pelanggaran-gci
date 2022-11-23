@extends('partials.app')

@section('title', 'Jenis Pelanggaran - GCI REPORT')
@section('content')
<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-list-ul"></i> Jenis Pelanggaran</h1>

@include('partials.messages')
<div class="row">
   <div class="col-md-6">
      <button type="button" class="btn btn-primary" id="formtypesVioTambah" data-toggle="modal" data-target="#typesModal">
         <i class="fas fa-plus"></i>
        Buat Laporan
      </button>
   </div>
</div>
<div class="row mt-2">
   <div class="col-md-6">
      <a href="{{ route('excel.typesV.admin') }}" data-toggle="tooltip" data-placement="top" title="Cetak Excel" class="btn btn-success"><i class="fas fa-file-excel"></i></a>
      <a href="{{ route('pdf.typesV.admin') }}" data-toggle="tooltip" data-placement="top" title="Cetak PDF" class="btn btn-danger"><i class="fas fa-file-pdf"></i></a>
   </div>
   
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTableAll" width="100%" cellspacing="0">
            <thead class="text-center">
                <tr>
                    <th width="20px">No</th>
                    <th>Pelanggaran</th>
                    <th>Point</th>
                    <th style="width: 20px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
               @forelse($typesV as $key => $tv)
                  <tr>
                     <td>{{ $key + $typesV->firstitem() }}</td>
                     <td>{{ $tv->name_violation }}</td>
                     <td>{{ $tv->sum_points }}</td>
                     <td>
                        <button type="button" data-id="{{ $tv->id }}" class="btn btn-primary formTypesVEdit" data-toggle="modal" data-target="#typesModal"><i class="fas fa-edit"></i></button>
                        <form action="{{ route('typesVio.admin.destroy', $tv->id) }}" method="post">
                         @csrf
                         @method('DELETE')
                         <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ?')"><i class="fas fa-trash"></i></button>
                        </form>
                     </td>
                  </tr>
               @empty
                  <tr>
                     <td colspan="2" class="bg-danger text-center text-light">Data Masih Kosong</td>
                  </tr>
               @endforelse
            </tbody>
        </table>
    </div>
    <div class="row">
       <div class="col-md-6">
          {{ $typesV->links() }}
       </div>
    </div>
</div>

{{-- Modal Types --}}
<div class="modal fade" id="typesModal" tabindex="-1" role="dialog" aria-labelledby="typesVioModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="typesVioModalLabel">Tambah Data Jenis Pelanggaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('typesVio.admin.store') }}" method="post">
            @csrf
            @method('post')
            <input type="hidden" name="id" value="" id="id">
           <div class="form-group">
              <label for="name_violation">Jenis Pelanggaran</label>
              <input type="text" name="name_violation" class="form-control @error('name_violation') is-invalid @enderror" id="name_violation" placeholder="Nama lengkap" value="{{ old('name_violation') }}">
              @error('name_violation')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
           </div>
           <div class="form-group">
              <label for="sum_points">Jumlah Point</label>
              <select name="sum_points" id="sum_points" class="form-control @error('sum_points') is-invalid @enderror">
                 <option value="">-- Pilih Point --</option>
                 @for($i = 1; $i <= 5; $i++)
                  <option value="{{ $i }}">{{ $i }}</option>
                 @endfor
              </select>
              @error('sum_points')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
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


@endsection