<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pramusaji
        <small>Menu <?php if(isset($kategori)) {echo $kategori;} else {echo "All";} ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Pramusaji</a></li>
        <li class="active">Daftar Menu</li>
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
                  <th>Kode</th>
                  <th>Nama Menu</th>
                  <th>Gambar</th>
                  <th>Harga</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                $no=0;
                foreach ($menu->result_array() as $row) { 
                  $no++;
                ?>
               <tr>
                 <td><?php echo $no;?></td>
                 <td><?php echo $row['id_menu'];?></td>
                 <td><?php echo $row['nama_menu'];?></td>
                 <td><img src="<?php echo base_url().'assets/menu/'.$row['gambar'];?>" width="70px" height="65px"></td>
                 <td><?php echo number_format($row['harga'],0,",",".");?></td>
               </tr>
               <?php } ?>
                </tbody>
              </table>
			          <div class="box-footer">
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
	
	