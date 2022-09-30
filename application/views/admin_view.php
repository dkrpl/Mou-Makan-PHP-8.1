<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/'; ?>bootstrap/css/bootstrap.min.css" media="screen">
  <!-- Font Awesome -->
  <!---<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" media="screen">--->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/'; ?>plugins/font-awesome/css/font-awesome.min.css" media="screen">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/'; ?>plugins/ionicons-master/css/ionicons.min.css" media="screen">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/'; ?>plugins/datatables/dataTables.bootstrap.css" media="screen">
  <!-- ss yang digunakan tampilkan ketika dalam mode print -->
  <link href="<?php echo base_url() . 'assets/'; ?>print.css" rel="stylesheet" media="print">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/'; ?>dist/css/AdminLTE.min.css" media="screen">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/'; ?>dist/css/skins/_all-skins.min.css" media="screen">
  <!-- jQuery 2.2.3 -->
  <script src="<?php echo base_url() . 'assets/'; ?>plugins/jQuery/jquery-2.2.3.min.js"></script>
  <!-- PrintMaster -->
  <script src="<?php echo base_url() . 'assets/'; ?>plugins/angka/angka.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style type="text/css">
    .small-box h3 {
      font-size: 25px;
      font-weight: bold;
      margin: 0 0 10px 0;
      white-space: nowrap;
      padding: 0;
    }

    a {
      color: #fff;
    }
  </style>
</head>

<body class="hold-transition skin-green sidebar-mini">
  <div class="wrapper">
    <!--INIHeader-->
    <?php echo $_header; ?>
    <!--AKHIRHeader-->

    <!-- Collect the nav links, forms, and other content for toggling -->
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!--INISidebar-->
      <?php echo $_sidebar; ?>
      <!--AKHIRSidebar-->

    </aside><!-- /.navbar-collapse -->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!--INIContent-->
      <?php echo $_content; ?>
      <!--AKHIRContent-->

    </div><!-- /#page-wrapper -->


    <footer class="main-footer">
      <strong>Copyright &copy; 2019 Aplikasi Mou Makan.</strong>
    </footer>

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
    <script src="<?php echo base_url() . 'assets/'; ?>plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- MaskMoney -->
    <script src="<?php echo base_url() . 'assets/'; ?>plugins/maskMoney/jquery.maskMoney.min.js"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url() . 'assets/'; ?>plugins/select2/select2.full.min.js"></script>
    <!-- PrintMaster -->
    <script src="<?php echo base_url() . 'assets/'; ?>plugins/print-master/jQuery.print.js"></script>


    <!-- page script -->
    <script>
      $(function() {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": false,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": false,
          "autoWidth": false
        });

        $(".select2").select2();
      });
    </script>
    <script>
      //Date picker
      $('#datepicker_awal').datepicker({
        autoclose: true
      });
    </script>
    <script>
      //Date picker
      $('#datepicker_akhir').datepicker({
        autoclose: true
      });
    </script>
</body>

</html>