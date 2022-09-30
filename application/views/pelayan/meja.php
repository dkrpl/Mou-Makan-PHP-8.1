<section class="content-header">
  <h1>
    Pesan Meja
    <small>Pilih Meja</small>
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <?php
    $no = 0;
    foreach ($meja->result_array() as $row) {
      $no++;
      if ($no % 2 == 0) {
        $warna = 'small-box bg-blue';
      } else {
        $warna = 'small-box bg-red';
      }
    ?>
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="<?php echo $warna; ?>">
          <div class="inner">
            <h3><?php echo $row['meja']; ?></h3>
            <p>MOU-MAKAN</p>
          </div>
          <div class="icon">
            <i class="fa fa-cutlery" style="line-height: 130px;"></i>
          </div>
          <?php if ($row['dipesan'] == 'yes') { ?>
            <div class="small-box-footer"><a href="#" onclick="clear_meja('<?php echo $row['no_meja']; ?>')">Bersihkan <i class="fa fa-recycle"></i></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" onclick="order('<?php echo $row['no_meja']; ?>')">Order Lagi <i class="fa fa-arrow-circle-right"></i></a> </div>
          <?php } else { ?>
            <div class="small-box-footer">
              <a href="#" onclick="order('<?php echo $row['no_meja']; ?>')">Order <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          <?php } ?>
        </div>
      </div>
    <?php } ?>
  </div>
</section>
<script type="text/javascript">
  function order(no_meja) {
    document.location.href = "<?php echo base_url() . 'pramusaji/transaksi/'; ?>" + no_meja;
  }

  function clear_meja(no_meja) {
    var r = confirm("Pastikan tidak ada Costumer");
    if (r == true) {
      document.location.href = "<?php echo base_url() . 'pramusaji/clear_meja/'; ?>" + no_meja;
    }


  }
</script>