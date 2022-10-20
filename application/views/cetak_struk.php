<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="<?php echo base_url() . 'assets/'; ?>print.css" target rel="stylesheet" media="print">
</head>

<body>
    <div class="title" style="font-size: 10px;">
        <!-- <center><img src="<?php echo base_url('assets/img/1553659740762.png'); ?>" width='autoWidth' height='50px'></center> -->
        <center>
            <?php echo $this->config->item('header_print'); ?><br>
            <small><?php echo $this->config->item('alamat_print'); ?></small>
            <hr style="border-color: black;">

        </center>
    </div>
    <table class="content" style="font-size: 8px;">
        <tr>
            <td>No</td>
            <td>: <?php echo $id_transaksi; ?></td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>: <?php echo date('d-m-Y'); ?></br></td>
        </tr>
        <tr>
            <td>Pembeli</td>
            <td>: <?php echo $nama_pelanggan; ?></br></td>
        </tr>
        <tr>
            <td>Meja</td>
            <td>: <?php echo $no_meja; ?></br></td>
        </tr>
        <tr>
            <td>Kasir</td>
            <td>: <?php echo $id_karyawan; ?></td>
        </tr>
    </table>

    <!-- tampilkan ketika dalam mode print -->
    <hr style="border-color: black;">
    <table style="font-size: 8px;" class="content">
        <tr>
            <td width="50%">Nama</td>
            <td width="15%">Qty</td>
            <td>Harga</td>
        </tr>
        <?php
        $no = 0;
        $total = 0;
        foreach ($data as $row) {
            $no++;
        ?>
            <tr>
                <td><?php echo $row->menu; ?></td>
                <td><?php echo $row->qty; ?></td>
                <td>Rp <?php echo number_format($row->harga * $row->qty, 0, '', '.'); ?>,-</td>
            </tr>

        <?php
            $total = $total + ($row->harga * $row->qty);
        }
        if ($total > 0) {
            $jml = $total;
        } else {
            $jml = '0';
        }
        //menambah pajak 
        $total_kena_pajak = $jml + $pajak;
        ?>
    </table>
    <hr style="border-color: black;">
    <table style="font-size: 8px;">
        <tr>
            <td width="40%">Total</td>
            <td>: Rp <?php echo number_format($jml, 0, '', '.'); ?>,-</td>
        </tr>
        <tr>
            <td width="40%">PB 1</td>
            <td>: Rp <?php echo number_format($pajak, 0, '', '.'); ?></td>
        </tr>
        <tr>
            <td width="40%">Total Kena Pajak</td>
            <td>: Rp <?php echo number_format($total_kena_pajak, 0, '', '.'); ?>,-</td>
        </tr>
        <tr>
            <td width="40%">Bayar</td>
            <td>: Rp <?php echo number_format($bayar, 0, '', '.'); ?>,-</td>
        </tr>
        <tr>
            <td width="40%">Kembali</td>
            <td>: Rp <?php echo $kembali ?>,-</td>
        </tr>
    </table>


    </div>
    <br>
    <center style="font-size: 8px;" class="footer">
        <?php echo $this->config->item('footer_print'); ?>
    </center>
    </div>
    <?php ?>


    <script type="text/javascript">
        setTimeout(function() {
            window.print();
        }, 500);
        window.onfocus = function() {
            setTimeout(function() {
                window.close();
            }, 500);
        }
    </script>
</body>

</html>