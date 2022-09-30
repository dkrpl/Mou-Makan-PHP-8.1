<section class="content-header">
      <h1>
        Nilai
        <small>Pajak</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Data</a></li>
        <li class="active">Pajak</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-lg-12">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Masukan Nilai PB 1</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="<?php echo site_url('pajak/ubah');?>">
              <div class="box-body">
                <div class="form-group">
                  <label>PB1 dalam %</label>
                  <?php foreach ($pajak->result_array() as $row) { ?>
                  <input type="text" name="pajak" class="form-control"  placeholder="0" required="required" value="<?php echo number_format($row['pajak'],0 ,'','.');?>">
                  <input type="hidden" name="id_pajak" value="<?php echo $row['id_pajak'];?>">
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
