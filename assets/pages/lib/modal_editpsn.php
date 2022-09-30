     <?php
	 require_once('config.php');
	 require_once('func_db/func_usr.php');
				$id=$_POST['id_member'];
                $usr=GetUsrByID($id);
                $row_usr=mysql_fetch_assoc($usr);
                $no=0;
                do {
                ?>
               

         <label>ID Member</label>
          <input type="text" class="form-control" name="id_member" value="<?php echo $row_usr['id_member'];?>" readonly>
          <label>Nama Member</label>
          <input type="text" class="form-control" placeholder="" name="nama_member" value="<?php echo $row_usr['nama_member'];?>">	
		  <label>Jenis Kelamin</label>
           <div class="form-group">
                  <select class="form-control" name="jenis_kelamin">
                  <option>Pilih Kelamin</option>
                    <option value="L" <?php if($row_usr['gender']=='L'){echo"selected";}?>>Laki-Laki</option>
                    <option value="P" <?php if($row_usr['gender']=='P'){echo"selected";}?>>Perempuan</option>
                  </select>
                </div>
		  <label>No Telp</label>
          <input type="text" class="form-control" placeholder="" name="no_telp" value="<?php echo $row_usr['no_telp'];?>">
          <label>Alamat</label>
          <textarea class="form-control" name="alamat"><?php echo $row_usr['alamat'];?></textarea>			  
	   <?php } while($row_usr=mysql_fetch_assoc($usr));?>
	          