<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Laporan
    <small>Restaurant</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Laporan</a></li>
    <li class="active"> Absensi</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Laporan Absensi Pegawai</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form>
            <div class="form-group col-xs-3">
              <label>Bulan</label>
              <select class="form-control" id="bulan">
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
              </select>
            </div>
            <div class="form-group col-xs-3">
              <label>Tahun</label>
              <select id="tahun" class="form-control">
                <?php
                $thn_now = date('Y');
                for ($i = 0; $i < 5; $i++) {
                  $thn = $thn_now - $i;
                ?>
                  <option value="<?php echo $thn; ?>"><?php echo $thn; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group col-xs-4">
              <label>Karyawan</label>
              <select class="form-control select2" id="karyawan">
                <option value="0">--Pilihan--</option>
                <?php foreach ($karyawan->result_array() as $row) { ?>
                  <option value="<?php echo $row['id_karyawan']; ?>"><?php echo $row['nama']; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group col-xs-3">
              <label></label>
              <button type="button" class="btn btn-success" id="tampil"><i class="fa fa-file"></i> Tampilkan</button>
            </div>
          </form>
          <div id="loading" align="center"><img src="<?php echo base_url() . 'assets/img/loading.gif' ?>" widht="170px" height="170px"></div>
          <div class="col-xs-12" id="lap_absensi">
            <table id="example2" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Pegawai</th>
                  <th>Tanggal</th>
                  <th>Jam</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <tr></tr>
              </tbody>
            </table>
            <div class="box-footer">
              <div class="col-xs-12 pull-right">
                <button class="btn btn-flat btn-primary"><i class="fa fa-print"></i> Cetak</button>
                <button class="btn btn-flat btn-success"><i class="fa fa-file-excel-o"></i> Excel</button>
              </div>

            </div>

          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
<script type="text/javascript">
  $(document).ready(function() {
    $('#lap_absensi').hide();
    $('#loading').fadeOut(800);
    $('#lap_absensi').fadeIn(3000);
    $('#tampil').click(function() {
      var bln = $('#bulan').val();
      var thn = $('#tahun').val();
      var karyawan = $('#karyawan').val();
      $.ajax({
        type: 'POST',
        data: 'bulan=' + bln + '&tahun=' + thn + '&id_karyawan=' + karyawan,
        url: '<?php echo base_url(); ?>report/show_absen',
        success: function(data) {
          $('#lap_absensi').hide();
          $('#lap_absensi').html(data);
          $('#loading').show();
          $('#loading').fadeOut(1000);
          $('#lap_absensi').fadeIn(2500);
        }
      });
    });
  });

  function print_data() {
    printContent("print-area");
    window.location = '<?php echo base_url(); ?>report/absensi';
    //alert("PRINT");
  }

  function printContent(el) {
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
  }
</script>