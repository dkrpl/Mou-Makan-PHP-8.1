 <?php
  $akses = $this->session->userdata('akses');
  ?>
 <!-- sidebar: style can be found in sidebar.less -->
 <section style="height: auto;" class="sidebar">
   <!-- Sidebar user panel -->
   <div class="user-panel">
     <div class="pull-left image">
       <img src="<?php echo base_url('assets/img/logo.jpeg') ?>" class="img-circle" alt="User Image">
     </div>
     <div class="pull-left info" style="margin-top: 10px;">
       <p>Bicara <i>Kopi</i></p>
       <p>
     </div>
   </div>

   <!-- sidebar menu: : style can be found in sidebar.less -->
   <ul class="sidebar-menu">
     <?php if ($akses == '2') { ?>
       <li class="header">PRAMUSAJI</li>
       <li>
         <a href="<?php echo base_url() . 'pramusaji/meja' ?>">
           <i class="fa fa-coffee"></i> <span>Meja </span>
         </a>
       </li>
       <!--<li>
          <a href="<?php echo base_url() . 'dapur/order' ?>">
            <i class="fa fa-cutlery"></i> <span>Order Status </span>
          </a>
        </li>-->
       <li>
         <a href="<?php echo base_url(); ?>absensi">
           <i class="fa fa-barcode"></i> <span>Absensi </span>
         </a>
       </li>
     <?php } else if ($akses == '1') { ?>
       <li class="header">KASIR</li>
       <li class="treeview">
         <a href="#">
           <i class="fa fa-money"></i>
           <span>Transaksi</span>
           <i class="fa fa-angle-double-down"></i>
         </a>
         <ul class="treeview-menu" style="display: none;">
           <li><a href="<?php echo base_url(); ?>kasir/transaksi"><i class="fa fa-circle-o"></i> Order</a></li>
           <li><a href="<?php echo base_url(); ?>kasir/langsung"><i class="fa fa-circle-o"></i> Langsung</a></li>
           <li>
             <a href="<?php echo base_url(); ?>modal">
               <i class="fa fa-circle-o"></i> <span>Modal Awal </span>
             </a>
           </li>
         </ul>
       </li>

       <li class="treeview">
         <a href="<?php echo base_url(); ?>booking/transaksi">
           <i class="fa fa-money"></i>
           <span>Booking</span>
         </a>
       </li>

       <li class="treeview">
         <a href="<?php echo base_url() . 'pramusaji/meja' ?>">
           <i class="fa fa-money"></i>
           <span>Pesanan</span>
         </a>
       </li>

       <!-- <li class="treeview">
         <a href="#">
           <i class="fa fa-pie-chart"></i>
           <span>Laporan</span>
           <i class="fa fa-angle-double-down"></i>
         </a>
         <ul class="treeview-menu" style="display: none;">
           <li>
             <a href="<?php echo base_url() . 'report'; ?>">
               <i class="fa fa-book"></i> <span>Laporan Penjualan </span>
             </a>
           </li>
           <li>
             <a href="<?php echo base_url(); ?>report/rekap_kat">
               <i class="fa fa-book"></i> <span> Penjualan Per Kategori</span>
             </a>
           </li>
         </ul>
       </li> -->
       <!--<li>
          <a href="<?php echo base_url() . 'dapur/order' ?>">
            <i class="fa fa-cutlery"></i> <span>Order Status </span>
          </a>
        </li>-->
       <li>
         <a href="<?php echo base_url(); ?>kasir/ganti_sift" target="_blank">
           <i class="fa fa-exchange"></i> <span>Ganti Shift </span>
         </a>
       </li>
       <li>
       <li>
         <a href="<?php echo base_url(); ?>absensi">
           <i class="fa fa-barcode"></i> <span>Absensi </span>
         </a>
       </li>
     <?php } else if ($akses == '3') { ?>
       <!--<li class="header">KITCHEN</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-coffee"></i>
            <span>Pesanan/Order</span> 
            <i class="fa fa-angle-double-down"></i>
          </a>
          <ul class="treeview-menu" style="display: none;">
        <li>
          <a href="<?php echo base_url() . 'dapur/order'; ?>">
            <i class="fa fa-circle-o"></i> <span>Semua </span>
          </a>
        </li>
        <?php
        $qry = "SELECT * FROM tb_kategori ORDER BY id_kat ASC";
        $kategori = $this->db->query($qry);
        foreach ($kategori->result() as $row_kat) {
        ?>
          <li>
          <a href="<?php echo base_url() . 'dapur/orderbykat/' . $row_kat->id_kat; ?>">
            <i class="fa fa-circle-o"></i> <span><?php echo $row_kat->kategori; ?> </span>
          </a>
         </li>
          <?php
        }
          ?>

        </ul>
        </li>
       <li>
          <a href="<?php echo base_url(); ?>absensi">
            <i class="fa fa-barcode"></i> <span>Absensi </span>
          </a>
        </li>-->
     <?php } else { ?>
       <li class="header">ADMIN</li>
       <li class="treeview">
         <a href="<?php echo base_url(); ?>report/grafik">
           <i class="fa fa-dashboard"></i> <span>Home</span>
         </a>

       </li>
       <li class="treeview">
         <a href="#">
           <i class="fa fa-pie-chart"></i>
           <span>Data Master</span>
           <i class="fa fa-angle-double-down"></i>
         </a>
         <ul class="treeview-menu" style="display: none;">
           <li>
             <a href="<?php echo base_url(); ?>karyawan">
               <i class="fa fa-users"></i> <span>Data Karyawan </span>
             </a>
           </li>
           <li>
             <a href="<?php echo base_url(); ?>meja">
               <i class="fa fa-cutlery"></i> <span>Data Meja </span>
             </a>
           </li>
           <li>
             <a href="<?php echo base_url(); ?>kategori">
               <i class="fa fa-coffee"></i> <span>Data Kategori </span>
             </a>
           </li>
           <li>
             <a href="<?php echo base_url(); ?>menu">
               <i class="fa fa-server"></i> <span>Data Menu </span>
               <span class="pull-right-container">

               </span>
             </a>
           </li>
           <li>
             <a href="<?php echo base_url(); ?>pajak">
               <i class="fa fa-tag"></i> <span>Nilai PB1 </span>
             </a>
           </li>
           <!--<li>
          <a href="<?php echo base_url(); ?>admin">
            <i class="fa fa-child"></i> <span>Data Admin </span>
          </a>
        </li>-->
         </ul>
       </li>
       <li class="treeview">
         <a href="#">
           <i class="fa fa-pie-chart"></i>
           <span>Laporan</span>
           <i class="fa fa-angle-double-down"></i>
         </a>
         <ul class="treeview-menu" style="display: none;">
           <li>
             <a href="<?php echo base_url(); ?>report">
               <i class="fa fa-book"></i> <span> Rekap. Penjualan </span>
             </a>
           </li>
           <li>
             <a href="<?php echo base_url(); ?>report/rekap_kat">
               <i class="fa fa-book"></i> <span> Penjualan Per Kategori</span>
             </a>
           </li>
           <li>
             <a href="<?php echo base_url(); ?>report/pelayanan">
               <i class="fa fa-book"></i> <span> Kinerja Pramusaji</span>
             </a>
           </li>
           <li>
             <a href="<?php echo base_url(); ?>report/absensi">
               <i class="fa fa-book"></i> <span> Absensi Karyawan</span>
             </a>
           </li>
         </ul>
       </li>
       <li>
         <a href="<?php echo base_url(); ?>report/backup">
           <i class="fa fa-file"></i> <span>Backup Data</span>
           <span class="pull-right-container">

           </span>
         </a>
       </li>
       <li>
         <a href="<?php echo base_url(); ?>admin/reset_transaksi">
           <i class="fa fa-recycle"></i> <span>Reset Transaksi</span>
           <span class="pull-right-container">

           </span>
         </a>
       </li>
     <?php } ?>
   </ul>
 </section>
 <!-- /.sidebar -->