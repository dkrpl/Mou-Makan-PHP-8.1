     <?php
	 require_once('config.php');
	 require_once('func_db/func_barang.php');
				$id=$_POST['id_barang'];
                $brg=GetBrgByID($id);
                $row_brg=mysql_fetch_assoc($brg);
                $no=0;
                do {
                ?>
               

        <label>ID Barang</label>
          <input type="text" class="form-control" name="id_barang" value="<?php echo $row_brg['id_barang'];?>" readonly>
          <label>Nama Barang</label>
          <input type="text" class="form-control" placeholder="Nama Barang" name="nama_barang" value="<?php echo $row_brg['nama_barang'];?>">
        <label>Harga Barang</label>
          <input type="text" class="form-control" placeholder="Harga Barang" name="harga_barang" value="<?php echo $row_brg['harga_barang'];?>">
        <label>QTY</label>
          <input type="text" class="form-control" placeholder="QTY" name="qty" value="<?php echo $row_brg['qty'];?>">
        <label for="exampleInputFile">Upload Gambar</label>
          <input type="file" id="exampleInputFile" name="gambar">
          <p class="help-block">Upload dengan tipe file JPG, PNG.</p>

	   <?php } while($row_brg=mysql_fetch_assoc($brg));?>
	          