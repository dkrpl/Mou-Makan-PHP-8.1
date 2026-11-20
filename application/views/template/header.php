<?php
if ($this->session->userdata('akses') == 'admin') {
  $user = 'administrasi';
} else {
  $id = $this->session->userdata('username');
  $data = $this->Model_karyawan->get_byID($id);
  if ($data->num_rows() > 0) {
    $result = $data->row();
    $user = $result->nama;
  }
}
?>
<header class="main-header">
  <!-- Logo -->
  <a href="#" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>Kopi</b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Bicara</b> Kopi</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <?php $displayUser = isset($user) ? $user : ($this->session->userdata('nama') ?: ($this->session->userdata('akses') ?: 'User')); ?>
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="https://ielmy.files.wordpress.com/2011/06/user-icon.png" class="user-image" alt="User Image">
            <span class="hidden-xs"><?php echo ucfirst($displayUser); ?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="https://ielmy.files.wordpress.com/2011/06/user-icon.png" class="img-circle" alt="User Image">
              <p>
                <?php echo strtoupper($displayUser); ?>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <?php if ($this->session->userdata('akses') == 'admin') {
                  $Profil = "profil/edit_admin";
                } else {
                  $Profil = "profil/edit_karyawan";
                }
                ?>
                <a href="<?php echo base_url() . $Profil; ?>" class="btn btn-default btn-flat"><i class="fa fa-gear"></i> Profil</a>
              </div>
              <div class="pull-right">
                <a href="<?php echo base_url(); ?>login/logout" class="btn btn-default btn-flat" onclick="return confirm('Pastikan semua perkerjaan selasai ?')"><i class="fa fa-sign-out"></i> Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>