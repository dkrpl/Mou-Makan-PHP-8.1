<section class="content-header">
      <h1>
        Kasir
        <small>Transaksi Harian</small>
      </h1>      
    </section>
    <!-- Main content -->
    <section class="content">
<div class="row">
  <div class="col-lg-12">
  <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Transaksi Order </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <div class="input-group col-xs-12">
                <select class="form-control" style="width: 100%;" id="no_meja">
                <option value="">--Pilih Meja--</option>
                <?php foreach ($meja->result_array() as $row) { ?>
                <option value="<?php echo $row['no_meja'];?>"><?php echo $row['meja'];?></option>
                <?php } ?>
                </select>
              </div>
              <div class="row">
         <div class="col-lg-12">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Kode</th>
                  <th>Nama Item</th>
                  <th>Harga Satuan</th>
                  <th>Qty</th>
                  <th>Sub-Total</th>
                  <th>Aksi</th>
                </tr>
                </thead>  
                <tbody id="tb_pesanan">
              
                </tbody>
              </table>
        </div>
        </div>
       <!-- untuk total -->
            <div class="col-sm-4 pull-right">
            <div class="form-group">
              <label for="total" class="besar">Total (Rp) :</label>
                <input class="form-control " name="total_belum_pajak" id="total" placeholder="0" readonly="readonly" value="0" type="text" style="text-align:right;">
            </div>
            <div class="form-group">
                 <label for="pb1" class="besar">PB1 (%) :</label>
                <input class="form-control" type="number" id="pb1" value="<?php echo $pb1; ?>" readonly>
                <input type="hidden" name="pajak" id="pajak">               
            </div>  
            <div class="form-group">
              <label for="total" class="besar">Total Kena PB (Rp) :</label>
                <input class="form-control " name="total_kena_pb" id="total_kena_pb" placeholder="0" readonly="readonly" value="0" type="text" style="text-align:right;">
            </div>          
            <div class="form-group">
              <label for="bayar" class="besar">Bayar (Rp) :</label>
                <input class="form-control uang" name="bayar" placeholder="0" autocomplete="off" id="bayar" onkeyup="showKembali(this.value)" type="text" style="text-align:right;" required="required">
            </div>
            <div class="form-group">
              <label for="kembali" class="besar">Kembali (Rp) :</label>
                <input class="form-control" name="kembali" id="kembali" placeholder="0" readonly="readonly" type="text" style="text-align:right;">
            </div>
        
            </div>
            <!-- untuk total -->
           </div>
              <!-- /.box-body -->             
              <div class="box-footer">
                <button type="button" class="btn btn-primary" id="proses"><i class="fa fa-print"></i>  Cetak</button> 
                <button type="reset" class="btn btn-warning"><i class="fa fa-close"></i> Batal</button>
              </div>
            </form>
          </div>
  </div>
</div>
<div id="print-area" style="font-family: Calibri;display: none;">
</div>
</section>

<!-- Modal Edit data -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Ubah Pesanan</h4>
      </div>
      <div class="modal-body" id="edit_order">
        
      </div>
    </div>
  </div>
</div>
<!--END Modal Edit data -->

<!-- Modal barang -->
  <div class="modal fade" id="myBarang" role="dialog">
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
    </div>
<!--END Modal barang -->

<script type="text/javascript">
  $(document).ready(function(){ 
    $('#no_meja').change(function() {
      var no_meja=$('#no_meja').val();   
      var pb1=$('#pb1').val();
      $.ajax({
        type: 'POST',
        data: 'no_meja='+no_meja,
        url: '<?php echo base_url();?>kasir/show_order',
        success: function(data) {
        $('#tb_pesanan').html(data);
          var total=0;//variable awal
          $('tr td:nth-child(6)').each(function(){ //ambil nilai td ke 6
            var subtotal=$(this).html().replace(".", "").replace(".", ""); 
            total=total+parseInt(subtotal);  //total                     
          });
          $('#total').val(convertToRupiah(total));
          $('#pajak').val((pb1/100)*total);
          $('#total_kena_pb').val(convertToRupiah(((pb1/100)*total)+total));
        }
     });

    });
    $('#bayar').keyup(function() { //fungsi bayar
      var bayar=$('#bayar').val().replace('.', '').replace('.', '');
      var total=$('#total_kena_pb').val().replace('.', '').replace('.', '');
      var kembali=bayar-total;
      $('#kembali').val(convertToRupiah(kembali)); 
      return tandaPemisahTitik(this);
    });
     $('#bayar').keydown(function() {
      return numbersonly(this, event); 
    });

    $('#pb1').keyup(function(){
      var pb1=$(this).val();
      console.log(pb1);
      var total_tdk_pajak=$('#total_tdk_pajak').val().replace('.', '').replace('.', '');
      var pajak=((pb1/100)*total_tdk_pajak);
      $('#pajak').val(pajak);
      $('#total').val(convertToRupiah(parseInt(total_tdk_pajak)+parseInt(pajak)));
    });

    $('#proses').click(function() { //fungsi proses dan cetak
      var meja=$('#meja').val();
      var bayar=$('#bayar').val().replace('.', '').replace('.', '');
      var kembali=$('#kembali').val();
      var pajak=$('#pajak').val().replace('.', '').replace('.', '');
      var kode=$('#kode').html();
      var total_kena_pb=$('#total_kena_pb').val().replace('.', '').replace('.', '');
      if(bayar>0){
      $.ajax({
        type: 'POST',
        data: 'no_meja='+meja+'&bayar='+bayar+'&kembali='+kembali+'&kode='+kode+'&pajak='+pajak+'&total_setelah_pajak='+total_kena_pb,
        url: '<?php echo base_url();?>kasir/save_transaksi',
        success: function(data) {
          $('#print-area').html(data);
          printContent("print-area");
          window.location = '<?php echo base_url();?>kasir/transaksi';
        }
      });
      }else{
        alert("Masukkan Jumlah Pembayaran !");
      }
    });
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
  });
</script>
<script type="text/javascript">
function convertToRupiah(angka) {
  var rupiah = '';    
  var angkarev = angka.toString().split('').reverse().join('');
  for(var i = 0; i < angkarev.length; i++) 
      if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
      return rupiah.split('',rupiah.length-1).reverse().join('');  
}
function printContent(el){
  var restorepage = document.body.innerHTML;
  var printcontent = document.getElementById(el).innerHTML;
  document.body.innerHTML = printcontent;
  window.print();
  document.body.innerHTML = restorepage;
}
function confirmDel(obj) {
  var id=obj.parent().parent().find('.primary').html();
  var no_meja=$('#meja').val();
  // alert(no_meja);
    $.ajax({
        type: 'POST',
        data: 'no_meja='+no_meja+'&kode_pesanan='+id,
        url: '<?php echo base_url();?>kasir/delorder',
        success: function(data) {
        $('#tb_pesanan').html(data);
          var total=0;//variable awal
          $('tr td:nth-child(6)').each(function(){ //ambil nilai td ke 6
            var subtotal=$(this).html().replace(".", "").replace(".", ""); 
            total=total+parseInt(subtotal);  //total                     
          });
          $('#total').val(convertToRupiah(total));
        }
     });
}

function confirmEdit(obj) {  
  var id=obj.parent().parent().find('.primary').html();
  var subtotal=obj.parent().parent().find('.subtotal').html();
  var no_meja=$('#meja').val();
  $.ajax({
        type: 'POST',
        data: 'kode_pesanan='+id+'&subtotal='+subtotal+'&no_meja='+no_meja,
        url: '<?php echo base_url();?>kasir/editorder',
        success: function(data) {
          $('#edit_order').html(data);
        }
  });
}

function updateOrder() {
  var kode_pesanan=$('#kode_pesanan').val();
  var menu=$('#nama_menu').val();
  var qty=$('#qty').val();
  var harga=$('#harga').val().replace('.', '').replace('.', '');;
  var no_meja=$('#no_meja').val();
  $.ajax({
        type: 'POST',
        data: 'kode_pesanan='+kode_pesanan+'&menu='+menu+'&qty='+qty+'&harga='+harga+'&no_meja='+no_meja,
        url: '<?php echo base_url();?>kasir/updateorder',
        success: function(data) {
          $('#tb_pesanan').html(data);
          var total=0;//variable awal
          $('tr td:nth-child(6)').each(function(){ //ambil nilai td ke 6
            var subtotal=$(this).html().replace(".", "").replace(".", ""); 
            total=total+parseInt(subtotal);  //total                     
          });
          $('#total').val(convertToRupiah(total));
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

function pilihBrg(id_menu) {
  var id=id_menu;
  $('#id_menu').val(id);
    $.ajax({
        type: 'POST',
        data: 'id_menu='+id,
        url: '<?php echo base_url();?>pramusaji/pilihBrg',
        success: function(data) {
          $('#item').html(data);
          $('#qty').val('0');
          $('#sub_total').val('0');
        }
     });
  } 
</script>