<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Kategori
        <small>Restaurant</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Data</a></li>
        <li class="active">Data Kategori</li>
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
                  <th>ID Kategori</th>
                  <th>Nama Kategori</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                $no=0;
                foreach($konten->result_array() as $row) { 
                  $no++;
                  ?>
               <tr>
                 <td><?php echo $no; ?></td>
                 <td><?php echo $row['id_kat'];?></td>
                 <td><?php echo $row['kategori'];?></td>
                 <td><?php echo $row['aktif'];?></td>
                 <td><button type="button" class="btn btn-info btn-flat btn-xs" data-toggle="modal" data-target="#EditModal" onclick="edit('<?php echo $row['id_kat']; ?>')">Edit</button> <a href="<?php echo base_url(); ?>kategori/hapus/<?php echo $row['id_kat']; ?>" onclick="return confirm('Yakin Mau Hapus?');" class="btn btn-danger btn-flat btn-xs">Hapus</a></td>
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
        <h4 class="modal-title" id="myModalLabel">Tambah Kategori</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url();?>kategori/simpan" method="POST">
           <label>Nama Kategori</label>
          <input type="text" class="form-control" placeholder="" name="kategori">
          <label>Status</label>
           <div class="form-group">
                  <select class="form-control" name="aktif">
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
        <h4 class="modal-title" id="myModalLabel">Edit Kategori</h4>
      </div>
      <div class="modal-body" id="edit_kat">
        
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function edit(id_kat) {
    var id=id_kat;
    $.ajax({
    type: 'POST',
    data: 'id_kat='+id,
    url: '<?php echo base_url();?>kategori/edit',
    success: function(data) {
    $('#edit_kat').html(data);
    }
   });  
  }
</script>