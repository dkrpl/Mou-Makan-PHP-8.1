 <!-- Content Header (Page header) -->
 <section class="content-header">
   <h1>
     Laporan
     <small>Restaurant</small>
   </h1>
   <ol class="breadcrumb">
     <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
     <li><a href="#">Laporan</a></li>
     <li class="active"> Transaksi</li>
   </ol>
 </section>

 <!-- Main content -->
 <section class="content">
   <div class="row">
     <div class="col-xs-12">
       <div class="box">
         <div class="box-header with-border">
           <h3 class="box-title">Laporan Penjualan</h3>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
           <form>
             <div class="form-group col-xs-5">
               <label>Dari</label>
               <input class="form-control" id="datepicker_awal" data-date-format="yyyy-mm-dd" name="tgl_awal" readonly="readonly" required="required">
             </div>
             <div class="form-group col-xs-5">
               <label>Sampai</label>
               <input class="form-control" id="datepicker_akhir" data-date-format="yyyy-mm-dd" name="tgl_akhir" readonly="readonly" required="required">
             </div>
             <div class="form-group col-xs-2">
               <label></label>
               <button type="button" class="btn btn-success btn-block" id="tampil"><i class="fa fa-file"></i> Tampilkan</button>
             </div>
           </form>
           <div id="loading" align="center"><img src="<?php echo base_url() . 'assets/img/loading.gif' ?>" widht="170px" height="170px"></div>
           <div class="col-xs-12" id="lap_jual">
             <table class="table table-bordered table-striped">
               <thead>
                 <tr>
                   <th>No</th>
                   <th>ID Transaksi</th>
                   <th>Tanggal</th>
                   <th>Jam</th>
                   <th>Kasir</th>
                   <th>Total</th>
                 </tr>
               </thead>
               <tbody>
                 <tr></tr>
               </tbody>
             </table>
             <div class="box-footer">
               <div class="col-xs-12 pull-right">
                 <button class="btn btn-flat btn-primary action"><i class="fa fa-print"></i> Cetak</button>
                 <!-- <button class="btn btn-flat btn-success"><i class="fa fa-file-excel-o"></i> Excel</button> -->
               </div>

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
 <script type="text/javascript">
   $(document).ready(function() {
     $('#lap_jual').hide();
     $('#loading').fadeOut(800);
     $('#lap_jual').fadeIn(3000);
     $('#tampil').click(function() {
       var tgl_awal = $('#datepicker_awal').val();
       var tgl_akhir = $('#datepicker_akhir').val();
       $.ajax({
         type: 'POST',
         data: 'awal=' + tgl_awal + '&akhir=' + tgl_akhir,
         url: '<?php echo base_url(); ?>report/rekap',
         success: function(data) {
           $('#lap_jual').hide();
           $('#lap_jual').html(data);
           $('#loading').show();
           $('#loading').fadeOut(1000);
           $('#lap_jual').fadeIn(2500);
         }
       });
     });
   });

   function print_data() {
     printContent("print-area");
     window.location = '<?php echo base_url(); ?>report';
     //alert("PRINT");
   }

   function printContent(el) {
     var restorepage = document.body.innerHTML;
     var printcontent = document.getElementById(el).innerHTML;
     document.body.innerHTML = printcontent;
     window.print();
     document.body.innerHTML = restorepage;
   }
 </script>