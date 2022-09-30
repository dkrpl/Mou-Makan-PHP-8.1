<?php
class Admin extends CI_controller
{

	function __construct()
	{
		parent::__construct();
		//tambahkan ini
		$this->load->library('template');
		$this->load->model('Model_admin');
		$this->load->model('Model_karyawan');
		$this->load->model('Model_transaksi');
	}

	function index()
	{
		$data['title'] = "Admin MOU-MAKAN";
		$data['admin'] = $this->Model_admin->get();
		$this->template->display_admin('admin/view_akun_admin', $data);
	}
	function reset_transaksi()
	{
		$data['title'] = "ADMIN INSTA RESTO | Reset Data Transaksi";
		$password = $this->input->post('password', true);
		if ($password != "") {
			if ($password == $this->config->item('pin')) {
				$this->Model_transaksi->clearAllDet();
				$this->Model_transaksi->clearAll();
				$this->Model_transaksi->clearAllPes();
?>
				<script>
					window.location = '<?php echo site_url('admin/reset_transaksi'); ?>';
					alert("BERHASIL MENGHAPUS SELURUH TRANSAKSI !");
				</script>
			<?php
			} else {
				//password salah
			?>
				<script>
					window.location = '<?php echo site_url('admin/reset_transaksi'); ?>';
					alert("PIN YANG ANDA MASUKAN SALAH !");
				</script>
<?php
			}
		}
		$this->template->display_admin('admin/reset-transaksi', $data);
	}
}
