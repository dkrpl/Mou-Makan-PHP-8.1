<section class="content-header">
      <h1>
        Absensi
        <small>Karyawan</small>
      </h1>
      
</section>

    <!-- Main content -->
<section class="content">
<div class="row">
<div class="col-md-8">
   <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">Check In</a></li>
              <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Check Out</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
              
<table class="table table-responsive table-bordered">
  <tr>
    <th th rowspan="8"><img src="https://ielmy.files.wordpress.com/2011/06/user-icon.png" width="250px" class="img"></th>
    <th colspan="2"><b><center>INFORMASI</center></b></th>
  </tr>
  <?php foreach ($karyawan->result() as $row) {?>
  <tr>
    <td>ID Karyawan</td>
    <td><b><?php echo $row->id_karyawan;?></b></td>
  </tr>
  <tr>
    <td>No Identitas</td>
    <td><b><?php echo $row->no_identitas;?></b></td>
  </tr>
  <tr>
    <td>Nama</td>
    <td><b><?php echo $row->nama;?></b></td>
  </tr>
  <tr>
    <td>Jenis Kelamin</td>
    <td><b><?php if ($row->gender=="L") {echo'Laki - Laki';}else{echo'Perempuan';} ?></b></td>
  </tr>
<?php } ?>
   <tr>
    <td colspan="2"><b><center>STATUS ABSEN</center></b></td>
  </tr>
  <tr>
    <td>Tanggal Sekarang</td>
    <td><b><?php echo date('d-m-Y');?></td>
  </tr>
  <tr>
    <td>Status</td>
    <td><b><?php echo $status;?></b></td>
  </tr>
  <tr>
    <td colspan="3"><a href="<?php echo base_url(); ?>absensi/absen_karyawan/<?php echo $id;?>/in" class="btn btn-info btn-flat" style="width: 100%"><b>CHECK IN</b></a></td>
  </tr>
</table>


              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
<table class="table table-responsive table-bordered">
   <tr>
    <th th rowspan="8"><img src="https://ielmy.files.wordpress.com/2011/06/user-icon.png" width="250px" class="img"></th>
    <th colspan="2"><b><center>INFORMASI</center></b></th>
  </tr>
  <?php foreach ($karyawan->result() as $row) {?>
  <tr>
    <td>ID Karyawan</td>
    <td><b><?php echo $row->id_karyawan;?></b></td>
  </tr>
  <tr>
    <td>No Identitas</td>
    <td><b><?php echo $row->no_identitas;?></b></td>
  </tr>
  <tr>
    <td>Nama</td>
    <td><b><?php echo $row->nama;?></b></td>
  </tr>
  <tr>
    <td>Jenis Kelamin</td>
    <td><b><?php if ($row->gender=="L") {echo'Laki - Laki';}else{echo'Perempuan';} ?></b></td>
  </tr>
<?php } ?>
   <tr>
    <td colspan="2"><b><center>STATUS ABSEN</center></b></td>
  </tr>
  <tr>
    <td>Tanggal Sekarang</td>
    <td><b><?php echo date('d-m-Y');?></td>
  </tr>
  <tr>
    <td>Status</td>
    <td><b><?php echo $status;?></b></td>
  </tr>
  <tr>
    <td colspan="3"><a href="<?php echo base_url(); ?>absensi/checkout/<?php echo $id;?>/out" class="btn btn-danger btn-flat" style="width: 100%" onclick="return confirm('Pastikan semua perkerjaan selasai ?')"><b>CHECK OUT</b></a></td>
  </tr>
</table>
              </div>
              <!-- /.tab-pane -->
            
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
  </div>

</section>
