<section class="content-header">
  <h1>
    Kasir
    <small>Transaksi Langsung</small>
  </h1>

</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-lg-12">
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Transaksi Penjualan</h3>
        </div>

        <!-- form start -->
        <form role="form">
          <div class="box-body">
            <!-- <div class="col-lg-12">
        <div class="form-group">
            <div class="col-lg-2" style="width: 8%;">
                  <label class="control-label">Atas Nama</label>
                </div>
                <div class="input-group col-lg-10">
                <input class="form-control" type="text" id="nama" value="-" required="required">
                </div>
            </div>
            </div> -->
            <div class="col-lg-6">

              <div class="form-group">
                <div class="col-lg-2">
                  <label class="control-label">Atas Nama</label>
                </div>
                <div class="input-group col-lg-10">
                  <input class="form-control" type="text" id="nama" value="-" required="required">
                </div>
              </div>
              <div class="form-group">
                <div class="col-lg-2">
                  <label class="control-label">Kode</label>
                </div>
                <div class="input-group">
                  <input class="form-control col-lg-10" type="text" name="id_menu" id="id_menu">
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#myModal">Cari</button>
                  </span>
                </div>
              </div>
              <div id="item">
                <div class="form-group">
                  <div class="col-lg-2">
                    <label class="control-label">Item</label>
                  </div>
                  <div class="input-group col-lg-10">
                    <input class="form-control" type="text" id="nama_menu" readonly="readonly">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-lg-2">
                    <label class="control-label">Harga</label>
                  </div>
                  <div class="input-group col-lg-6">
                    <input class="form-control" id="harga" type="text" readonly="readonly" placeholder="0" style="text-align:right;">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-lg-2">
                  <label class="control-label">Qty</label>
                </div>
                <div class="input-group col-lg-4">
                  <input class="form-control" type="number" id="qty" placeholder="0" onkeyup="subTotal(this.value)">
                </div>
              </div>
              <div class="form-group">
                <div class="col-lg-2">
                  <label class="control-label">PB1 (%)</label>
                </div>
                <div class="input-group col-lg-2">
                  <input class="form-control" type="number" id="pb1" placeholder="0" value="<?php echo $pb1; ?>" readonly>
                </div>
              </div>
              <!-- <div class="form-group">
                 <div class="col-lg-2">
                  <label class="control-label">PB1</label>
                </div>
                  <div class="input-group col-lg-4">
                <input class="form-control" type="number" id="pb1" placeholder="0">
                </div>
            </div> -->
              <div class="form-group">
                <div class="col-lg-2">
                  <label class="control-label">Sub</label>
                </div>
                <div class="input-group col-lg-6">
                  <input class="form-control" type="text" readonly="readonly" id="sub_total" placeholder="0" style="text-align:right;">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-2">
                  <button type="button" class="btn btn-primary" onclick="add_cart()">
                    <i class="fa fa-cart-plus"></i> Tambah</button>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <input type="hidden" name="disc" id="disc" placeholder="0">
                <input type="hidden" name="pajak" id="pajak" value="<?php echo ($pb1 / 100) * $total; ?>">
                <h4>Total Sebelum Pajak</h4>
                <input class="form-control input-lg" type="text" readonly="readonly" placeholder="0" id="total_sebelum_pb1" value="<?php if (empty($total)) {
                                                                                                                                      echo "0";
                                                                                                                                    } else {
                                                                                                                                      echo number_format($total, 0, '', '.');
                                                                                                                                    } ?>" style="text-align:right;">


              </div>
              <div class="form-group">
                <h4>Total Setelah PB1</h4>
                <input class="form-control input-lg" type="text" readonly="readonly" placeholder="0" id="total" value="<?php if (empty($total)) {
                                                                                                                          echo "0";
                                                                                                                        } else {
                                                                                                                          $total_setelah_pb1 = ((($pb1 / 100) * $total) + $total);
                                                                                                                          echo number_format($total_setelah_pb1, 0, '', '.');
                                                                                                                        } ?>" style="text-align:right;">
              </div>
              <div class="form-group">
                <h4>Bayar</h4>
                <input class="form-control input-lg" type="text" placeholder="0" id="bayar" style="text-align:right;" required="required">
              </div>
              <div class="form-group">
                <h4>Kembali</h4>
                <input class="form-control input-lg" type="text" readonly="readonly" placeholder="0" id="kembali" style="text-align:right;">

              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Item</th>
                      <th>Harga</th>
                      <th>Qty</th>
                      <th>Disc</th>
                      <th>Sub Total</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody id="tb_transaksi">
                    <?php
                    $no = 0;
                    foreach ($cart as $items) {
                      $no++; ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $items['name']; ?></td>
                        <td><?php echo number_format($items['price'], 0, '', '.'); ?></td>
                        <td><?php echo $items['qty']; ?></td>
                        <?php if ($this->cart->has_options($items['rowid']) == TRUE) {
                          foreach ($this->cart->product_options($items['rowid']) as $disc => $disc_value) {
                        ?>
                            <td><?php echo $disc_value; ?></td>
                          <?php
                          }
                        } else {
                          ?>
                          <td><?php echo "0"; ?></td>
                        <?php } ?>
                        <td><?php echo number_format($items['subtotal'], 0, '', '.'); ?></td>
                        <td><a href="<?php echo base_url() . 'kasir/del_cart/' . $items['rowid']; ?>" class='btn btn-danger btn-flat btn-xs' id='del_trans' )">Hapus</a></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="box-footer pull-right">
              <a href="<?php echo base_url() . 'kasir/new_transaksi'; ?>" class="btn btn-warning" onclick="return confirm('Transaksi Baru ?');"><i class="fa fa-file"></i> New</a> <button type="button" class="btn btn-success" id="proses"><i class="fa fa-print"></i> Print</a>
            </div>
          </div>

      </div>
      </form>
    </div>
  </div>


  </div>

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
            <?php foreach ($barang->result() as $result) { ?>
              <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-aqua" style="background-image: url('<?php echo base_url(); ?>assets/menu/<?php echo $result->gambar; ?>');background-size: cover;"></span>
                  <div class="info-box-content">
                    <span class="info-box-text"><?php echo $result->nama_menu; ?></span>
                    <span class="info-box-number">Rp. <?php echo number_format($result->harga, 2); ?></span>
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
  <div id="print-area" style="font-family: Calibri;display: none;"></div>

  <script type="text/javascript">
    $(document).ready(function() {
      //untuk cari
      $('#keyword').keypress(function() {
        var key = $('#keyword').val();
        $.ajax({
          type: 'POST',
          data: 'keyword=' + key,
          url: '<?php echo base_url(); ?>kasir/cariBrg',
          success: function(data) {
            $('#barang').html(data);
          }
        });
      });
      //untuk kembalian
      $('#bayar').keyup(function() {
        var bayar = $('#bayar').val().replace('.', '').replace('.', '').replace('.', '');
        var total = $('#total').val().replace('.', '').replace('.', '').replace('.', '');
        var kembali = bayar - total;
        $('#kembali').val(convertToRupiah(kembali));
        return tandaPemisahTitik(this)
      });
      $('#bayar').keydown(function() {
        return numbersonly(this, event);
      });
      //untuk tampil nama, harga
      $('#id_menu').click(function() {
        var id = $('#id_menu').val();
        if (id == '') {
          $('#id_menu').focus();
        } else {
          $.ajax({
            type: 'POST',
            data: 'id_menu=' + id,
            url: '<?php echo base_url(); ?>kasir/pilihBrg',
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
      var id = id_menu;
      $('#id_menu').val(id);
      $.ajax({
        type: 'POST',
        data: 'id_menu=' + id,
        url: '<?php echo base_url(); ?>kasir/pilihBrg',
        success: function(data) {
          $('#item').html(data);
        }
      });
    }

    function clear() {
      $('#id_menu').val('');
      $('#harga').val('0');
      $('#qty').val('0');
      $('#nama_menu').val('');
      $('#sub_total').val('0');
    }

    function add_cart() {
      var id_menu = $('#id_menu').val();
      var nama_menu = $('#nama_menu').val();
      var harga = $('#harga').val();
      var qty = $('#qty').val();
      var disc = $('#diskon').val();
      var sub_total = $('#sub_total').val();
      if (disc == '') {
        var diskon = 0;
      } else {
        var diskon = disc;
      }
      $.ajax({
        type: 'POST',
        data: 'id_menu=' + id_menu + '&nama_menu=' + nama_menu + '&harga=' + harga + '&qty=' + qty + '&diskon=' + diskon + '&sub_total=' + sub_total,
        url: '<?php echo base_url(); ?>kasir/add_cart',
        success: function(data) {
          //$('#tb_transaksi').html(data);
          //clear();          
          window.location.href = '<?php echo site_url('kasir/langsung'); ?>';
        }
      });
    }

    function convertToRupiah(angka) {
      var rupiah = '';
      var angkarev = angka.toString().split('').reverse().join('');
      for (var i = 0; i < angkarev.length; i++)
        if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
      return rupiah.split('', rupiah.length - 1).reverse().join('');
    }

    function bayar(uang) {
      var bayar = uang;
      var total = $('#total').val();
      var kembali = bayar - total;
      $('#kembali').val(kembali);
    }

    function subTotal(qty) {
      var harga = $('#harga').val().replace(".", "").replace(".", "");
      var qty = $('#qty').val();
      $('#sub_total').val(convertToRupiah(harga * qty));
    }

    // function pb1(nilai) {
    //   var pb1=nilai;
    //   var total_tdk_pajak=$('#total_tdk_pajak').val();
    //   var pajak=((pb1/100)*total_tdk_pajak);
    //   $('#pajak').val(pajak);
    // }
    $('#pb1').keyup(function() {
      var pb1 = $(this).val();
      console.log(pb1);
      var total_tdk_pajak = $('#total_tdk_pajak').val();
      var pajak = ((pb1 / 100) * total_tdk_pajak);
      $('#pajak').val(pajak);
      $('#total').val(convertToRupiah(parseInt(total_tdk_pajak) + parseInt(pajak)));
    });

    // function disc(disc) {
    //   var harga = $('#harga').val().replace(".", "").replace(".", "");
    //   var qty=$('#qty').val();
    //   if(disc=='') {
    //    var potongan=0;
    //   } else {
    //     var potongan=(disc*harga)/100;
    //   } 
    //   new_harga=harga-potongan
    //   $('#harga').val(convertToRupiah(new_harga));
    // }
    $('#proses').click(function() { //fungsi proses dan cetak
      var bayar = $('#bayar').val().replace(".", "").replace(".", "");
      var nama = $('#nama').val();
      var kembali = $('#kembali').val();
      var pajak = $('#pajak').val();
      var total_setelah_pajak = $('#total').val().replace(".", "").replace(".", "");
      if (bayar != '' && nama != '') {
        $.ajax({
          type: 'POST',
          data: 'bayar=' + bayar + '&kembali=' + kembali + '&nama=' + nama + '&pajak=' + pajak + '&total_setelah_pajak=' + total_setelah_pajak,
          url: '<?php echo base_url(); ?>kasir/save_langsung',
          success: function(data) {
            $('#print-area').html(data);
            printContent("print-area");
            window.location = '<?php echo base_url(); ?>kasir/langsung';
          }
        });
      } else {
        alert("Masukkan Jumlah Pembayaran !");
      }
    });

    function printContent(el) {
      var restorepage = document.body.innerHTML;
      var printcontent = document.getElementById(el).innerHTML;
      document.body.innerHTML = printcontent;
      window.print();
      document.body.innerHTML = restorepage;
    }
  </script>