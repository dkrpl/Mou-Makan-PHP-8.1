<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Karyawan
        <small>Restaurant</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Ubah</a></li>
        <li class="active">Data</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
        <?php if($this->uri->segment(3)=='sukses') {?>
              <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-info"></i> Sukses</h4>
                Perubahan berhasil Disimpan.
              </div>
        <?php } ?>
    <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Ubah Data</h3>
            </div>
        <form action="<?php echo base_url();?>profil/ubah_karyawan" method="POST" enctype="multipart/form-data">
        <?php foreach ($karyawan->result_array() as $row) {?>
          <div class="box-body">
          <input type="hidden" name="id_karyawan" value="<?php echo $row['id_karyawan']; ?>">   
    <label>Nama Karyawan</label>
          <input type="text" class="form-control" placeholder="" name="nama" value="<?php echo $row['nama']; ?>">
    <label>Password</label>
          <input type="password" class="form-control" placeholder="Biarkan Kosong jika tidak diubah" name="password" id="">
    <label>No Identitas</label>
          <input type="text" class="form-control" placeholder="" name="no_identitas" value="<?php echo $row['no_identitas']; ?>">
    <label>Jenis Kelamin</label>
     <div class="form-group">
                  <select class="form-control" name="gender" id="gender">
                    <option value="L" <?php if (!(strcmp($row['gender'],"L"))) { echo "selected"; }?>>L</option>
                    <option value="P" <?php if (!(strcmp($row['gender'],"P"))) { echo "selected"; }?>>P</option>
                  </select>
                </div>
    <label>Tanggal Lahir</label>
          <input type="text" class="form-control" readonly="readonly" name="tgl_lahir" id="datepicker_awal" data-date-format="yyyy-mm-dd" value="<?php echo $row['tgl_lahir']; ?>">
    <label>HP</label>
          <input type="text" class="form-control" placeholder="" name="hp" id="hp" value="<?php echo $row['hp']; ?>">
    <label>Alamat</label>
         <textarea class="form-control" name="alamat"><?php echo $row['alamat']; ?></textarea>
      <div class="box-footer">
          <button type="reset" class="btn btn-default"><i class="fa fa-close"></i> Cancel</button>
         <button type="submit" class="btn btn-info pull-right"><i class="fa fa-save"></i> Simpan</button>
      </div>
      <?php } ?>
      </form>
    </div>
    </div>
  </section>