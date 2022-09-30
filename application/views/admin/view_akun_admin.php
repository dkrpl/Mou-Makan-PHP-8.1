<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Akun Admin
        <small>Restaurant</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Data</a></li>
        <li class="active">Data Akun Admin</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>ID Admin</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
               <tr>
                 <td>1</td>
                 <td>ADM-001</td>
                 <td>ADM01</td>
                 <td>d1d2d3</td>
                 <td><button type="button" class="btn btn-info btn-flat btn-xs" data-toggle="modal" data-target="#EditModal">Edit</button> <a href="" onclick="return confirm('Yakin Mau Hapus?');" class="btn btn-danger btn-flat btn-xs">Hapus</a></td>
               </tr>
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
        <h4 class="modal-title" id="myModalLabel">Tambah Akun Admin</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url();?>admin/ubah_Akun Admin" method="POST" enctype="multipart/form-data" id="modal-content">
    <div id="modal-content">
    <label>ID Akun Admin</label>
          <input type="text" class="form-control" placeholder="" name="id_jab" id="id_jab" readonly>
    <label>Nama Akun Admin</label>
          <input type="text" class="form-control" placeholder="" name="" id="">
    <label>Password</label>
          <input type="password" class="form-control" placeholder="" name="" id="">
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
        <h4 class="modal-title" id="myModalLabel">Edit Akun Admin</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url();?>admin/ubah_Akun Admin" method="POST" enctype="multipart/form-data" id="modal-content">
		<div id="modal-content">
    <label>ID Akun Admin</label>
          <input type="text" class="form-control" placeholder="" name="id_jab" id="id_jab" readonly>
    <label>Nama Akun Admin</label>
          <input type="text" class="form-control" placeholder="" name="" id="">
    <label>Password</label>
          <input type="password" class="form-control" placeholder="" name="" id="">
		</div>
		</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <input type="submit" name="submit" class="btn btn-primary" value="Update">
		 </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function edit(id,nama,status){
   $("#id_jab").val(id);
   $("#").val(nama);
   $("#status").val(status);
  }
</script>