<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Load_view extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

	}

	private function index()
	{
		echo 'NO DIRECT ACCESS';
	}

	public function main()
	{


	}


	public function purchase_order() {
		$data=$this->session->userdata('logged_in');
		$data['active'] = 'purchase_order'; //class_name_in_simple/function_name, if the function is index just the class name
		$data['page_location'] = 'purchase_order';
		$data['page_name'] = 'Purchase Order';
		$data['company_name'] = 'CBL';

		$data['table_card_title']='Active Contracts';
		$data['table_card_icon']='fa fa-list-alt';
		$data['table_card_color']='box-default';
		$data['ajax_data_function']='api/http_get/load_contracts';

		if($data['user_role']!='finance_user')$data['add_button_link']='#purchase_order_add/add/0';


		$this->load->view('modules/data_table_card', $data);
		$this->load->view('data_grid/purchase_order_grid', $data);
	}

	public function note_grn() {
		$data=$this->session->userdata('logged_in');

		$data['active'] = 'note_grn'; //class_name_in_simple/function_name, if the function is index just the class name
		$data['page_location'] = 'note_grn';
		$data['page_name'] = 'Received Goods';
		$data['company_name'] = 'CBL';

		$data['table_card_title']='Cleared Deliveries';
		$data['table_card_icon']='fa fa-truck';
		$data['table_card_color']='box-default';
		$data['ajax_data_function']='api/http_get/load_note_grn';
		//$data['add_button_link']='#note_grn_add';
		//if($data['is_admin']==true)$data['add_button_link']='#note_grn_add';
		$data['hide_date_range_button']=false;

		$this->load->view('modules/data_table_card', $data);
		$this->load->view('data_grid/note_grn_grid', $data);
	}

	public function dashboard_content() {
		$data['active'] = 'dashboard'; //class_name_in_simple/function_name, if the function is index just the class name
		$data['page_location'] = 'dashboard';
		$data['page_name'] = 'Dashboard';
		$data['company_name'] = 'CBL';

		$this->load->view('dashboard', $data);
	}


	public function suppliers() {
		$data=$this->session->userdata('logged_in');

		$data['active'] = 'suppliers'; //class_name_in_simple/function_name, if the function is index just the class name
		$data['page_location'] = 'suppliers';
		$data['page_name'] = 'Suppliers';
		$data['company_name'] = 'CBL';

		$data['table_card_title']='All Suppliers';
		$data['table_card_icon']='fa fa-users';
		$data['table_card_color']='box-default';
		$data['hide_date_range_button']=true;
		$data['ajax_data_function']='api/http_get/load_suppliers';
		//if($data['is_admin']==true)$data['add_button_link']='#suppliers_add/add/0';

		if($data['user_role']!='finance_user')$data['add_button_link']='#suppliers_add/add/0';


		$this->load->view('modules/data_table_card', $data);
		//$this->load->view('data_grid/suppliers_grid', $data);
	}

	public function weigh_bridge() {
		$data=$this->session->userdata('logged_in');

		$data['active'] = 'weigh_bridge'; //class_name_in_simple/function_name, if the function is index just the class name
		$data['page_location'] = 'weigh_bridge';
		$data['page_name'] = 'Weigh Bridge';
		$data['company_name'] = 'CBL';

		$data['table_card_title']='Weigh Bridge Data';
		$data['table_card_icon']='fa fa-balance-scale';
		$data['table_card_color']='box-default';
		$data['hide_date_range_button']=false;
		$data['ajax_data_function']='api/http_get/load_weigh_bridge';
		//if($data['is_admin']==true)$data['add_button_link']='#suppliers_add/add/0';


		$this->load->view('modules/data_table_card', $data);
		$this->load->view('data_grid/weigh_bridge_grid', $data);
	}

}

?>