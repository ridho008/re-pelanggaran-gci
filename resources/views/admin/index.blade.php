@extends('partials.app')

@section('title', 'Admin Dashboard')
@section('content')
<h1 class="h3 mb-4 text-gray-800">Admin Dashboard</h1>
@php
date_default_timezone_set("Asia/Jakarta");
// echo date_default_timezone_get();
@endphp
<div class="row">
   <div class="col-md-6">
      <div class="card shadow mb-4">
           <!-- Card Header - Dropdown -->
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
                       <a class="dropdown-item" href="#">Action</a>
                       <a class="dropdown-item" href="#">Another action</a>
                       <div class="dropdown-divider"></div>
                       <a class="dropdown-item" href="#">Something else here</a>
                   </div>
               </div>
           </div>
           <!-- Card Body -->
           <div class="card-body">
               <canvas id="myChart" height="100px"></canvas>
           </div>
       </div>
   </div>
   </div>
</div>

<script type="text/javascript">
    var labels =  {{ Js::from($labels) }};
    var users =  {{ Js::from($data) }};

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

    const myChart = new Chart(
            document.getElementById('myChart'),
        config
    );
</script>
@endsection