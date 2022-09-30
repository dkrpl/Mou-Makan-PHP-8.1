<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Administrasi
        <small>Restaurant</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Ubah</a></li>
        <li class="active">Akses</li>
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
              <h3 class="box-title">Ubah Akses</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="<?php echo base_url().'profil/ubah_admin';?>" method="POST">
              <div class="box-body">
              <?php foreach ($admin->result_array() as $row) { ?>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Username</label>

                  <div class="col-sm-10">
                  <input type="hidden" name="id_admin" value="<?php echo $row['id_admin']; ?>">
                    <input type="text" class="form-control" placeholder="Username" name="username" required="required" value="<?php echo $row['username']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" name="password" placeholder="Biarkan kosong jika tidak diubah">
                  </div>
                </div>
              </div>
              <?php } ?>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="reset" class="btn btn-default"><i class="fa fa-close"></i> Cancel</button>
                <button type="submit" class="btn btn-info pull-right"><i class="fa fa-save"></i> Simpan</button>
              </div>

              <!-- /.box-footer -->
            </form>
          </div>
      </div>
    </div>
  </section>