<?php
require_once('lib/autoidpsn.php');
$autoid=autoid();
//operasi data
if((isset($_POST['submit'])) && ($_POST['submit']=='Simpan')) {//add
  $id_member=$_POST['id_member'];
  $nama_member=$_POST['nama_member'];
  $jenis_kelamin=$_POST['jenis_kelamin'];
  $no_telp=$_POST['no_telp'];
  $alamat=$_POST['alamat'];
 $insert=Insertpsn($id_member,$nama_member,$jenis_kelamin,$no_telp,$alamat) ;
 if($insert==TRUE) {
  ?><script language="javascript"> alert('Data Berhasil Ditambahkan');
  document.location.href='?page=data_member'</script><?php
 }
} else if((isset($_POST['submit'])) && ($_POST['submit']=='Update')) { //update
   $id_member=$_POST['id_member'];
  $nama_member=$_POST['nama_member'];
  $jenis_kelamin=$_POST['jenis_kelamin'];
  $no_telp=$_POST['no_telp'];
  $alamat=$_POST['alamat'];
    $update=Updatepsn($id_member,$nama_member,$jenis_kelamin,$no_telp,$alamat);
    if ($update==TRUE) {
      ?> <script language="javascript">alert('Data Berhasil Diubah');
      document.location.href='?page=data_member'</script><?php
    } 
  
}else if((isset($_GET['act'])) && ($_GET['act']=='del')) {//delete
  $id=$_GET['id_pesanan'];
  $del=Deletepsn($id);
  if ($del==TRUE) {
      ?> <script language="javascript">alert('Data Berhasil Dihapus');
      document.location.href='?page=data_pesanan'</script><?php
    }  
}
  ?>  
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Member
        <small>Data Member</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Data</a></li>
        <li class="active">Data Member</li>
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
                  <th>Kode Pesanan</th>
                  <th>Nama Member</th>
                  <th>Nama Barang</th>
                  <th>Jumlah Beli</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $psn=GetAllPsn();
                $row_psn=mysql_fetch_assoc($psn);
                $no=0;
                do {
                  $no++;
                ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $row_psn['kode_pembelian'];?></td>
                  <td><?php echo $row_psn['nama_member'];?></td>
                  <td><?php echo $row_psn['nama_barang'];?></td>
                  <td><?php echo $row_psn['jumlah_beli'];?></td>
                  <td><?php if($row_psn['status']=="step_1"){echo'<center><small class="label bg-blue">Belum Konfirm</small></center>';}else if($row_psn['status']=="step_2"){echo'<center><small class="label bg-green">Sudah Konfirm</small></center>';}?></td>
                  <td><!--<button type="button" class="btn btn-info btn-flat btn-xs" data-toggle="modal" data-target="#EditModal" onclick="edit('<?php //echo $row_psn['id_member']; ?>')">Edit</button>--> <a href="?page=data_pesanan&act=del&id_pesanan=<?php echo $row_psn['id']; ?>" onclick="return confirm('Yakin Mau Hapus?');" class="btn btn-danger btn-flat btn-xs">Hapus</a></td>
                </tr>
                <?php } while($row_psn=mysql_fetch_assoc($psn));?>
                </tbody>
              </table>
			          <div class="box-footer">
        <div class="pagination pagination-sm no-margin pull-left">
        <!--<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"> <i class="fa fa-plus"></i> Tambah Data</button>-->
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
        <h4 class="modal-title" id="myModalLabel">Tambah Member</h4>
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data">
        <label>ID Member</label>
          <input type="text" class="form-control" name="id_member" value="<?php echo $autoid; ?>" readonly>
          <label>Nama Member</label>
          <input type="text" class="form-control" placeholder="" name="nama_member">	
		  <label>Jenis Kelamin</label>
           <div class="form-group">
                  <select class="form-control" name="jenis_kelamin">
                  <option>Pilih Kelamin</option>
                    <option value="L">Laki-Laki</option>
                    <option value="P">Perempuan</option>
                  </select>
                </div>
		  <label>No Telp</label>
          <input type="text" class="form-control" placeholder="" name="no_telp">
          <label>Alamat</label>
          <textarea class="form-control" name="alamat"></textarea>			  
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
        <h4 class="modal-title" id="myModalLabel">Edit Barang</h4>
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data" id="modal-content">
		<div id="modal-content">
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
  function edit(id){
    var id_member=id;
    $.ajax({
        type: 'POST',
        url: '<?php echo"$url";?>/pages/lib/modal_editpsn.php',
        data: 'id_member='+id_member,
        success: function(data) {
		//	alert(data);
document.getElementById("modal-content").innerHTML = data;
        }
    });
  }
</script>