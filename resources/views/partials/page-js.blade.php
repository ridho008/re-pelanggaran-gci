
@if(auth()->user()->role == 'user')
  @if(Request::path() == 'reports')
<script type="text/javascript">
    $(function() {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      // <input type="hidden" name="_token" value="GFEtNN34mC7Md41NL2anx0WZSFaIIuNlo1t4dwv8">
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

      // $('.myImg').click(function() {
      //   // console.log('ok');
      //   // $('#myImg').attr('data-id', '');
      //   $('#getImgModal').attr('src', '');

      //   var id = $(this).data('id');
      //   console.log(id);
      //   $.ajax({
      //       url: `/report/getImg/${id}`,
      //       method: "GET",
      //       dataType: 'json',
      //       success:function(response){
      //         console.log(response)
      //           //fill data to form
      //           $('#getImgModal').attr('src', 'http://127.0.0.1:8000/assets/img/pelaporan/users/' + response.proof_fhoto);
      //       }
      //   });
      // });

      $('.formReportEdit').click(function() {
        $('#reportModalLabel').html('Edit Data Pelaporan');
        $('.modal-body form').attr('action', '{{ route('user.report.update') }}');
        $('.modal-footer button[type=submit]').html('Edit');
        $('#csrf').val('{{ csrf_token() }}');
        $('.thod input').attr('id', 'method').val('put');
        // $('#getImgModal').attr('src', '');
        // $('#myImg').attr('src', '');
        $('#see-photo').show();
        $('.form-group #output').attr('src', '');
        // $('#proof_fhoto').attr('src', '');

        

        var id = $(this).data('id');
        // console.log(id);
        $.ajax({
            url: `/report/edit/${id}`,
            method: "GET",
            dataType: 'json',
            success:function(response){
              // console.log(response)
                //fill data to form
                $('#id').val(response.id);
                $('#title').val(response.title);
                $('#description').html(response.description.replace(/<[^>]*>/g, ''));
                $('#reporting_date').val(response.reporting_date);
                $('#old_proof_fhoto').val(response.proof_fhoto);
                $('#myImg').show();

                // $('#myImg').attr('data-id', response.id);
                $('.getImgModal').attr('src', 'http://127.0.0.1:8000/assets/img/pelaporan/users/' + response.proof_fhoto);
                $('.myImg').attr('src', 'http://127.0.0.1:8000/assets/img/pelaporan/users/' + response.proof_fhoto);

                $('#viewImg span').hide();
                $('#proof_fhoto').change(function() {
                  $('#viewImg span').show();
                  // $('#viewImg').prepend(`<p class='font-weight-bold'>Ganti Foto?</p>`);
                });

                //open modal
                // $('#modal-edit').modal('show');
            }
        });

        // $.ajax({
        {{-- //   url: '{{ route('user.report.edit') }}', --}}
        //   method : 'post',
        //    dataType : 'json',
        //    data : {id: id},
        //    success: function(data) {

        //    }
        // });

        // $.get('ajax-posts/'+id+'/edit', function (data) {
        //     $('#title').val(data.title);
        //     $('#body').val(data.body);  
        // })
      });
    });
</script>
  @endif
@endif