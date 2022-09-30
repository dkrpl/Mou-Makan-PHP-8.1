<?php 
$data_meja=$meja->row();
?>
<section class="content-header">
      <h1>
        Kasir
        <small>Data Booking</small>
      </h1>
      
</section>

    <!-- Main content -->
<section class="content">
<div class="row">
  <div class="col-lg-12">
	 <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Pemesanan</h3>              
            </div>
        
      <!-- form start -->
        
         <div class="box-body">
          <!-- kene -->
          <!-- <div class="col-md-12"> -->
              <table id="example1"  class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Nama Pemesan</th>
                  <th>No Meja</th>
                  <th>Tanggal</th>
                  <th>Jam</th>
                  <th>Alamat</th>
                  <th>No HP</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody> 
                <?php
                if (is_array($data)) {
                  # code...
                
                  foreach ($data as $row) { ?>
                    <tr>
                      <td><?php echo $row['id']; ?></td>
                      <td><?php echo $row['nama']; ?></td>
                      <td><?php echo $row['meja']; ?></td>
                      <td><?php echo $row['tanggal']; ?></td>
                      <td><?php echo $row['jam']; ?></td>
                      <td><?php echo $row['alamat']; ?></td>
                      <td><?php echo $row['no_hp']; ?></td>
                      <td><?php echo anchor('booking/delete/'.$row['id'].'/'.$row['no_meja'],'Selesai', 'class="btn btn-danger" onclick="konfirm();" '); ?></td>
                      <?php }} ?>
                    </tr>                        
                </tbody>
              </table>
          <!-- </div> -->
              <!-- kene -->
              

        <button class="btn btn-success btn-flat left"  data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah</button> 
        </div>
    </div>
    </div> 
  </div>    
</section>  
         
<!-- modal -->
         <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title">Tambah Booking</h4>
        </div>
        <div class="modal-body">
  <form id="theform" action="<?php echo base_url(). 'booking/save_pesanan';?>" method="post">
        <div class="box-body">
        <div class="col-lg-12">
        <div id="item"> 
          <div class="form-group">
                 <div class="col-xs-12">
                  <label class="control-label">Pilih Meja:</label>
                </div>
                  <div class="input-group col-xs-12">                  
                      
                       <select class="form-control" style="width: 100%;" id="no_meja" name="no_meja">
                <option value="">--Pilih Meja--</option>                                
                              
                                
                                <?php foreach ($opsi_meja as $row):?>
                        <option value="<?php echo $row['no_meja'] ?>"><?php echo $row['meja'] ?></option>
                      <?php endforeach; ?>

                    </select>
                  </div>
                </div>
          <div class="form-group">
                 <div class="col-xs-12">
                  <label class="control-label">Nama Pemesan:</label>
                </div>
                  <div class="input-group  col-xs-12">
                <input class="form-control" type="name" required="nama" id="nama" name="nama">
                </div>
            </div>

            <div class="form-group">
                 <div class="col-xs-12">
                  <label class="control-label">Alamat:</label>
                </div>
                  <div class="input-group col-xs-12">
                <input class="form-control" type="text" required="alamat" id="alamat" name="alamat">
                </div>
            </div>

            <div class="form-group">
                 <div class="col-xs-12">
                  <label class="control-label">No HP:</label>
                </div>
                  <div class="input-group col-xs-12"> 
                <input class="form-control" type="number" id="no_hp" name="no_hp">
                </div>
            </div>

            <div class="form-group">
                 <div class="col-xs-12">
                  <label class="control-label">Tanggal Pemesanan:</label>
                </div>
                  <div class="input-group col-xs-12">
                <input class="form-control" type="date" id="tanggal" name="tanggal" >
                </div>
            </div>
            <div class="form-group">
                 <div class="col-xs-12">
                  <label class="control-label">Jam Pesan</label>
                </div>
                  <div class="input-group col-xs-12">
                <input class="form-control" id="jam" type="time"  name="jam">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <div class="form-group">
              <div class="col-xs-12 pull-right">
                <button class="btn btn-success btn-block" >
                <i class="fa fa-cart-plus"></i> Tambah</button>
              </div>
            </div>
          </div>
         </div>
             
      </div>
        </div>
</form>
</div>
</div>
</div>
</div>
</div>        
      


<script type="text/javascript">
  function konfirm() 
{
var ans = confirm('Apakah Pesanan ini Sudah Selesai?');
if (ans == true) {
window.location.href = '<?php echo base_url('booking/save_pesanan')?>'
}
else {
return false;
}
}
$(function () {
    $("#example1").DataTable();
    $("#example2").DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });

    $("#nama,#alamat").focus();
  });
</script>
