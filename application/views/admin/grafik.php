<?php
 foreach ($penjualan->result_array() as $row ) { //untuk grafik penjualan
   $bulan[]=$row['bulan'];
   $total_penjualan[]=(int)$row['total_penjualan'];
 }
 foreach ($barang->result_array() as $row ) { //untuk grafik barang
   $item[]=$row['item'];
   $jumlah_barang[]=(int)$row['jumlah'];
 }
 foreach ($kategori->result_array() as $row ) { //untuk grafik kategori
   $kat[]=array('name'=>$row['kategori'], 'y'=>(int)$row['jumlah']);
 }
?>
<script src="<?php echo base_url().'assets/';?>plugins/highcharts/highcharts.js"></script>
<script src="<?php echo base_url().'assets/';?>plugins/highcharts/modules/exporting.js"></script>    
<script src="<?php echo base_url().'assets/';?>plugins/highcharts/js/themes/grid.js"></script>  
<script type="text/javascript">
$(function () {
    Highcharts.chart('container_penjualan', { //untuk penjualan
        chart: {
            type: 'line'
        },
        title: {
            text: 'Penjualan Per Bulan'
        },
        subtitle: {
            text: <?php echo date('Y');?>
        },
        xAxis: {
            categories: <?php echo json_encode($bulan);?>            
        },
        yAxis: {
            title: {
                text: 'Total Penjualan (Rp.)'
            }
        },
        tooltip: {
            valueSuffix: ' rupiah'
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        }, 
        series: [{
            name: 'Total Penjualan',
            data: <?php echo json_encode($total_penjualan);?>
        }]
    });

    Highcharts.chart('container_barang', { //untuk barang
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Item yang Populer'
        },
        subtitle: {
            text: 'Bulan Ini'
        },
        xAxis: {
            categories: <?php echo json_encode($item);?>            
        },
        yAxis: {
            title: {
                text: 'Total'
            }
        },
        tooltip: {
            valueSuffix: ' Item'
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        }, 
        series: [{
            name: 'Jumlah yang terjual',
            data: <?php echo json_encode($jumlah_barang);?>
        }]
    });
    Highcharts.chart('container_kategori', { //untuk kategori
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Barang terjual Per Kategori'
        },
        subtitle: {
            text: 'Bulan ini'
        },
        tooltip: {
            valueSuffix: ' item'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        }, 
        series: [{
            name: 'Jumlah yang terjual',
            data: <?php echo json_encode($kat);?>
        }]
    });
});
</script>

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard Admin
        <small>Restaurant</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Dashboard</a></li>
        <li class="active">Grafik</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
      <!-- Grafik-->
        <div class="col-lg-12">
          <div class="box box-danger">
             <div class="box-header with-border">
              <h3 class="box-title">Rekapitulasi Penjualan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <div id="container_penjualan" style="width:100%; height:300px;"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

        <!-- Grafik-->
        <div class="col-lg-6">
          <div class="box box-danger">
             <div class="box-header with-border">
              <h3 class="box-title">Rekap Penjualan Item</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <div id="container_barang" style="width:100%; height:300px;"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

        <!-- Grafik-->
        <div class="col-lg-6">
          <div class="box box-danger">
             <div class="box-header with-border">
              <h3 class="box-title">Rekap Penjualan Kategori</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <div id="container_kategori" style="width:100%; height:300px;"></div>
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
	
	