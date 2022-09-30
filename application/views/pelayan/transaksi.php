<?php 
$data_meja=$meja->row();
?>
<section class="content-header">
      <h1>
        Pramusaji
        <small>Pilih Menu</small>
      </h1>
      
</section>

    <!-- Main content -->
<section class="content">
<div class="row">
  <div class="col-lg-12">
	 <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Pemesanan <?php echo $data_meja->meja;?></h3><a href="<?php echo base_url().'pramusaji/cart/'.$data_meja->no_meja;?>">
              <button class="btn btn-success pull-right" ><i class="fa fa-cart-plus"></i> <?php if (isset($jml_item)) {echo $jml_item; } else { echo "0";}?></button>
              </a>
            </div>
        
      <!-- form start -->
        <form role="form">
        <div class="box-body">
        <div class="col-lg-12">
        	<div class="form-group">
        		<div class="col-lg-12">
                  <label class="control-label">Kode</label>
                </div>
                <div class="input-group">
                <input class="form-control col-lg-12" type="text" name="id_menu" id="id_menu">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#myModal">Cari</button>
                    </span>
              	</div>
            </div>
        <div id="item">
            <div class="form-group">
                 <div class="col-xs-12">
                  <label class="control-label">Item</label>
                </div>
                  <div class="input-group col-xs-12">
                <input class="form-control" type="text" id="nama_menu" readonly="readonly">
              	</div>
            </div>
            <div class="form-group">
                 <div class="col-xs-12">
                  <label class="control-label">Harga</label>
                </div>
                  <div class="input-group col-xs-12">
                <input class="form-control" id="harga" type="text" readonly="readonly" placeholder="0">
              	</div>
            </div>
        </div>
            <!-- <div class="form-group">
                 <div class="col-xs-12">
                  <label class="control-label">Disc(%)</label>
                </div>
                  <div class="input-group col-xs-12">
                <input class="form-control" type="number" id="diskon" placeholder="0" onkeyup="disc(this.value)">
                </div>
            </div> -->
            <div class="form-group">
                 <div class="col-xs-12">
                  <label class="control-label">Qty</label>
                </div>
                  <div class="input-group col-xs-12">
                <input class="form-control" type="number" id="qty" placeholder="0" onkeyup="subTotal(this.value)">
              	</div>
            </div>
            <div class="form-group">
                 <div class="col-xs-12">
                  <label class="control-label">Sub</label>
                </div>
                  <div class="input-group col-xs-12">
                <input class="form-control" type="text" readonly="readonly" id="sub_total" placeholder="0">
              	</div>
            </div>
            <div class="form-group">
            	<div class="col-xs-12 pull-right">
            		<button type="button" class="btn btn-primary btn-block" onclick="add_cart()">
            		<i class="fa fa-cart-plus"></i> Tambah</button>
            	</div>
            </div>
         </div>        
         
          	
        </div>
        </form>
        </div>
  </div>
</div>

</div>
</section>
</section>


<!-- Modal selesai -->
  <!-- Modal selesai -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title">Data Barang</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="form-group has-primary has-feedback">
              <input class="form-control input-lg" placeholder="Search for..." type="text" id="keyword">
              <span class="glyphicon glyphicon-search form-control-feedback"></span>
            </div>
             <div class="row" style="border: 1px solid;border-color: #d2d6de;padding-top: 15px;margin-bottom: -15px;background-color: rgba(210, 214, 222, 0.35);margin-right: 0px;margin-left: 0px;" id="barang">
             <?php foreach ($barang->result() as $result) {?>
                <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
            <span class="info-box-icon bg-aqua" style="background-image: url('<?php echo base_url(); ?>assets/menu/<?php echo $result->gambar; ?>');background-size: cover;"></span>
            <div class="info-box-content">
              <span class="info-box-text"><?php echo $result->nama_menu; ?></span>
              <span class="info-box-number">Rp. <?php echo number_format($result->harga,2); ?></span>
              <span class="info-box-text"><button type="button" class="btn btn-success" onclick="pilihBrg('<?php echo $result->id_menu; ?>')" data-dismiss="modal">Pilih</button></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <?php } ?>
            </div>
      </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
        </div>
      </div>
      
    </div>  
</section>
<script type="text/javascript">
  $(document).ready(function(){	
    //untuk cari
    $('#keyword').keyup(function() {
      var key=$('#keyword').val();
      $.ajax({
        type: 'POST',
        data: 'keyword='+key,
        url: '<?php echo base_url();?>kasir/cariBrg',
        success: function(data) {
        $('#barang').html(data);
        }
     });
    });
    //untuk kembalian
    $('#bayar').keyup(function() {
      var bayar=$('#bayar').val();;
      var total=$('#total').val().replace('.', '').replace('.', '');
      var kembali=bayar-total;
      $('#kembali').val(convertToRupiah(kembali)); 
    });
    //untuk tampil nama, harga
    $('#id_menu').click(function() {
      var id=$('#id_menu').val();
      if(id=='') {
        $('#id_menu').focus();
      } else {
        $.ajax({
          type: 'POST',
          data: 'id_menu='+id,
          url: '<?php echo base_url();?>pramusaji/pilihBrg',
          success: function(data) {
            $('#item').html(data);
          }
       });
      }
    });    
  });
</script>
<script type="text/javascript">
function pilihBrg(id_menu) {
  var id=id_menu;
  $('#id_menu').val(id);
    $.ajax({
        type: 'POST',
        data: 'id_menu='+id,
        url: '<?php echo base_url();?>pramusaji/pilihBrg',
        success: function(data) {
          $('#item').html(data);
        }
     });
  } 

function add_cart() {
    var id_menu=$('#id_menu').val();
    var nama_menu=$('#nama_menu').val();
    var harga=$('#harga').val();
    var qty=$('#qty').val();
    var disc=$('#diskon').val();
    var sub_total=$('#sub_total').val();
    if(disc=='') {
      var diskon=0;
    } else {
      var diskon=disc;
    } 
    $.ajax({
      type: 'POST',
      data: 'id_menu='+id_menu+'&nama_menu='+nama_menu+'&harga='+harga+'&qty='+qty+'&diskon='+diskon+'&sub_total='+sub_total,
      url: '<?php echo base_url();?>pramusaji/add_cart',
      success: function(data) {
         window.location.href='<?php echo base_url().'pramusaji/transaksi/'.$data_meja->no_meja;?>';
        }
    });
  }

function convertToRupiah(angka) {
  var rupiah = '';    
  var angkarev = angka.toString().split('').reverse().join('');
  for(var i = 0; i < angkarev.length; i++) 
      if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
      return rupiah.split('',rupiah.length-1).reverse().join('');  
}

function bayar(uang) {
  var bayar=uang;
  var total=$('#total').val();
  var kembali=bayar-total;
  $('#kembali').val(kembali);
}

function subTotal(qty) {
  var harga = $('#harga').val().replace(".", "").replace(".", "");
  var qty= $('#qty').val();
  $('#sub_total').val(convertToRupiah(harga*qty));
}

function disc(disc) {
  var harga = $('#harga').val().replace(".", "").replace(".", "");
  var qty=$('#qty').val();
  if(disc=='') {
   var potongan=0;
  } else {
    var potongan=(disc*harga)/100;
  } 
  new_harga=harga-potongan
  $('#harga').val(convertToRupiah(new_harga));
}
</script>
