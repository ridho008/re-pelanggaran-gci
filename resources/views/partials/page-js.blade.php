
<script type="text/javascript">
@if(auth()->user()->role == 'user')
  // view notif users
  var userID = $('#idUserLogin').val();
  $.ajax({
    url: `/report/getUserNotifId/${userID}`,
    method: 'GET',
    dataType: 'json',
    success:function(response){
        $('.badge-counter').html(response.count);
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

      



    });
@endif
</script>