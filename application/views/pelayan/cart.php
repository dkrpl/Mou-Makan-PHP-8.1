<?php 
$data_meja=$meja->row();
?>
<section class="content-header">
      <h1>
        Pemesanan Makanan
        <small>Detail Order</small>
      </h1>
      
</section>
    <!-- Main content -->
<section class="content">
<div class="row">
  <div class="col-lg-12">
  <?php if($this->uri->segment(4)=='sukses') { ?>
  <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Berhasil !</h4>
                Meja Berhasil Digabungkan.
              </div>
  <?php } ?>
	 <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Detail Order <?php echo $data_meja->meja;?></h3>
            </div>     
            <div class="col-md-8">
            <div class="form-group">
                 <div class="col-xs-12">
                  <label class="control-label">Atas Nama</label>
                </div>
                  <div class="input-group col-xs-12">
                <input class="form-control" type="text" id="user">
                </div>
            </div>
            </div>         
         <div class="row">
         <div class="col-md-12">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Item</th>
                  <th>Harga</th>
                  <th>Qty</th>
                  <th>Disc</th>
                  <th>Sub Total</th>
                </tr>
                </thead>
                <tbody id="tb_transaksi"> 
                <?php 
                $no=0;
                foreach ($cart as $items) {
                  $no++;?>
                 <tr>
                 <td><?php echo $no; ?></td>
                 <td><?php echo $items['name']; ?></td>
                 <td><?php echo number_format($items['price'],0 ,'','.'); ?></td>
                 <td><?php echo $items['qty']; ?></td>   
                 <?php if($this->cart->has_options($items['rowid'])==TRUE) {
                        foreach ($this->cart->product_options($items['rowid']) as $disc=>$disc_value) {
                  ?>  
                 <td><?php echo $disc_value; ?></td>
                 <?php 
                         }
                       } else {
                  ?>      
                  <td><?php echo "0"; ?></td>      
                  <?php } ?> 
                 <td><?php echo number_format($items['subtotal'],0 ,'','.'); ?></td>
                 <td><a href="<?php echo base_url().'pramusaji/del_cart/'.$items['rowid'].'/'.$data_meja->no_meja;?>" class='btn btn-danger btn-flat btn-xs' id='del_trans')">Hapus</a></td>
                 </tr>
                 <?php } ?>       
                </tbody>
              </table>
              <div class="col-xs-8">
                <h3>Total</h3>
              </div>
              <div class="col-xs-4 pull-right">
                <h3><?php if(!empty($total)) {echo number_format($total,0 ,'','.');} else {echo "0";}?></h3>
              </div>
        </div>
        </div>        
			          <div class="box-footer">
                <a href="<?php echo base_url().'pramusaji/transaksi/'.$data_meja->no_meja;?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Order</a> <a href="<?php echo base_url().'pramusaji/clear_cart/'.$data_meja->no_meja;?>" class="btn btn-danger" onclick="return confirm('Kosongkan Cart?');"><i class="fa fa-trash"></i> Clear</a> <button class="btn btn-info" data-toggle="modal" data-target="#myModal" onclick="gabung_meja('<?php echo $data_meja->no_meja;?>')"><i class="fa fa-users"></i> Gabung</button> <button class="btn btn-success pull-right" onclick="konfirm();">Confirm <i class="fa fa-arrow-right"></i></a>
                </div>
         </div>
          	
        </div>
        </div>

</section>




<!--Modal Gabung Meja-->
        <div class="modal fade" id="myModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Gabung Meja </h4>
              </div>
              <div class="modal-body" id="body_modal">

              </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        </div>

        <!-- /.modal -->
<!--Modal Gabung Meja-->
<script type="text/javascript">
  function gabung_meja(meja) {
    var no_meja=meja;
    $.ajax({
        type: 'POST',
        data: 'no_meja='+no_meja,
        url: '<?php echo base_url();?>pramusaji/modal_gabung',
        success: function(data) {
          $('#body_modal').html(data);
        }
     });
  }
  function konfirm() 
{
var ans = confirm('Yakin tidak ada order lagi?');
if (ans == true) {
window.location.href = '<?php echo base_url().'pramusaji/save_pesanan/'.$data_meja->no_meja;?>/'+$('#user').val(), true;
}
else {
return false;
}
}
</script>