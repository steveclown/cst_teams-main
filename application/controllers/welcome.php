<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		// $this->load->view('welcome_message');
		// $this->load->view('test');

		// $sesi 	= $this->session->userdata('unique');
		// print_r($sesi);
		// $expiry_time = time() - $this->session->session_id_ttl;
		// echo $_SESSION['regenerated']." ".$expiry_time."</br>";
		// if($_SESSION['regenerated']<=$expiry_time){
			// echo "expired";
		// }else{
			// echo "not exp";
		// }
		// $this->load->helper('string');
		// echo 4/0;
		$this->load->library('fungsi');
		// $this->load->model('Sales_model');
		// echo $this->Sales_model->getNota();
		$array = array(
			"foo" => "bar",
			42    => 24,
			"multi" => array(
				 "dimensional" => array(
					 "array" => "foo"
				 )
			)
		);
		
		$serial = $this->fungsi->_serialize($array);
		echo $serial;
		echo "</br>";
		print_r($this->fungsi->_unserialize($serial));
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */