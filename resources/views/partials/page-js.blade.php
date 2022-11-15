
<script type="text/javascript">
$('[data-toggle="tooltip"]').tooltip();
// Logout
$('#modalLogout').click(function() {
  $('.buttonLogout').html('Keluar');
});


@if(auth()->user()->role == 'admin')
  // DATATABLES
  
  // var table = $('#dataTable').DataTable({
  //     initComplete: function () {
  //         // Apply the search
  //         this.api()
  //             .columns()
  //             .every(function () {
  //                 var that = this;

  //                 $('input', this.footer()).on('keyup change clear', function () {
  //                     if (that.search() !== this.value) {
  //                         that.search(this.value).draw();
  //                     }
  //                 });
  //             });
  //     },
  // });

  $('#formtypesVioTambah').click(function() {
    $('#typesVioModalLabel').html('Tambah Data Jenis Pelanggaran');
    $('.modal-body form').attr('action', '{{ route('typesVio.admin.store') }}');
    $('.modal-footer button[type=submit]').html('Simpan');
    $('#sum_points option').prop('selected', false);
    $('#name_violation').val('');
    $('#csrf').val('{{ csrf_token() }}');
    $('.modal-body input[name=_method]').val('post');
  });

  $('.formTypesVEdit').click(function() {
    $('#typesVioModalLabel').html('Ubah Data Jenis Pelanggaran');
    $('.modal-body form').attr('action', '{{ route('typesVio.admin.update') }}');
    $('.modal-footer button[type=submit]').html('Ubah');
    $('#csrf').val('{{ csrf_token() }}');
    $('.modal-body input[name=_method]').val('put');

    var id = $(this).data('id');
    console.log(id);

    $.ajax({
        url: `/admin/typesvio/edit/${id}`,
        method: "GET",
        dataType: 'json',
        success:function(response){
          console.log(response);
          $('#id').val(response.id);
          $('#name_violation').val(response.name_violation);
          $('#sum_points option[value="'+response.sum_points+'"]').prop('selected', true);
        }
    });
  });

  // Column Search Types Violations - Administrator
  // DataTable

// Button NonActive - Menu Filter Pelanggaran
$('.btnNonActiveFilter').click(function() {
  // $('.tb-filter').empty();
  $('.btnNonActiveFilter').toggleClass('active');
  $('.title-filter').text('Filter Pelanggaran Non Aktif');
  var table = $('#dataTableFilter').DataTable().destroy();
  // table.clear().draw();
  $('#dataTableFilter').DataTable({
      processing: true,
      serverSide: true,
      searching: true,
      order: [[3, 'desc']],
      language: {
          lengthMenu: "Tampilkan _MENU_ pelaporan per halaman",
          zeroRecords: "Tidak ada yang ditemukan",
          info: "Menampilkan halaman _PAGE_ dari _PAGES_",
          infoEmpty: "Tidak ada pelaporan yang tersedia",
          infoFiltered: "(difilter dari _MAX_ total data)"
      },
      ajax: '/admin/filter-violation/nonActive', // memanggil route yang menampilkan data json
      columns: [
          {
              data: 'fullname',
              name: 'fullname',
              searchable: true,
          },
          {
              data: 'email',
              name: 'email',
              searchable: true,
          },
          {
              data: `reporting_date`,
              name: 'reporting_date'
          },
          {
              data: `sum_points`,
              name: 'sum_points'
          },
      ],
      search: {
        "regex": true
      }
  });
});

// Button Active - Menu Filter Pelanggaran
$('.btnActiveFilter').click(function() {
  // $('.tb-filter').empty();
  $('.btnActiveFilter').toggleClass('active');
  $('.title-filter').text('Filter Pelanggaran Sedang Aktif');
  var table = $('#dataTableFilter').DataTable().destroy();
  // table.clear().draw();
  $('#dataTableFilter').DataTable({
      processing: true,
      serverSide: true,
      searching: true,
      order: [[3, 'desc']],
      language: {
          lengthMenu: "Tampilkan _MENU_ pelaporan per halaman",
          zeroRecords: "Tidak ada yang ditemukan",
          info: "Menampilkan halaman _PAGE_ dari _PAGES_",
          infoEmpty: "Tidak ada pelaporan yang tersedia",
          infoFiltered: "(difilter dari _MAX_ total data)"
      },
      ajax: '/admin/filter-violation/active', // memanggil route yang menampilkan data json
      columns: [
          {
              data: 'fullname',
              name: 'fullname',
              searchable: true,
          },
          {
              data: 'email',
              name: 'email',
              searchable: true,
          },
          {
              data: `reporting_date`,
              name: 'reporting_date'
          },
          {
              data: `sum_points`,
              name: 'sum_points'
          },
      ],
      search: {
        "regex": true
      }
  });
});

// Button Search - Menu Filter Pelanggaran

load_data();

 function load_data(month = '', year = '')
 {
  $('#dataTableFilter').DataTable({
   processing: true,
   serverSide: true,
   order: [[3, 'desc']],
   language: {
        lengthMenu: "Tampilkan _MENU_ pelaporan per halaman",
        zeroRecords: "Tidak ada yang ditemukan",
        info: "Menampilkan halaman _PAGE_ dari _PAGES_",
        infoEmpty: "Tidak ada pelaporan yang tersedia",
        infoFiltered: "(difilter dari _MAX_ total data)"
    },
   ajax: {
    url: `/admin/filter-violation`,
    data:{month:month, year:year}
   },
   columns: [
    {
        data: 'fullname',
        name: 'fullname',
        searchable: true,
    },
    {
        data: 'email',
        name: 'email',
        searchable: true,
    },
    {
        data: `reporting_date`,
        name: 'reporting_date'
    },
    {
        data: `sum_points`,
        name: 'sum_points'
    },
   ]
  });
 }

 $('#filter').click(function(){
  $('.title-filter').text('Filter Pelanggaran');
  var month = $('#month').val();
  var year = $('#year').val();
  console.log(month);
  console.log(year);
  if(month != '' &&  year != '')
  {
   $('#dataTableFilter').DataTable().destroy();
   load_data(month, year);
  }
  else
  {
   alert('Both Date is required');
  }
 });

 $('#refresh').click(function(){
  $('.title-filter').text('Filter Pelanggaran');
  $('#dataTableFilter').DataTable().destroy();
  load_data();
 });



@endif

@if(auth()->user()->role == 'user')
  // $('.captcha span img').attr('style', 'width:200px;object-fit: cover;');
  // $('.imgCaptcha')
  $('#reload').click(function () {
      $.ajax({
          type: 'GET',
          url: 'reload-captcha',
          success: function (data) {
              $(".captcha span").html(data.captcha);
          }
      });
  });


  // view notif users
  var userID = $('#idUserLogin').val();
  $.ajax({
    url: `/report/getUserNotifId/${userID}`,
    method: 'GET',
    dataType: 'json',
    success:function(response){
        $('.badge-count').html(response.count);
      $.each(response.user, function(key, value) {
        var html = `<a class="dropdown-item d-flex align-items-center" href="">
                        <div>
                            <div class="small text-gray-500">${value.reporting_date}</div>
                            <span class="font-weight-bold">${value.title}</span>
                        </div>
                    </a>`;
        $('.notifUser').append(html);

      });
    }
  });
    $(function() {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $('#formReportTambah').click(function() {
          $('#reportModalLabel').html('Buat Pelaporan Pelanggaran');
          $('.modal-body form').attr('action', '{{ route('user.report.create') }}');
          $('.modal-footer button[type=submit]').html('Simpan');
          $('.thod input').attr('id', 'method').val('post');
          $('#csrf').val('{{ csrf_token() }}');
          $('#title').val('');
          $('#editor1').val('');
          $('#old_proof_fhoto').val('');
          $('#proof_fhoto').val('');
          $('#description').html('');
           $('#reporting_date').val('');
          $('#myImg').hide();
          $('#getImgModal').attr('src', '');
          $('.myImg').attr('data-id', '');
          $('#see-photo').hide();
          $('.form-group #output').show();
          $('.form-group #output').attr('src', '');
          $('#viewImg span').hide();
          $('#pelapor option').prop('selected', false);
          $('#types_id option').prop('selected', false);
       });

      $('.formReportEdit').click(function() {
        $('#reportModalLabel').html('Edit Data Pelaporan');
        $('.modal-body form').attr('action', '{{ route('user.report.update') }}');
        $('.modal-footer button[type=submit]').html('Edit');
        $('#csrf').val('{{ csrf_token() }}');
        $('.thod input').attr('id', 'method').val('put');
        $('#see-photo').show();
        $('.form-group #output').attr('src', '');

        var id = $(this).data('id');

        $.ajax({
            url: `/report/edit/${id}`,
            method: "GET",
            dataType: 'json',
            success:function(response){
                //fill data to form
                $('#id').val(response.id);
                $('#title').val(response.title);
                $('#description').html(response.description.replace(/<[^>]*>/g, ''));
                $('#reporting_date').val(response.reporting_date);
                $('#old_proof_fhoto').val(response.proof_fhoto);
                $('#myImg').show();

                $('.getImgModal').attr('src', 'http://127.0.0.1:8000/assets/img/pelaporan/users/' + response.proof_fhoto);
                $('.myImg').attr('src', 'http://127.0.0.1:8000/assets/img/pelaporan/users/' + response.proof_fhoto);

                $('#viewImg span').hide();
                $('#proof_fhoto').change(function() {
                  $('#viewImg span').show();
                });

                // selected option edit report
                $('#pelapor option[value="'+response.user_id+'"]').prop('selected', true);
                $('#types_id option[value="'+response.types_id+'"]').prop('selected', true);
                

                if(response.proof_fhoto == null) {
                  $('#see-photo').hide();
                }

            }
        });
      });

      $('.formReportDetail').click(function() {
        var id = $(this).data('id');

        $.ajax({
            url: `/report/detail/${id}`,
            method: "GET",
            dataType: 'json',
            success:function(response){
              console.log(response);
                $('.imgDetailModal').attr('src', `http://127.0.0.1:8000/assets/img/pelaporan/users/${response.data.proof_fhoto}`);
                $('.reporting_date').html(`<strong>Tanggal Pelaporan</strong> ${response.data.reporting_date}`);
                $('.title').html(`<strong>Judul</strong> ${response.data.title}`);
                $('.description').html(`<strong>Deskripsi</strong> ${response.data.description}`);
                
                $('.pelapor').html(`<strong>Pelapor</strong> ${response.fullnameReport}`);
                $('#reportDetailModalLabel').html(`<strong>Rincian</strong> ${response.data.title}`);



                if(response.data.status == 0) {
                  $('.status').html(`<strong>Status</strong> Setujui`);
                } else if(response.data.status == 1) {
                  $('.status').html(`<strong>Status</strong> Tolak`);
                } else if(response.data.status == 2) {
                  $('.status').html(`<strong>Status</strong> Proses Verifikasi`);
                }

                if(response.data.reply_comment == null) {
                  $('.reply_comment').html(`<strong>Pesan</strong> Belum ada balasan dari admin`);
                } else if(response.data.reply_comment != null) {
                  $('.reply_comment').html(`<strong>Pesan</strong> ${response.data.reply_comment}`);
                }

                if(response.fullnameUser == null) {
                  $('.user_id').html(`<strong>Pelaku</strong> <span class='text-danger'>Field pelaku wajib diisi.</span> `);
                } else if(response.fullnameUser != null) {
                  $('.user_id').html(`<strong>Pelaku</strong> ${response.fullnameUser}`);
                }

                

                $('#pelapor').change(function() {
                  var id = $(this).val();
                  $.ajax({
                    url: `/report/getUserId/${id}`,
                    method: "GET",
                    dataType: 'json',
                    success:function(data) {
                    }
                  });
                });
            }
        });
      });

      
    // Detail Point User
    $('.formMyPointDetail').click(function() {
      const id = $(this).data('id');
      console.log(id);
      var url = $('.base-url').val();

      $.ajax({
        url: `/point/getDetail/${id}`,
        method: 'GET',
        dataType: 'json',
        success:function(response){
          $('.title').html(`<strong>Judul</strong> ${response.title}`);
          $('.description').html(`<strong>Deskripsi</strong> ${response.description}`);
          $('.reporting_date').html(`<strong>Tanggal Pelaporan</strong> ${response.reporting_date}`);
          $('.point').html(`<strong>Point</strong> <button type="button" class="btn btn-circle btn-sm btn-danger">${response.point}</button>`);
          $('.violation').html(`<strong>Pelanggaran</strong> ${response.name_violation}`);
          $('.getImgPoint').attr('src', `${url}/assets/img/pelaporan/users/` + response.proof_fhoto);

          if(response.reply_comment == null) {
            $('.reply_comment').html(`<strong>Pesan</strong> <div class="text-info">tidak ada balasan.</div>`);
          } else {
            $('.reply_comment').html(`<strong>Pesan</strong> ${response.reply_comment}`);
          }
        }
      });
    });


    });
@endif
</script>