<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        RESET
        <small>DATA TRANSAKSI</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Reset</a></li>
        <li class="active"> Data Transaksi</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
          <div class="box-header with-border">
              <h3 class="box-title">Backup Data</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Deskripsi</th>               
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>1</td>
                  <td>Reset Seluruh Data Transaksi</td>
                  <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal"><i class="fa fa-trash"></i> Reset Now</button></td>
                </tr>
               
                </tbody>
              </table>
              </div>
                <div class="box-footer">

            </div>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
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
        <h4 class="modal-title" id="myModalLabel">Masukkan PIN</h4>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
           <div class="col-md-1"><label>PIN:</label></div>
           <div class="col-md-11">
          <input type="password" class="form-control" placeholder="" name="password" required></div>
          <small>*Masukkan pin untuk reset data</small>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <input type="submit" name="submit" class="btn btn-success" value="Confirm">
        </form>
      </div>
    </div>
  </div>
</div>