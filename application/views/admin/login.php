<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/'; ?>bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/'; ?>plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/'; ?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/'; ?>dist/css/skins/_all-skins.min.css">
  <!-- jQuery 2.2.3 -->
  <style type="text/css">
    .login-box-body,
    .register-box-body {
      background: #1b5e20;
      padding: 20px;
      border-top: 0;
      color: #666;
    }

    .login-page,
    .register-page {
      background: #c5bba8;
    }
  </style>
  <script src="<?php echo base_url() . 'assets/'; ?>plugins/jQuery/jquery-2.2.3.min.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">

    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <!-- <p class="login-box-msg"><img src="<?php echo base_url('assets/img/1553659740762.png'); ?>" width='autoWidth' height='70px'></p> -->
      <p class="login-box-msg">
      <h2 class="text-center" style="color: white;">APLIKASI MOU MAKAN</h2>
      </p>
      <form action="<?php echo site_url('/'); ?>login/cek" method="post">
        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Username" name="username" required="required" id="username">
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Password" name="password" required="required">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <select name="akses" class="form-control">
            <option>--Pilih Akses--</option>
            <option value="karyawan">Karyawan</option>
            <option value="admin">Administrasi</option>
          </select>
        </div>
        <div class="form-group has-feedback">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Log In</button>
        </div>
      </form>

    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

  <!-- Bootstrap 3.3.6 -->
  <script src="<?php echo base_url() . 'assets/'; ?>bootstrap/js/bootstrap.min.js"></script>
  <!-- DataTables -->
  <script src="<?php echo base_url() . 'assets/'; ?>plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url() . 'assets/'; ?>plugins/datatables/dataTables.bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="<?php echo base_url() . 'assets/'; ?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url() . 'assets/'; ?>plugins/fastclick/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url() . 'assets/'; ?>dist/js/app.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url() . 'assets/'; ?>dist/js/demo.js"></script>
  <!-- page script -->
  <script>
    $(function() {
      $("#example1").DataTable();
      $("#example2").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false
      });

      $("#username").focus();
    });
  </script>
</body>

</html>