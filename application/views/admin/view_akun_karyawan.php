<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Data Karyawan
    <small>Restaurant</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Data</a></li>
    <li class="active">Data Karyawan</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>ID Karyawan</th>
                <th>Nama</th>
                <th>Gender</th>
                <th>HP</th>
                <th>Akses</th>
                <th>Aktif</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 0;
              foreach ($konten->result_array() as $row) {
                $no++;
              ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $row['id_karyawan']; ?></td>
                  <td><?php echo $row['nama']; ?></td>
                  <td><?php echo $row['gender']; ?></td>
                  <td><?php echo $row['hp']; ?></td>
                  <td><?php if ($row['akses'] == '1') {
                        echo "Kasir";
                      } else if ($row['akses'] == '2') {
                        echo "Pramusaji";
                      } else {
                        echo "Dapur";
                      } ?></td>
                  <td><?php echo $row['aktif']; ?></td>
                  <td><button type="button" class="btn btn-info btn-flat btn-xs" data-toggle="modal" data-target="#EditModal" onclick="edit('<?php echo $row['id_karyawan']; ?>')">Edit</button>
                    <?php if ($row['aktif'] == 'yes') { ?>
                      <a href="<?php echo base_url(); ?>karyawan/set_stat_no/<?php echo $row['id_karyawan']; ?>" onclick="return confirm('Yakin Mau Nonaktifkan?');" class="btn btn-warning btn-flat btn-xs">Non Aktifkan</a>
                    <?php } else { ?>
                      <a href="<?php echo base_url(); ?>karyawan/set_stat_yes/<?php echo $row['id_karyawan']; ?>" onclick="return confirm('Yakin Mau Mengaktifkan?');" class="btn btn-success btn-flat btn-xs">Aktifkan</a>
                    <?php } ?>
                    <a href="<?php echo base_url(); ?>karyawan/delete/<?php echo $row['id_karyawan']; ?>" onclick="return confirm('Yakin Mau Mengaktifkan?');" class="btn btn-danger btn-flat btn-xs">Hapus</a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
          <div class="box-footer">
            <div class="pagination pagination-sm no-margin pull-left">
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">

                <i class="fa fa-plus"></i> Tambah Data
              </button>
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


<!-- Modal Tambah data -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Karyawan</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url(); ?>karyawan/simpan" method="POST" enctype="multipart/form-data" id="modal-content">
          <div id="modal-content">
            <label>ID Karyawan</label>
            <input type="text" class="form-control" placeholder="" name="id_karyawan" value="<?php echo $autoid; ?>" readonly>
            <label>Nama Karyawan</label>
            <input type="text" class="form-control" placeholder="" name="nama" id="">
            <label>No Identitas</label>
            <input type="text" class="form-control" placeholder="" name="no_identitas" id="">
            <label>Jenis Kelamin</label>
            <div class="form-group">
              <select class="form-control" name="gender" id="gender">
                <option value="L">L</option>
                <option value="P">P</option>
              </select>
            </div>
            <label>Tanggal Lahir</label>
            <input type="text" class="form-control" readonly="readonly" name="tgl_lahir" id="datepicker_awal" data-date-format='yyyy-mm-dd'>
            <label>HP</label>
            <input type="text" class="form-control" placeholder="" name="hp" id="hp">
            <label>Alamat</label>
            <textarea class="form-control" name="alamat"></textarea>
            <label>Akses Karyawan</label>
            <div class="form-group">
              <select class="form-control" name="akses" id="akses">
                <option>--Pilih Hak Akses--</option>
                <option value="1">Kasir</option>
                <option value="2">Pramusaji</option>
              </select>
            </div>
            <label>Password</label>
            <input type="password" class="form-control" placeholder="" name="password" id="">
          </div>
          <label>Status</label>
          <div class="form-group">
            <select class="form-control" name="aktif" id="status">
              <option value="yes">Aktif</option>
              <option value="no">Tidak Aktif</option>
            </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Edit data -->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Karyawan</h4>
      </div>
      <div class="modal-body" id="edit_karyawan">

      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function edit(id_karyawan) {
    var id = id_karyawan;
    $.ajax({
      type: 'POST',
      data: 'id_karyawan=' + id,
      url: '<?php echo base_url(); ?>karyawan/edit',
      success: function(data) {
        $('#edit_karyawan').html(data);
      }
    });
  }
</script>