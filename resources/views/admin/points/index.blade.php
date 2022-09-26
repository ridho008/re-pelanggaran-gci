@extends('partials.app')

@section('title', 'Point - Pelanggaran Semua Pengguna')
@section('content')
<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-list"></i> Point Pelanggaran</h1>
@include('partials.messages')
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead class="text-center">
                <tr>
                    <th width="20px">No</th>
                    <th>Pelaku</th>
                    <th>Pelapor</th>
                    <th>Pelanggaran</th>
                    <th>Point</th>
                    <th>Total</th>
                    <th style="width: 20px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
               @forelse($points as $key => $point)
                <tr>
                    <td>{{ $key + $points->firstitem() }}</td>
                    <td>{{ $point->user->fullname }}</td>
                    <td>{{ $point->reporting->fullname }}</td>
                    <td>{{ $point->types->name_violation }}</td>
                    <td>{{ $point->types->sum_points }}</td>
                    <td>{{ $point->total_point }}</td>
                    <td>
                        <a href="{{ route('point.admin.detail', $point->id) }}" class="btn btn-info mb-1"><i class="fas fa-eye"></i></a>
                        <form action="{{ route('point.admin.destroy', $point->id) }}" method="post">
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
          {{ $points->links() }}
       </div>
    </div>
</div>

@endsection