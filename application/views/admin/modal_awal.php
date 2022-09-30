<section class="content-header">
      <h1>
        Modal
        <small>Awal</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Data</a></li>
        <li class="active">Modal Awal/li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-lg-12">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Masukan Modal Awal</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="<?php echo site_url('modal/ubah');?>">
              <div class="box-body">
                <div class="form-group">
                  <label>Modal Rp</label>
                  <?php foreach ($modal_awal->result_array() as $row) { ?>
                  <input type="text" name="modal" class="form-control"  placeholder="0" required="required" value="<?php echo number_format($row['modal'],0 ,'','.');?>">
                  <input type="hidden" name="id_modal" value="<?php echo $row['id_modal'];?>">
                  <?php } ?>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" required="required"> Data yang dimasukan sesuai dengan kondisi sebenarnya
                  </label>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
              </div>
            </form>
          </div>
      </div>
      </div>
     </section>
