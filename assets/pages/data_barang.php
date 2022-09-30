  <?php
require_once('lib/autoidbrg.php');
require_once('../lib.php');
//membuat class databse
$eks = new Toko();
// koneksi ke MySQL via method
$eks->connectMySQL();
$autoid=autoid();
//operasi data
if((isset($_POST['submit'])) && ($_POST['submit']=='Simpan')) {//add
  $id_barang=$_POST['id_barang'];
  $nama_barang=$_POST['nama_barang'];
  $harga_barang=$_POST['harga_barang'];
  $qty=$_POST['qty'];
  $ex_gambar=explode(".",$_FILES['gambar']['name']);
  $gambar=$id_barang.".".$ex_gambar[1];
  //upload foto dalam folder ../img/produk/
 move_uploaded_file ($_FILES['gambar']['tmp_name'], $path.$gambar);
 $insert=InsertBrg($id_barang,$nama_barang,$harga_barang,$qty,$gambar) ;
 $eks->iklan_barang($id_barang);
 if($insert==TRUE) {
  ?><script language="javascript"> alert('Data Berhasil Ditambahkan');
  document.location.href='?page=data_barang'</script><?php
 }
} else if((isset($_POST['submit'])) && ($_POST['submit']=='Update')) { //update
  $id_barang=$_POST['id_barang'];
  $nama_barang=$_POST['nama_barang'];
  $harga_barang=$_POST['harga_barang'];
  $qty=$_POST['qty'];
  //update tanpa gambar
  if(empty($_FILES['gambar']['name'])){
    $update=UpdateUnivNoImg($id_barang,$nama_barang,$harga_barang,$qty);
    if ($update==TRUE) {
      ?> <script language="javascript">alert('Data Berhasil Diubah');
      document.location.href='?page=data_barang'</script><?php
    }
  } else {
  $ex_gambar=explode(".",$_FILES['gambar']['name']);
  $gambar=$id_barang.".".$ex_gambar[1];
    //hapus foto lama
    $barang=GetBrgByID($id_barang);
    $row_barang=mysql_fetch_assoc($barang);
    if(!empty($row_barang['foto'])) {
      unlink($path.$row_barang['foto']);
     }
    //upload gambar baru
    move_uploaded_file ($_FILES['gambar']['tmp_name'], $path.$gambar);
    $update=UpdateUniv($id_barang,$nama_barang,$harga_barang,$qty,$gambar);
    if ($update==TRUE) {
      ?> <script language="javascript">alert('Data Berhasil Diubah');
      document.location.href='?page=data_barang'</script><?php
    } 
  }
}else if((isset($_GET['act'])) && ($_GET['act']=='del')) {//delete
  $id=$_GET['id_barang'];
  //hapus foto lama
  $kampus=GetBrgByID($id);
  $row_barang=mysql_fetch_assoc($kampus);
  if(!empty($row_barang['foto'])) {
     unlink($path.$row_barang['foto']);
    }
  $del=DeleteBrg($id);
  if ($del==TRUE) {
      ?> <script language="javascript">alert('Data Berhasil Dihapus');
      document.location.href='?page=data_barang'</script><?php
    }  
}
  ?>  
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Barang
        <small>Data Barang</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Data</a></li>
        <li class="active">Data Barang</li>
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
                  <th>ID Barang</th>
                  <th>Nama Barang</th>
                  <th>Harga Barang</th>
                  <th>Qty</th>
                  <th>Gambar</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $univ=GetAllBarang();
                $row_brg=mysql_fetch_assoc($univ);
                $no=0;
                do {
                  $no++;
                ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $row_brg['id_barang'];?></td>
                  <td><?php echo $row_brg['nama_barang'];?></td>
                  <td><?php echo $row_brg['harga_barang'];?></td>
                  <td><?php echo $row_brg['qty'];?></td>
                  <td><img src='images/<?php echo $row_brg['foto'];?>'style="height: 80px;width: 100px;"></td>
                  <td><button type="button" class="btn btn-info btn-flat btn-xs" data-toggle="modal" data-target="#EditModal" onclick="edit('<?php echo $row_brg['id_barang']; ?>')">Edit</button> <a href="?page=data_barang&act=del&id_barang=<?php echo $row_brg['id_barang']; ?>" onclick="return confirm('Yakin Mau Hapus?');" class="btn btn-danger btn-flat btn-xs">Hapus</a></td>
                </tr>
                <?php } while($row_brg=mysql_fetch_assoc($univ));?>
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
        <h4 class="modal-title" id="myModalLabel">Tambah Anggota</h4>
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data">
        <label>ID Barang</label>
          <input type="text" class="form-control" name="id_barang" value="<?php echo $autoid; ?>" readonly>
          <label>Nama Barang</label>
          <input type="text" class="form-control" placeholder="" name="nama_barang">	
          <label>Harga Barang</label>
          <input type="text" class="form-control" placeholder="" name="harga_barang">	
          <label>QTY</label>
          <input type="text" class="form-control" placeholder="" name="qty">	
          <label for="exampleInputFile">Upload Gambar</label>
          <input type="file" id="exampleInputFile" name="gambar">
          <p class="help-block">Upload dengan tipe file JPG, PNG.</p>
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
    var id_barang=id;
    $.ajax({
        type: 'POST',
        url: '<?php echo"$url";?>/pages/lib/modal_editbrg.php',
        data: 'id_barang='+id_barang,
        success: function(data) {
		//	alert(data);
document.getElementById("modal-content").innerHTML = data;
        }
    });
  }
</script>