<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Load_form extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	private function index()
	{
		echo 'NO DIRECT ACCESS';
	}


	public function purchase_order_add() {
		$data['active'] = 'purchase_order'; //class_name_in_simple/function_name, if the function is index just the class name
		$data['page_location'] = 'purchase_order';
		$data['page_name'] = 'Purchase Order';
		$data['company_name'] = 'CM8';

		$this->load->view('form/purchase_order_add', $data);
	}

	public function note_grn_add() {
		$data['active'] = 'note_grn'; //class_name_in_simple/function_name, if the function is index just the class name
		$data['page_location'] = 'note_grn';
		$data['page_name'] = 'Received Goods';
		$data['company_name'] = 'CM8';

		$this->load->view('form/note_grn_add', $data);
	}

	public function suppliers_add() {
		$data['active'] = 'suppliers'; //class_name_in_simple/function_name, if the function is index just the class name
		$data['page_location'] = 'suppliers';
		$data['page_name'] = 'Suppliers';
		$data['company_name'] = 'CM8';


		$this->load->view('form/suppliers_add', $data);
	}

}

?>