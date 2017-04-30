<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hawk
 * Date: 9/14/2016
 * Time: 7:09 PM
 */


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Http_get extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('select_db');
    }


    //Grid Data==================================================
    public function load_suppliers()
    {

        $data_res = [];
        $counter = 0;

        $session_data=$this->session->userdata('logged_in');
        $data_res['logged_in']=true;
        if($session_data['is_admin']==true) {
            $data_res['title'] = ["#", "Code", "Name", "Phone", "Address", "Account", ""];
        }else {
            $data_res['title'] = ["#", "Code", "Name", "Phone", "Address", "Account"];
        }
        $data_res['print'] = [1,2,3,4,5];
        //$data_res['no_sort_last']=true;

        if( $data_res['logged_in']==true) {
            $result=$this->select_db->suppliers_grid('*');
            if (count($result) > 0) {



                foreach ($result as $data) {

                    $edit_button='<a href="#suppliers_add/edit/'.$data->id.'" title="Edit" class="btn btn-default btn-flat btn-xs" title="Information"><i class="fa fa-edit"></i></a>';
                    $info_button='<button onclick="id_to_scope('.$data->id.',\'remove_data\')"  class="btn btn-default btn-flat btn-xs" title="Remove"><i class="fa fa-trash-o"></i></button>';
                    $button_display=$edit_button.' '.$info_button;

                    $phone="N/A";
                    if($data->phone!="")$phone=$data->phone;

                    $account_no="N/A";
                    if($data->account_number!="")$account_no=$data->account_number;

                    $address="";
                    if($data->street_1=="" && $data->street_2=="" && $data->city=="" && $data->province=="" ){
                        $address="N/A";
                    }else {
                        $address= $data->street_1." ".$data->street_2." ".$data->city." ".$data->province;
                    }

                    $data_res['data'][$counter++] = array(
                        $counter,
                        $data->code,
                        $data->first_name,
                        $phone,
                        $address ,
                        $account_no,
                        $button_display
                    );
                }
            }else {
                $data_res['data'] = 0;
            }
        }
        echo json_encode($data_res);


    }

    //Grid Data==================================================
    public function load_weigh_bridge()
    {

        $request = file_get_contents("php://input"); // gets the raw data
        $params = json_decode($request, true); // true for return as array

        $data_res = [];
        $counter = 0;

        $session_data=$this->session->userdata('logged_in');
        $data_res['logged_in']=true;



        if($session_data['is_admin']==true) {
            $data_res['title'] = ["#","Status", "Bill No", "Product", "Vehicle No", "Supplier", "Date Time", "Weight"," "];
            $data_res['no_sort_last']=true;
        }else {
            $data_res['title'] = ["#","Status", "Bill No", "Product", "Vehicle No", "Supplier", "Date Time", "Weight"];
        }
        $data_res['print'] = [2,3,4,5,6,7,8];


        if( $data_res['logged_in']==true) {
            $result=$this->select_db->weigh_bridge('*',$params);
            if (count($result) > 0) {



                foreach ($result as $data) {
                    $status="<span class=\"label label-success\">Cleared</span>";
                    $button='<button onclick="id_to_scope('.$data->id.',\'Cleared\')" title="Rollback" class="disabled btn btn-default btn-flat btn-xs" title="Information"><i class="fa fa-check"></i></button>';//fa-undo

                    if($data->is_cleared==0){
                        $status="<span class=\"label label-danger\">Not Cleared</span>";
                        $button='<button onclick="id_to_scope('.$data->id.',\'mark_clear\')" title="Mark As Cleared" class="btn btn-success btn-flat btn-xs" title="Information"><i class="fa fa-check-square"></i></button>';
                    }

                    $data_res['data'][$counter++] = array(
                        $counter,
                        $status,
                        $data->	bill_no,
                        $data->product,
                        $data->truck_no,
                        $data->supplier_name." [".$data->supplier_code."]",
                        $data->	exit_date_time,
                        $data->first_weight."~".$data->second_weight,

                        $button

                    );
                }
            }else {
                $data_res['data'] = 0;
            }
        }
        echo json_encode($data_res);


    }

    public function load_suppliers_edit()
    {

        $request = file_get_contents("php://input"); // gets the raw data
        $params = json_decode($request, true); // true for return as array

        $data_res = [];
        $counter = 0;

        $data_res['logged_in']=true;
        //$data_res['no_sort_last']=true;

        if( $data_res['logged_in']==true) {
            $result=$this->select_db->suppliers_grid($params['data_id']);
            if (count($result) > 0) {


                $data_res['code']=201;
                foreach ($result as $data) {



                    $data_res['data']= array(
                        "code"=>$data->code,
                        "first_name"=>$data->first_name,
                        "phone"=>$data->phone,
                        "street_1"=>$data->street_1,
                        "street_2"=>$data->street_2,
                        "city"=>$data->city,
                        "province"=>$data->province ,
                        "account_number"=>$data->account_number,
                    );
                }
            }else {
                $data_res['data'] = 0;
            }
        }
        echo json_encode($data_res);


    }



    public function load_contracts()
    {
        $request = file_get_contents("php://input"); // gets the raw data
        $params = json_decode($request, true); // true for return as array

        $data_res = [];
        $counter = 0;

        $session_data=$this->session->userdata('logged_in');

        $data_res['logged_in']=true;
        $data_res['title'] = ["#", "Status","Contract ID", "Supplier","Product", "Created Date", "Expire Date", "Supply", "KG Price", ""];
        $data_res['print'] = [2,3,4,5,6,7,8,1];


        $available_suppliers=[];
        if( $data_res['logged_in']==true) {
            $result=$this->select_db->contract_grid('*',$params);
            if (count($result) > 0) {


                foreach ($result as $data) {
                    $remove_button="";
                    $edit_button="";
                    $info_button="";
                    $button_display="";
                    $label_text="";

                    $contract_str = substr($data->contract_no, 0, 3);
                    $sub_disabled="";
                    if($contract_str=="SUB"){
                        $sub_disabled="disabled";
                    }

                    $user_disable="";
                    if($session_data['is_admin']==false) {
                        $user_disable="disabled";
                    }

                    $finance_disable="";
                    if($session_data['user_role']=='finance_user'){
                        $finance_disable="disabled";
                    }

                    if($data->is_received==0){
                        $label_text="Canceled";
                        $status="<span class=\"label label-primary\">Pending</span>";
                        $edit_button='<a href="#purchase_order_add/amend/'.$data->id.'" title="Amend" class="'.$user_disable.' btn btn-primary btn-flat btn-xs" title="Information"><i class="fa fa-edit"></i></a>';
                        $remove_button='<button onclick="id_to_scope('.$data->id.',\'disable_data\')" title="Disable" class="'.$sub_disabled.' '.$finance_disable.' btn btn-danger btn-flat btn-xs" title="Information"><i class="fa fa-ban"></i></button>';
                        $button_display=$edit_button.' '.$remove_button;
                    }

                    if($data->is_received==1){
                        $label_text="Complete";
                        $status="<span class=\"label bg-purple\">Active</span>";
                        $complete_button='<button onclick="id_to_scope('.$data->id.',\'mark_complete\')" title="Mark As Complete" class="btn bg-olive btn-flat btn-xs" title="Information"><i class="fa fa-flag-checkered"></i></button>';
                        //$edit_button='<a href="#purchase_order_add/edit/'.$data->id.'" title="Edit" class="disabled btn btn-warning btn-flat btn-xs" title="Information"><i class="fa fa-edit"></i></a>';
                        $info_button='<button onclick="id_to_scope('.$data->id.',\'info_popup\')" title="Info" class="btn btn-info btn-flat btn-xs" title="Information"><i class="fa fa-exclamation-circle"></i></button>';
                        $button_display=$complete_button.' '.$info_button;
                    }

                    if($data->is_complete==1){
                        $is_sub_disable="";
                        if($data->sub_contract_id!='0')$is_sub_disable="disabled";

                        $label_text="Complete";
                        $status="<span class=\"label label-success\">Complete</span>";
                        if($session_data['user_role']=='finance_user' || $session_data['user_role']=='finance_admin') {
                            if($data->is_payed==0 ){
                                //$payment_button='<button onclick="id_to_scope('.$data->id.',\'mark_complete\')" title="Mark As Payed" class="btn bg-maroon btn-flat btn-xs" title="Information"><i class="fa fa-flag-checkered"></i></button>';
                                $complete_button='<button onclick="id_to_scope('.$data->id.',\'mark_payed\')" title="Mark As Payed" class="btn bg-teal btn-flat btn-xs" title="Information"><i class="fa  fa-money"></i></button>';
                            }
                        }else {
                            $complete_button = '<a href="#purchase_order_add/sub_contract/' . $data->id . '" title="Add Sub Contract" class="' . $is_sub_disable . ' btn btn-warning btn-flat btn-xs" title="Information"><i class="fa fa-newspaper-o"></i></a>';
                        }
                        //$edit_button='<a href="#purchase_order_add/edit/'.$data->id.'" title="Edit" class="disabled btn btn-warning btn-flat btn-xs" title="Information"><i class="fa fa-edit"></i></a>';
                        $info_button='<button onclick="id_to_scope('.$data->id.',\'info_popup\')" title="Info" class="btn btn-info btn-flat btn-xs" title="Information"><i class="fa fa-exclamation-circle"></i></button>';
                        $button_display=$complete_button.' '.$info_button;
                    }

                    if($data->is_amend==1){
                        $label_text="Amended";
                        $status="<span class=\"label label-warning\">Amended</span>";
                        $edit_button='<button onclick="id_to_scope('.$data->id.',\'amend_data\')" title="Amend" class="disabled btn btn-primary btn-flat btn-xs" title="Information"><i class="fa fa-edit"></i></button>';
                        $remove_button='<button onclick="id_to_scope('.$data->id.',\'disable_data\')" title="Disable" class="disabled btn btn-danger btn-flat btn-xs" title="Information"><i class="fa fa-ban"></i></button>';
                        $button_display=$edit_button.' '.$remove_button;
                    }
                    if($data->is_disabled==1){
                        $label_text="Disabled";
                        $status="<span class=\"label label-danger\">Disabled</span>";
                        $edit_button='<button onclick="id_to_scope('.$data->id.',\'amend_data\')" title="Amend" class="disabled btn btn-primary btn-flat btn-xs" title="Information"><i class="fa fa-edit"></i></button>';
                        $remove_button='<button onclick="id_to_scope('.$data->id.',\'disable_data\')" title="Disable" class="disabled btn btn-danger btn-flat btn-xs" title="Information"><i class="fa fa-ban"></i></button>';
                        $button_display=$edit_button.' '.$remove_button;
                    }

                    //if (new DateTime() >= new DateTime($data->expire_date_time)) {
                    if (date('yyyy-mm-dd') > date('yyyy-mm-dd',strtotime($data->expire_date_time))) {
                        # current time is greater than 2010-05-15 16:00:00


                        $payment_button='<button onclick="id_to_scope('.$data->id.',\'mark_payed\')" title="Complete" class="disabled btn btn-success btn-flat btn-xs" title="Information"><i class="fa  fa-calendar-check-o"></i></button>';

                        if($data->is_payed==0 ){
                            $disable_pay="";
                            if($session_data['user_role']=='user'){
                                $disable_pay="disabled";
                            }
                            //$payment_button='<button onclick="id_to_scope('.$data->id.',\'mark_complete\')" title="Mark As Payed" class="btn bg-maroon btn-flat btn-xs" title="Information"><i class="fa fa-flag-checkered"></i></button>';
                            $payment_button='<button onclick="id_to_scope('.$data->id.',\'mark_payed\')" title="Mark As Payed" class=" '.$disable_pay.' btn bg-teal btn-flat btn-xs" title="Information"><i class="fa  fa-money"></i></button>';
                        }

                        $is_disabled="";
                        $info_button='<button onclick="id_to_scope('.$data->id.',\'info_popup\')" title="Info" class="'.$is_disabled.' btn btn-info btn-flat btn-xs" title="Information"><i class="fa fa-exclamation-circle"></i></button>';
                        if($data->is_disabled==1 ){
                            $label_text="Disabled";
                            $is_disabled="disabled";
                            $payment_button='<button onclick="id_to_scope('.$data->id.',\'mark_complete\')" title="Mark As Payed" class="disabled btn btn-danger btn-flat btn-xs" title="Information"><i class="fa fa-calendar-times-o"></i></button>';
                        }
                        if($data->is_amend==1){
                            $label_text="Amended";
                            $is_disabled="disabled";
                            $payment_button='<button onclick="id_to_scope('.$data->id.',\'mark_complete\')" title="Mark As Payed" class="disabled btn btn-danger btn-flat btn-xs" title="Information"><i class="fa fa-calendar-times-o"></i></button>';
                        }
                        if($data->is_received==0){
                            $label_text="Expired";
                            $is_disabled="disabled";
                            $payment_button='<button onclick="id_to_scope('.$data->id.',\'mark_complete\')" title="Mark As Payed" class="disabled btn btn-default btn-flat btn-xs" title="Information"><i class="fa fa-calendar-times-o"></i></button>';
                            $info_button='<button onclick="id_to_scope('.$data->id.',\'info_popup\')" title="Info" class="disabled btn btn-default btn-flat btn-xs" title="Information"><i class="fa fa-exclamation-circle"></i></button>';

                        }


                        #Start DB transaction,,,, Return DB Group
                        $this->load->model('transactions_db');
                        $this->load->model('update_db');
                        $response=0;
                        $db_group=$this->transactions_db->transaction_start('default');


                        $update = array( //T:Char N : Numeric
                            'is_complete' => 1
                        );
                        $response = $this->update_db->contract($db_group, $update, $data->id);
                        $result=$this->transactions_db->transaction_end($db_group,$response);

                        $status="<span class=\"label label-default\">$label_text</span>";
                        $button_display=$payment_button.' '.$info_button;
                    }else {

                    }

                    /*if($session_data['is_admin']==false) {
                        if ($data->is_disabled == 1 || $data->is_amend == 1 || $data->is_received == 0) {
                            $button_display = $info_button = '<button onclick="id_to_scope(' . $data->id . ',\'info_popup\')" title="Info" class="disabled btn btn-info btn-flat btn-xs" title="Information"><i class="fa fa-exclamation-circle"></i> Info</button>';
                        }else  {
                            $button_display = $info_button = '<button onclick="id_to_scope(' . $data->id . ',\'info_popup\')" title="Info" class=" btn btn-info btn-flat btn-xs" title="Information"><i class="fa fa-exclamation-circle"></i> Info</button>';

                        }
                    }*/

                    $display_amount='';

                    if($data->total_weight==0){
                        $display_amount=$data->total_qty. ' QTY';
                    }else{
                        $display_amount=$data->total_weight.' KG';
                    }
                    $data_res['data'][$counter++] = array(
                        $counter,
                        $status,
                        $data->contract_no,
                        $data->first_name." [".$data->code."]",
                        $data->category_name,
                        date("Y/m/d",strtotime($data->created_date_time)),
                        date("Y/m/d",strtotime($data->expire_date_time)),
                        $display_amount,
                        $data->price,
                        $button_display
                    );
                }



            }else {
                $data_res['data'] = 0;
            }
        }
        echo json_encode($data_res);


    }

    public function load_contracts_edit()
    {
        $request = file_get_contents("php://input"); // gets the raw data
        $params = json_decode($request, true); // true for return as array

        $data_res = [];
        $counter = 0;

        $data_res['logged_in']=true;

        if( $data_res['logged_in']==true) {
            $result=$this->select_db->contract_grid($params['data_id'],'');
            if (count($result) > 0) {

                $data_res['code']=201;
                foreach ($result as $data) {

                    $data_res['data'] = array(
                        'contract_no'=>$data->contract_no,
                        'category_id'=>$data->category_id,
                        'first_name'=>$data->first_name,
                        'supplier_id'=>$data->supplier_id,
                        'created_date_time'=>date("m/d/Y",strtotime($data->created_date_time)),
                        'expire_date_time'=>date("m/d/Y",strtotime($data->expire_date_time)),
                        'total_qty'=>$data->total_qty,
                        'total_weight'=>$data->total_weight,
                        'price'=>$data->price
                    );
                }
            }else {
                $data_res['data'] = 0;
            }
        }
        echo json_encode($data_res);
    }

    public function load_note_grn()
    {

        $request = file_get_contents("php://input"); // gets the raw data
        $params = json_decode($request, true); // true for return as array

        $data_res = [];
        $counter = 0;

        $data_res['logged_in']=true;
        $data_res['title'] = ["#", "Bill No", "Supplier","Contract No","Product","Date Time", "Net Weight(KG)", "Price(1KG)","Total", ""];
        $data_res['no_sort_last']=true;
        $data_res['print'] = [1,2,3,4,5,6,7,8];

        if( $data_res['logged_in']==true) {
            $result=$this->select_db->note_grn_grid('*',$params);
            if (count($result) > 0) {
                foreach ($result as $data) {

                    $button_display = $info_button = '<button onclick="id_to_scope(' . $data->id . ',\'info_popup\')" title="Info" class=" btn btn-info btn-flat btn-xs" title="Information"><i class="fa fa-exclamation-circle"></i> Info</button>';

                    $data_res['data'][$counter++] = array(
                        $counter,
                        $data->bill_no,
                        $data->first_name." [".$data->code."]",
                        $data->contract_no,
                        $data->category_name,
                        $data->received_date_time,
                        $data->net_weight,
                        $data->price,
                        sprintf ("%.2f", $data->net_weight*$data->price),
                        $button_display
                    );
                }
            }else {
                $data_res['data'] = 0;
            }
        }
        echo json_encode($data_res);


    }

    public function load_grn_details()
    {

        $request = file_get_contents("php://input"); // gets the raw data
        $params = json_decode($request, true); // true for return as array

        $data_res = [];
        $counter = 0;

        $data_res['logged_in']=true;

        if( $data_res['logged_in']==true) {
            $result=$this->select_db->note_grn_info($params['data_id']);
            if (count($result) > 0) {

                $data_res['code']=201;
                foreach ($result as $data) {
                    $data_res['data'] = array(
                        'supplier' => $data->first_name,
                        'contract_no' => $data->contract_no,
                        'product' => $data->category_name,
                        'bill_no' => $data->bill_no,
                        'received_date_time' => $data->received_date_time,
                        'exit_date_time' => $data->received_date_time,
                        'truck_no' => $data->truck_no,
                        'truck_driver' => $data->truck_driver,
                        'price' => $data->price,
                        'first_weight' => $data->first_weight,
                        'second_weight' => $data->second_weight,
                        'net_weight' => $data->net_weight,
                        //'wet_weight' => $data->wet_weight,
                        'total_qty' => $data->total_qty,
                        'bad_qty' => $data->bad_qty,
                        'accepted_qty' => $data->accepted_qty,
                        "total"=>sprintf ("%.2f", $data->net_weight*$data->price)
                    );
                }
            }else {
                $data_res['data'] = 0;
            }
        }
        echo json_encode($data_res);


    }

    public function load_payment_voucher_old()//Uncomment to use
    {

        $this->load->model('select_db');
        $request = file_get_contents("php://input"); // gets the raw data
        $params = json_decode($request, true); // true for return as array


        /*if(isset($params['page_no']) && $params['page_no']!=""){
            echo $params['page_no'];
        }*/


        $data_res = [];
        $counter = 0;

        $data_res['logged_in']=true;
        $total_sum=0;
        $total_weight=0;
        $total_price=0;
        $bill_total=0;

        $total_sum_display=0;
        $total_weight_display=0;
        $total_price_display=0;



        if( $data_res['logged_in']==true) {


            $result=$this->select_db->note_grn_grid($params['data_id'],  $params);


                if (count($result) > 0) {
                    $page_count_value=0;
                    $pages_counter=1;

                    $data_res['code'] = 201;
                    foreach ($result as $data) {

                        $total_sum = sprintf("%.2f", $total_sum + ($data->net_weight * $data->price));
                        $total_price = $total_price + $data->price;
                        $total_weight = $total_weight + $data->net_weight;

                        if($page_count_value+($data->net_weight * $data->price) <= 1000000){
                            $page_count_value=$page_count_value+($data->net_weight * $data->price);
                        }else {
                            $page_count_value=($data->net_weight * $data->price);
                            $pages_counter++;
                        }

                        if(isset($params['page_no']) && $params['page_no']!="") {


                           // if (((1000000 * $params['page_no'])>= $total_sum) && ((1000000 * ($params['page_no']-1)) <= $total_sum ) && ($bill_total+($data->net_weight * $data->price) <=1000000) ) {
                            if ($params['page_no']==$pages_counter) {
                                $bill_total= $bill_total + ($data->net_weight * $data->price);
                                $total_sum_display = sprintf("%.2f",$total_sum_display + $data->net_weight * $data->price);
                                $total_weight_display = sprintf("%.2f",$total_weight_display + $data->price);
                                $total_price_display = sprintf("%.2f",$total_price_display + $data->net_weight);

                                $data_res['data'][$counter++] = array(
                                    "bill_no" => $data->bill_no,
                                    "supplier" => $data->first_name,
                                    //"bill_no"=>$data->contract_no,
                                    "truck_no" => $data->truck_no,
                                    "r_date" => $data->exit_date_time,
                                    "units" => $data->total_qty,
                                    "weight" => sprintf("%.2f",$data->net_weight),
                                    "price" => sprintf("%.2f",$data->price),
                                    "total" => sprintf("%.2f", $data->net_weight * $data->price)
                                );
                            }
                        }else {
                            $total_sum_display = sprintf("%.2f",$total_sum_display + $data->net_weight * $data->price);
                            $total_weight_display = sprintf("%.2f",$total_weight_display + $data->price);
                            $total_price_display = sprintf("%.2f",$total_price_display + $data->net_weight);

                            $data_res['data'][$counter++] = array(
                                "bill_no" => $data->bill_no,
                                "supplier" => $data->first_name,
                                //"bill_no"=>$data->contract_no,
                                "truck_no" => $data->truck_no,
                                "r_date" => $data->exit_date_time,
                                "units" => $data->total_qty,
                                "weight" => sprintf("%.2f",$data->net_weight),
                                "price" => sprintf("%.2f",$data->price),
                                "total" => sprintf("%.2f", $data->net_weight * $data->price)
                            );
                        }
                    }

                    $result2 = $this->select_db->contract_grid($params['data_id'],'');
                    if (count($result2) > 0) {
                        foreach ($result2 as $data) {


                            if(isset($params['page_no']) && $params['page_no']!="") {
                                $report_number = $data->report_number."/".$params['page_no'];
                            }else{
                                $report_number = $data->report_number;
                            }

                            if(isset($params['month_name']) && $params['month_name']!="") {
                                $report_number = $report_number."/".$params['month_name'];
                            }

                            $data_res['data_header'][0] = array(
                                "created_date" => date("Y/m/d", strtotime($data->created_date_time)),
                                "supplier" => $data->first_name,
                                "contract_no" => $data->contract_no,
                                "expire_date" => date("Y/m/d", strtotime($data->expire_date_time)),
                                "report_number" => $report_number,
                                "cheque_no" => $data->cheque_no,
                                "invoice_number" => $data->invoice_number,
                                "product" => $data->category_name,
                                "category_id" => $data->category_id
                            );
                        }
                    }

                    $data_res['data_total']['total_sum'] = $total_sum_display;
                    $data_res['data_total']['total_price'] = $total_weight_display;
                    $data_res['data_total']['total_weight'] = $total_price_display;
                    $data_res['data_total']['no_of_pages'] = $pages_counter;//ceil($total_sum / 1000000);

                    $result3 = $this->select_db->received_goods_months($params['data_id'], '');
                    $i=0;
                    if (count($result3) > 0) {
                        foreach ($result3 as $data) {
                            $data_res['months'][$i++]= array(
                                "month_start_date" => $data->date_start,
                                "month_name" => $data->month_name
                            );
                        }
                        $data_res['data_total']['no_of_months'] = $i;
                    }

                } else {
                    $data_res['data'] = 0;
                }

        }
        echo json_encode($data_res);


    }


    public function load_payment_voucher()
    {

        $this->load->model('select_db');
        $request = file_get_contents("php://input"); // gets the raw data
        $params = json_decode($request, true); // true for return as array


        $data_res = [];
        $counter = 0;

        $data_res['logged_in']=true;
        $total_sum=0;
        $total_weight=0;
        $total_price=0;
        $bill_total=0;

        $total_sum_display=0;
        $total_weight_display=0;
        $total_price_display=0;

        $counter=0;

        $no_of_bills=0;


        if( $data_res['logged_in']==true) {


            $result=$this->select_db->note_grn_grid($params['data_id'],"");


            if (count($result) > 0) {
                $page_count_value=0;
                $pages_counter=1;


                $all_bills[$counter]['bill']='All';
                $data_res['code'] = 201;
                foreach ($result as $data) {

                    $all_bills[++$counter]['bill']=$data->bill_no;

                    $total_sum = sprintf("%.2f", $total_sum + ($data->net_weight * $data->price));
                    $total_price = $total_price + $data->price;
                    $total_weight = $total_weight + $data->net_weight;

                    if($params['bill_no']=='All')$params['bill_no']='';

                    if(isset($params['bill_no']) && $params['bill_no']!="") {

                        $no_of_total_bills=count($result);
                        // if (((1000000 * $params['page_no'])>= $total_sum) && ((1000000 * ($params['page_no']-1)) <= $total_sum ) && ($bill_total+($data->net_weight * $data->price) <=1000000) ) {
                        if ($params['bill_no']==$data->bill_no) {
                            $bill_total= $bill_total + ($data->net_weight * $data->price);
                            $total_sum_display = sprintf("%.2f",$total_sum_display + $data->net_weight * $data->price);
                            $total_weight_display = sprintf("%.2f",$total_weight_display + $data->price);
                            $total_price_display = sprintf("%.2f",$total_price_display + $data->net_weight);

                            $data_res['data'][$counter++] = array(
                                "bill_no" => $data->bill_no,
                                "supplier" => $data->first_name,
                                //"bill_no"=>$data->contract_no,
                                "truck_no" => $data->truck_no,
                                "r_date" => $data->exit_date_time,
                                "units" => $data->accepted_qty,
                                "weight" => sprintf("%.2f",$data->net_weight),
                                "price" => sprintf("%.2f",$data->price),
                                "total" => sprintf("%.2f", $data->net_weight * $data->price)
                            );
                        }
                    }else {
                        $total_sum_display = sprintf("%.2f",$total_sum_display + $data->net_weight * $data->price);
                        $total_weight_display = sprintf("%.2f",$total_weight_display + $data->price);
                        $total_price_display = sprintf("%.2f",$total_price_display + $data->net_weight);
                        $no_of_total_bills=1;

                        $data_res['data'][$counter++] = array(
                            "bill_no" => $data->bill_no,
                            "supplier" => $data->first_name,
                            //"bill_no"=>$data->contract_no,
                            "truck_no" => $data->truck_no,
                            "r_date" => $data->exit_date_time,
                            "units" => $data->total_qty,
                            "weight" => sprintf("%.2f",$data->net_weight),
                            "price" => sprintf("%.2f",$data->price),
                            "total" => sprintf("%.2f", $data->net_weight * $data->price)
                        );
                    }

                    $result2 = $this->select_db->contract_grid($params['data_id'],'');
                    if (count($result2) > 0) {
                        foreach ($result2 as $data) {


                            if(isset($params['page_no']) && $params['page_no']!="") {
                                $report_number = $data->report_number."/".$params['page_no'];
                            }else{
                                $report_number = $data->report_number;
                            }

                            if(isset($params['month_name']) && $params['month_name']!="") {
                                $report_number = $report_number."/".$params['month_name'];
                            }

                            $data_res['data_header'][0] = array(
                                "created_date" => date("Y/m/d", strtotime($data->created_date_time)),
                                "supplier" => $data->first_name,
                                "contract_no" => $data->contract_no,
                                "expire_date" => date("Y/m/d", strtotime($data->expire_date_time)),
                                "report_number" => $report_number,
                                "cheque_no" => $data->cheque_no,
                                "invoice_number" => $data->invoice_number,
                                "product" => $data->category_name,
                                "category_id" => $data->category_id
                            );
                        }
                    }
                }

                $data_res['data_total']['total_sum'] = $total_sum_display;
                $data_res['data_total']['total_price'] = $total_sum_display/$total_price_display;//$total_weight_display/$no_of_total_bills;//$total_weight_display;
                $data_res['data_total']['total_weight'] = $total_price_display;
                $data_res['data_total']['all_bills'] = $all_bills;//ceil($total_sum / 1000000);
                $data_res['data_total']['no_of_bills'] = $counter;//ceil($total_sum / 1000000);

            } else {
                $data_res['data'] = 0;
            }

        }
        echo json_encode($data_res);


    }
    //...Grid Data==================================================


    //Dropdown and validation Data===================================

    public function load_available_suppliers()
    {

        $this->load->model('select_db');
        $request = file_get_contents("php://input"); // gets the raw data
        $params = json_decode($request, true); // true for return as array

        $data_res = [];
        $counter = 0;
        $data_res['code']=0;


        $current_supplier_id='';
        if($params['data_id']!=false)$current_supplier_id=$params['data_id'];

        $data_res['logged_in']=true;

        if( $data_res['logged_in']==true) {

            //Load Disabled Supplier for Display
            if($current_supplier_id!=''){
                $data_res['code']=201;
                $result2=$this->select_db->suppliers_grid($current_supplier_id);
                foreach ($result2 as $data) {

                    $data_res['data'][$counter++] = array(
                        'name' =>  $data->first_name,
                        'id' =>$data->id
                    );
                }
            }


            $result=$this->select_db->suppliers_active(true);
            if (count($result) > 0) {
                $data_res['code']=201;

                foreach ($result as $data) {

                        $data_res['data'][$counter++] = array(
                            'name' =>  $data->first_name,
                            'id' =>$data->id
                        );
                    }



            }


            if( $data_res['code']!=201){

                $data_res['code']=500;
                $data_res['data']=0;
            }

        }
        echo json_encode($data_res);


    }

    public function load_unavailable_suppliers()
    {
        $data_res = [];
        $counter = 0;

        $data_res['logged_in']=true;

        if( $data_res['logged_in']==true) {
            $result=$this->select_db->suppliers_active(false);
            if (count($result) > 0) {
                $data_res['code']=201;

                foreach ($result as $data) {

                    $data_res['data'][$counter++] = array(
                        'name' =>  $data->first_name,
                        'id' =>$data->id
                    );
                }}



           else {
                $data_res['code']=500;
                $data_res['data'] = 0;
            }
        }
        echo json_encode($data_res);


    }

    public function load_categories()
    {
        $data_res = [];
        $counter = 0;

        $data_res['logged_in']=true;

        if( $data_res['logged_in']==true) {
            $result=$this->select_db->categories(false);
            if (count($result) > 0) {
                $data_res['code']=201;

                foreach ($result as $data) {

                    $data_res['data'][$counter++] = array(
                        'name' =>  $data->category_name,
                        'id' =>$data->id
                    );
                }}



            else {
                $data_res['code']=500;
                $data_res['data'] = 0;
            }
        }
        echo json_encode($data_res);
    }
    //Dropdown and validation Data===================================

    public  function  load_contract_details(){


        $data_res = [];
        $counter = 0;

        $data_res['logged_in']=true;

        if( $data_res['logged_in']==true) {

            $supplier_id = $this->input->post('supplier_id');
            $result=$this->select_db->contact_details($supplier_id);


                if (count($result) > 0) {
                    $data_res['code']=201;

                    foreach ($result as $data) {

                        $data_res['data']['contract_detail'] = array(
                            'name' =>  $data->first_name,
                            'code' =>  $data->code,
                            'supplier_id' =>$data->supplier_id,
                            'contract_no' =>$data->contract_no,
                            'contract_id' =>$data->id,
                            'created_date_time' =>  date("Y/m/d",strtotime($data->created_date_time)),
                            'total_qty' =>  $data->total_qty,
                            'total_weight' =>  $data->total_weight,
                            'price' =>  $data->price,
                            'category_id' =>  $data->category_id,
                            'category_name' =>  $data->category_name,
                            'expire_date_time' => date("Y/m/d",strtotime( $data->expire_date_time))

                        );
                    }

                    //$result1=$this->select_db->get_bill_no($data_res['data']['contract_detail']['name'],$data_res['data']['contract_detail']['created_date_time'],$data_res['data']['contract_detail']['expire_date_time']);
                    $result1=$this->select_db->get_bill_no('*',$data_res['data']['contract_detail']['created_date_time'],$data_res['data']['contract_detail']['expire_date_time']);

                    if (count($result1) > 0) {
                        foreach ($result1 as $data) {

                            $data_res['data']['bill_nos'][$counter++] = array(
                                'id' =>  $data->id,
                                'name' =>$data->bill_no
                            );
                        }
                    }

                    else{
                        $data_res['data']['bill_nos']=array();
                    }

                }
            }else {
                $data_res['code']=500;
                $data_res['data'] = 0;
            }
        
        echo json_encode($data_res);

    }

    public  function  load_bill_details(){


        $data_res = [];
        $counter = 0;

        $data_res['logged_in']=true;

        if( $data_res['logged_in']==true) {

            $bill_no = $this->input->post('bill_no');
            $result=$this->select_db->get_bill_details($bill_no);
            if (count($result) > 0) {
                $data_res['code']=201;

                foreach ($result as $data) {

                    $data_res['data'][$counter++] = array(
                        'weigh_bill_id' =>  $data->id,
                        'product' =>  $data->product,
                        'supplier_name' =>  $data->supplier_name,
                        'supplier_code' =>  $data->supplier_code,
                        'bill_no' =>  $data->bill_no,
                        'received_date_time' =>  $data->received_date_time,
                        'exit_date_time' =>  $data->exit_date_time,
                        'truck_no' =>  $data->truck_no,
                        'truck_driver' =>  $data->truck_driver,
                        'first_weight' =>  $data->first_weight,
                        'second_weight' =>  $data->second_weight,
                        'total_qty' =>  $data->total_qty,
                        'bad_qty' =>  $data->bad_qty,
                        'accepted_qty' =>  $data->accepted_qty,
                        'w_b_operator' =>  $data->w_b_operator

                    );
                }
            }else {
                $data_res['code']=500;
                $data_res['data'] = 0;
            }
        }
        echo json_encode($data_res);

    }

    public  function  load_contract_and_bill_details()
    {


        $data_res = [];
        $counter = 0;

        $data_res['logged_in'] = true;

        if ($data_res['logged_in'] == true) {

            $supplier_id = $this->input->post('contract_no');
            $result = $this->select_db->contact_details_contract_no($supplier_id);


            if (count($result) > 0) {
                $data_res['code'] = 201;

                foreach ($result as $data) {

                    $data_res['data']['contract_detail'] = array(
                        'name' => $data->first_name,
                        'code' => $data->code,
                        'supplier_id' => $data->supplier_id,
                        'contract_no' => $data->contract_no,
                        'contract_id' => $data->id,
                        'created_date_time' => date("Y/m/d", strtotime($data->created_date_time)),
                        'total_qty' => $data->total_qty,
                        'total_weight' => $data->total_weight,
                        'price' => $data->price,
                        'category_id' => $data->category_id,
                        'category_name' => $data->category_name,
                        'expire_date_time' => date("Y/m/d", strtotime($data->expire_date_time))

                    );
                }

                /* //$result1=$this->select_db->get_bill_no($data_res['data']['contract_detail']['name'],$data_res['data']['contract_detail']['created_date_time'],$data_res['data']['contract_detail']['expire_date_time']);
                 $result1=$this->select_db->get_bill_no('*',$data_res['data']['contract_detail']['created_date_time'],$data_res['data']['contract_detail']['expire_date_time']);

                 if (count($result1) > 0) {
                     foreach ($result1 as $data) {

                         $data_res['data']['bill_nos'][$counter++] = array(
                             'id' =>  $data->id,
                             'name' =>$data->bill_no
                         );
                     }
                 }

                 else{
                     $data_res['data']['bill_nos']=array();
                 }*/

                $bill_no = $this->input->post('bill_id');
                $result = $this->select_db->get_bill_details($bill_no);
                if (count($result) > 0) {
                    $data_res['code'] = 201;

                    foreach ($result as $data) {

                        $data_res['data']['bill_details'] = array(
                            'weigh_bill_id' => $data->id,
                            'product' => $data->product,
                            'supplier_name' => $data->supplier_name,
                            'supplier_code' => $data->supplier_code,
                            'bill_no' => $data->bill_no,
                            'received_date_time' => $data->received_date_time,
                            'exit_date_time' => $data->exit_date_time,
                            'truck_no' => $data->truck_no,
                            'truck_driver' => $data->truck_driver,
                            'first_weight' => $data->first_weight,
                            'second_weight' => $data->second_weight,
                            'total_qty' => $data->total_qty,
                            'bad_qty' => $data->bad_qty,
                            'accepted_qty' => $data->accepted_qty,
                            'w_b_operator' => $data->w_b_operator

                        );
                    }
                }

            } else {
                $data_res['code'] = 500;
                $data_res['data'] = 0;
            }



        }
        echo json_encode($data_res);


    }
}