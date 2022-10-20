@extends('partials.app')

@section('title', 'Rincian Data Pelanggaran - Point')
@section('content')
@foreach($point as $p)
<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-info-circle"></i> Rincian Data Pelanggaran {{ $p->user->fullname }}</h1>
@include('partials.messages')
<div class="card-body">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="card-title"><strong>Pelapor</strong> {{ $p->reporting->fullname }}</h5>
                            <h5 class="card-title"><strong>Pelaku</strong> {{ $p->user->fullname }}</h5>
                            <h5 class="card-title"><strong>Status</strong>
                                @if($p->status === 0)
                                <span class="badge badge-success">Setujui</span>
                                @elseif($p->status === 1)
                                <span class="badge badge-danger">Tolak</span>
                                @else
                                <span class="badge badge-info">Proses Verifikasi</span>
                                @endif
                            </h5>
                            <h5 class="card-title"><strong>Jenis Pelanggaran</strong> {{ $p->types->name_violation }}</h5>
                            <h5 class="card-title"><strong>Point</strong> {{ $p->types->sum_points }}</h5>
                            <h5 class="card-title"><strong>Total Point</strong> {{ $p->total_point }}</h5>
                            <a href="{{ route('points.admin') }}" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Kembali"><i class="fas fa-chevron-left"></i></a>
                        </div>
                        <div class="col-md-6">
                            <img class="img-thumbnail" src="{{ asset('assets/img/pelaporan/users/'. $p->reports->proof_fhoto) }}" alt="{{ $p->reports->proof_fhoto }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection