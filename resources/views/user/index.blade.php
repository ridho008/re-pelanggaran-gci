@extends('partials.app')

@section('title', 'User Dashboard')
@section('content')
<h1 class="h3 mb-4 text-gray-800">User Dashboard</h1>
@foreach($menuStatus as $ms)
@if($ms->menu_report_status == 1)
   <div class="alert alert-warning" role="alert">
      <i class="fa fa-exclamation-circle"></i>
     Akun anda tidak bisa mengirim laporan, karena telah melakukan pelanggaran lebih dari jumlah yang ditentukan oleh perusahaan. 
   </div>
@endif
@endforeach
@endsection