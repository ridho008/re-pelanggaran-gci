@extends('partials.app')

@section('title', 'Admin Dashboard')
@section('content')
<h1 class="h3 mb-4 text-gray-800">Admin Dashboard</h1>
<div class="row">
   <div class="col-md-6">
      <div class="card shadow">
           <!-- Card Header - Dropdown -->
           <div
               class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
               <h6 class="m-0 font-weight-bold text-primary">Grafik Karyawan Terbanyak Mendapatkan Point Bulan {{ date('M') }}</h6>
           </div>
           <!-- Card Body -->
           <div class="card-body">
               <canvas id="myChart" height="100px"></canvas>
           </div>
       </div>
   </div>
   <div class="col-md-6">
       <div class="card shadow">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Karyawan Terbanyak Mendapatkan Point Bulan {{ date('M') }}</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="{{ route('filter.admin') }}">Lihat Semua</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group">
                @forelse($employeePoint as $ep)
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ ucwords($ep->fullname) }}
                    <span class="badge badge-primary badge-pill">{{ $ep->typesSum }}</span>
                  </li>
                    @empty
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <strong>Belum ada pengguna melakukan pelanggaran. </strong>
                    </div>
                  @endforelse
                </ul>
           </div>
       </div>
   </div>
</div>

<script type="text/javascript">
    var labels =  {{ Js::from($labels) }};
    var users =  {{ Js::from($data) }};
   if(Array.isArray(labels) && Array.isArray(users)) {
       console.log(labels);
       console.log(users);

       const data = {
         labels: labels,
         datasets: [{
           label: 'Peringkat Point Terbanyak Bulan Ini',
           backgroundColor: [
           'rgba(255, 99, 132, 0.9)',
           'rgba(54, 162, 235, 0.9)',
           'rgba(255, 206, 86, 0.9)',
           'rgba(75, 192, 192, 0.9)',
           'rgba(153, 102, 255, 0.9)',
           'rgba(255, 159, 64, 0.9)'
           ],
           borderColor: [
           'rgba(255,99,132,1)',
           'rgba(54, 162, 235, 1)',
           'rgba(255, 206, 86, 1)',
           'rgba(75, 192, 192, 1)',
           'rgba(153, 102, 255, 1)',
           'rgba(255, 159, 64, 1)'
           ],
           data: users,
         }]
       };

       const config = {
         type: 'doughnut',
         data: data,
         options: {
             responsive: true,
             plugins: {
               legend: {
                 position: 'top',
               },
               title: {
                 display: true,
                 text: 'Chart.js Doughnut Chart'
               }
             }
           },
       };

      const myChart = new Chart(document.getElementById('myChart'),config);
   } else if(labels.length = 0) {
      console.log("kosong gan.");
   }
    
</script>
@endsection