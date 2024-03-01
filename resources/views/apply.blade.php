<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Energeek The E–Government Solution</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins')}}/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('plugins')}}/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist')}}/css/adminlte.min.css">
  <link rel="stylesheet" href="{{asset('plugins')}}/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{asset('plugins')}}/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <script src="{{asset('plugins')}}/jquery/jquery.min.js"></script>
  <!-- Tempus Dominus CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet">

  <!-- Tempus Dominus JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js"></script>

</head>
<body class="hold-transition login-page">
<div class="register-box">
  <div class="register-logo">
    <img style="width: 60%;" src="https://s3-alpha-sig.figma.com/img/eff8/37f9/e35e1447f02a5942b28d1dbdd75722c5?Expires=1710115200&Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&Signature=AHponmteB9ydymSExRQ9F-WRuX4tBd0QJS0qjqt3LxwY~akFMK2vWBL0Qrst5QskB8pXqfKmBXWyW85dff5tGj64gQKUP4BomgoR7KBw2uIkPWVmGOwc-Pq003pHKq2BWkW~6vWQhQ-1LFGeq64E~a5aPL71pmu5Ctwt07qI6cvRWimY5pKQqOo6ZNuwAaYBTKStnmKM45jLHU3qFGHEcsDlg-tovYe-0mW5K01DLKRK0DiRlwsMLzA0eo8YL7q9WAnndiPQ5g3DdS86Zmvb9~e19B4iNOe3R3mVgVxlZt5oGCEvEByt~4zaba2BjEo0mFrB4hQYvrChUDfXXMSMRw__" alt="Enerheek Logo">
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Apply Lamaran</p>

      <form action="../../index.html" method="post">
        <div class="form-group">
          <label for="nama-lengkap">Nama Lengkap</label>
          <input type="text" class="form-control" id="nama-lengkap" placeholder="Moh. Sodik Fikri">
        </div>
        <div class="form-group">
          <label for="jabatan">Jabatan</label>
          <select class="form-control select2bs4" id="job" style="width: 100%;">
            <option value="" selected="selected">--- Pilih Jabatan ---</option>
            
          </select>
        </div>
        <div class="form-group">
          <label for="telepon">Telepon</label>
          <input type="text" class="form-control" id="telepon" placeholder="0858........">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" placeholder="xys@mail.com">
          <small style="color: red; display: none;" id="validate-email">Format email tidak valid!</small>
        </div>
        <div class="form-group">
          <label for="tahun-lahir">Tahun Lahir:</label>
          <div class="input-group date" id="tahun-lahir" data-target-input="nearest">
              <input type="text" class="form-control datetimepicker-input" data-target="#tahun-lahir" />
              <div class="input-group-append" data-target="#tahun-lahir" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
              </div>
          </div>
        </div>
        <div class="form-group">
          <label>Skill Set</label>
          <select class="form-control select2bs4" multiple="multiple" id="skill" data-placeholder="Select a State" style="width: 100%;">
            <!-- <option>Alabama</option>
            <option>Alaska</option>
            <option>California</option>
            <option>Delaware</option>
            <option>Tennessee</option>
            <option>Texas</option>
            <option>Washington</option> -->
          </select>
        </div>
      </form>

      <div class="social-auth-links text-center">
        <button id="apply" class="btn btn-block btn-primary">
          <!-- <i class="fab fa-facebook mr-2"></i> -->
          Apply
        </button>
      </div>

    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>

<!-- Bootstrap 4 -->
<script src="{{asset('plugins')}}/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist')}}/js/adminlte.min.js"></script>
<script src="{{asset('plugins')}}/select2/js/select2.full.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  $(function() {
    
    let State = {
      apply_rules: {
        email: true
      }
    }

    let Component = {}

    Component.active = function() {
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
  
      $('#tahun-lahir').datetimepicker(
        {
          viewMode: 'years',
          format: 'YYYY'
        }
      );

      Component.api.active()
      Component.event.active()
    }

    Component.api = {
      active: function() {
        this.getJobs()
        this.getSkills()
      },
      getJobs: function() {
        $.ajax({
          url: '/api/job/list',
          method: 'GET',
          success: function(resp) {
            if (resp.meta.code == 200) {
              $.each(resp.data, function(key, val) {
                $('#job').append(
                  `<option value='${val.id}'>${val.name}</>`
                )
              })
            }
          },
        })
      },
      getSkills: function() {
        $.ajax({
          url: '/api/skill/list',
          method: 'GET',
          success: function(resp) {
            if (resp.meta.code == 200) {
              $.each(resp.data, function(key, val) {
                $('#skill').append(
                  `<option value='${val.id}'>${val.name}</>`
                )
              })
            }
          },
        })
      },
      applyJob: function(params) {
        $.ajax({
          url: '/api/apply',
          method: 'POST',
          data: params,
          success: function(resp) {
            if (resp.meta.code == 200) {
              Component.swal.notif('Success', resp.meta.message, 'success')

              // reset form
              $('#nama-lengkap').val('')
              $('#telepon').val('')
              $('#email').val('')
              $('.datetimepicker-input').val('')
              $('#job').val('').trigger('change')
              $('#skill').val([]).trigger('change')
            } else if (resp.meta.code == 422) {
              let msg = ''
              if(resp.error.name) { msg += `${resp.error.name}<br>`}
              if(resp.error.phone) { msg += `${resp.error.phone}<br>`}
              if(resp.error.email) { msg += `${resp.error.email}<br>`}
              if(resp.error.year) { msg += `${resp.error.year}<br>`}
              if(resp.error.job_id) { msg += `${resp.error.job_id}<br>`}
              if(resp.error.skills) { msg += `${resp.error.skills}<br>`}
              Component.swal.notif('Warning', msg, 'warning')
            }
          },
          error: function () {
            Component.swal.notif('Error', 'Error please chek your code', 'error')
          }
        })
      }
    }

    Component.event = {
      active: function() {
        $('#email').on('keyup', function() {
          let rs = $('#email').val();
          if (rs == '') {
            setTimeout(() => {
              $('#validate-email').css('display', 'none')
            }, 300);
          }
    
          let atps=rs.indexOf("@");
          let dots=rs.lastIndexOf(".");
          if (atps<1 || dots<atps+2 || dots+2>=rs.length) {
            $('#validate-email').css('display', '')
            State.apply_rules = false
            return false;
          } else {
            State.apply_rules = true
            $('#validate-email').css('display', 'none')
          }
        })
        
        this.applied()
      },
      applied: function() {
        $('#apply').on('click', function() {
          let params = {
            'name': $('#nama-lengkap').val(),
            'phone': $('#telepon').val(),
            'email': $('#email').val(),
            'year': $('.datetimepicker-input').val(),
            'job_id': $('#job').val(),
            'skills': $('#skill').val(),
          }
          console.log(params);
          if (!State.apply_rules) {
            Component.swal.notif('Warning', 'Invalid email format', 'warning')
            return false;
          }
          Component.api.applyJob(params)
        })
      }
    }

    Component.swal = {
      notif: function (title, message, icon) {
        Swal.fire({
          title: title,
          html: message,
          icon: icon
        });
      }
    }

    Component.active()

  })
</script>
</body>
</html>
