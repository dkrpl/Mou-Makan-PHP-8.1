<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        BACKUP
        <small>DATA</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Backup</a></li>
        <li class="active"> Data</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
          <div class="box-header with-border">
              <h3 class="box-title">Backup Data</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Nama</th>                 
                  <th>Desksripsi</th>                 
                  <th>Terakhir Backup</th>                 
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>1</td>
                  <td>DB-BACKUP</td>
                  <td>Untuk backup seluruh data dalam database.</td>
                  <td><?php echo $log_db;?></td>
                  <td><a href='<?php echo base_url();?>report/backup_db' class='btn btn-flat btn-success' target='_blank'><i class='fa fa-download'></i> Backup Now</a ></td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>FILE-BACKUP</td>
                  <td>Untuk backup file - file menu makanan dan minuman.</td>
                  <td><?php echo $log_file;?></td>
                  <td><a href='<?php echo base_url();?>report/backup_file' class='btn btn-flat btn-success' target='_blank'><i class='fa fa-download'></i> Backup Now</a ></td>
                </tr>
                </tbody>
              </table>
              </div>
                <div class="box-footer">

            </div>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
 