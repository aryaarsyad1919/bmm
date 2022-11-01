<?php
class Articel extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('M_articel','m_articel');
		$this->load->model('M_pengunjung','m_pengunjung');
		$this->m_pengunjung->count_visitor();
	}

	function index(){
		$x['data']=$this->m_articel->get_all_falilitas();
		$this->load->view('frontend/articel_view',$x);
	}
}