<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hawk
 * Date: 9/14/2016
 * Time: 7:09 PM
 */


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Http_post extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('transactions_db');
        $this->load->model('insert_db');

    }


    public function save_category()
    {

        #Start DB transaction,,,, Return DB Group
        $db_group=$this->transactions_db->transaction_start('default');

        $data = array(
            //'id' => $values->id,
            'category_name' => "asdsda"
        );
        #Insert Data,,return last ID on success
        $response=$this->insert_db->categories($db_group, $data);

        #Commit Or rollback Transaction : Return Http MSG -> has_error ,,, code (500,201,400),,, message
        $result=$this->transactions_db->transaction_end($db_group,$response);

        #Uncomment to Override the response
        //$result['data']="";
        //$result['has_error']=false;
        //$result['code']=0;
        //$result['message']="";

        echo json_encode($result);#send $response as a JSON string

    }

    public function save_suppliers()
    {

        $client_data = json_decode(file_get_contents('php://input'), true); //get json data from ajax call
        //print_r($client_data);

        #Start DB transaction,,,, Return DB Group
        $db_group=$this->transactions_db->transaction_start('default');

        foreach($client_data['form_data'] as $key => $value) {

            $data = array( //T:Char N : Numeric
                //'id' => $values->id,
                'code' => $value['supplier_code'],
                'first_name' => $value['supplier_name'],
                'phone' => $value['phone'],
                'account_number' => $value['supplier_account'],
                'street_1' => $value['street1'],
                'street_2' => $value['street2'],
                'city' => $value['supplier_city'],
                'province' => $value['province'],
                'postal_code' => $value['postal_code'],
                'country' => 'Sri Lanka',
                'type' => '1'
            );
            #Insert Data,,return last ID on success
            $response = $this->insert_db->people($db_group, $data);

        }

        #Commit Or rollback Transaction : Return Http MSG -> has_error ,,, code (500,201,400),,, message
        $result=$this->transactions_db->transaction_end($db_group,$response);

        #Uncomment to Override the response
        //$result['data']="";
        //$result['has_error']=false;
        //$result['code']=0;
        //$result['message']="";

        echo json_encode($result);#send $response as a JSON string
    }

    public function save_contract()
    {
        $this->load->model('select_db');
        $this->load->model('update_db');

        $client_data = json_decode(file_get_contents('php://input'), true); //get json data from ajax call
        //print_r($client_data);
        /*foreach($client_data['form_data'] as $key => $value) {
            echo date('Y-m-d H:i:s',strtotime($value['expire_date']));
        }*/
        #Start DB transaction,,,, Return DB Group
        $db_group=$this->transactions_db->transaction_start('default');

        foreach($client_data['form_data'] as $key => $value) {

            $result0=$this->select_db->number_of_contracts($db_group,$value['category_id']);
            $last_id=$result0;
            $total_records=$last_id;
            /*foreach ($result0 as $value0) {
                $last_id=$value0->max_no;

            }*/

            $result3=$this->select_db->last_report_id($db_group);
            $last_report_no=0;
            foreach ($result3 as $value3) {
                $last_report_no=$value3->report_number;
            }

            if($last_report_no==0)$last_report_no=3500;
            else $last_report_no++;

            $contract_no='CON/'.$value['category_id'].'/'.($last_id+1);


            for($i=0;$i<$total_records;$i++)
            {

                if($this->select_db->contract_numbers_exist($db_group,$contract_no)==true){
                    $last_id++;
                    $contract_no='CON/'.$value['category_id'].'/'.$last_id;
                }else break;

            }

            $public_contract_no='0';
            if(!isset($value['contract_no']) || $value['contract_no']!=''){
                $public_contract_no=$value['contract_no'];
            }else{
                $public_contract_no='0';
            }

            if(isset($value['amend_mode'])&& $value['amend_mode']==false){
                $main_contract_number = substr($value['contract_no'], strrpos($value['contract_no'], '/') + 1);
                if (strpos($value['contract_no'], '-') !== false){
                    $sub_contract_number_offset = (int)substr($value['contract_no'], strrpos($value['contract_no'], '-') + 1);
                    $contract_no = 'SUB/' . $value['category_id'] . '/' . (strtok($main_contract_number, '-')).'-'.($sub_contract_number_offset+1);

                }else{
                    $contract_no = 'SUB/' . $value['category_id'] . '/' . ($main_contract_number).'-1';
                }

                    $data = array( //T:Char N : Numeric
                        'sub_contract_id' => 1
                    );
                    $response = $this->update_db->contract($db_group, $data,$value['modify_id']);

            }
            if(isset($value['amend_mode'])&& $value['amend_mode']==true){
                $contract_no=$value['contract_no'];
            }

            $data = array( //T:Char N : Numeric
                //'id' => $values->id,
                'contract_no' =>$contract_no,
                'supplier_id' => $value['supplier_id'],
                'category_id' => $value['category_id'],
                'created_date_time' =>date('Y-m-d H:i:s'),
                'expire_date_time' => date('Y-m-d',strtotime($value['expire_date'])),
                'price' => $value['kg_price'],
                'total_weight' => $value['total_weight'],
                'sub_contract_no' => $public_contract_no,
                'total_qty' => $value['total_units'],
                'report_number' => $last_report_no,
                'is_complete' => 0

            );
            #Insert Data,,return last ID on success
            $response = $this->insert_db->contract($db_group, $data);

            $update = array( //T:Char N : Numeric
                'is_disabled' => 1
            );
            $response = $this->update_db->people($db_group, $update, $value['supplier_id']);

            if($response!=0 && (isset($value['modify_id'])&& $value['modify_id']!="") && (isset($value['amend_mode'])&& $value['amend_mode']==true)){
                $data = array( //T:Char N : Numeric
                    'is_amend' => 1
                );
                $response = $this->update_db->contract($db_group, $data,$value['modify_id']);
            }



        }

        #Commit Or rollback Transaction : Return Http MSG -> has_error ,,, code (500,201,400),,, message
        $result=$this->transactions_db->transaction_end($db_group,$response);

        #Uncomment to Override the response
        //$result['data']="";
        //$result['has_error']=false;
        //$result['code']=0;
        //$result['message']="";

        echo json_encode($result);#send $response as a JSON string
    }

    //manually save received Goods
    public function save_received_goods()
    {
        $this->load->model('select_db');
        $this->load->model('update_db');

        $client_data = json_decode(file_get_contents('php://input'), true); //get json data from ajax call
       // print_r($client_data);

        $result=$this->select_db->check_bill_no($client_data['form_data'][0]['bill_no']);
        if (count($result) <= 0) {
            #Start DB transaction,,,, Return DB Group
            $db_group = $this->transactions_db->transaction_start('default');

            foreach ($client_data['form_data'] as $key => $value) {

                $data = array( //T:Char N : Numeric
                    'supplier_id' => $value['supplier_id'],
                    'contract_no' => $value['contract_no'],
                    'contract_id' => $value['contract_id'],//Contract ID
                    'category_id' => $value['category_id'],
                    'product' => $value['product'],
                    'bill_no' => $value['bill_no'],
                    'bill_id' => $value['bill_id'],
                    'received_date_time' => $value['received_date_time'],
                    'exit_date_time' => $value['exit_date_time'],
                    'truck_no' => $value['truck_no'],
                    'truck_driver' => $value['truck_driver'],
                    'price' => $value['price'],
                    'first_weight' => $value['first_weight'],
                    'second_weight' => $value['second_weight'],
                    'net_weight' => $value['first_weight'] - $value['second_weight'],
                    'wet_weight' => 0,
                    'total_qty' => $value['total_qty'],
                    'bad_qty' => $value['bad_qty'],
                    'accepted_qty' => $value['accepted_qty'],
                    'w_b_operator' => $value['w_b_operator']

                );


                #Insert Data,,return last ID on success
                $response = $this->insert_db->received_goods($db_group, $data);
                if ($response != 0) {
                    $data = array( //T:Char N : Numeric
                        'is_received' => 1
                    );
                    $response = $this->update_db->contract($db_group, $data, $value['contract_id']);
                }
                if ($response != 0) {
                    $data = array( //T:Char N : Numeric
                        'is_cleared' => 1
                    );
                    $response = $this->update_db->weigh_bills($db_group, $data, $value['bill_id']);
                }

            }

            #Commit Or rollback Transaction : Return Http MSG -> has_error ,,, code (500,201,400),,, message
            $result = $this->transactions_db->transaction_end($db_group, $response);

            #Uncomment to Override the response
            //$result['data']="";
            //$result['has_error']=false;
            //$result['code']=0;
            //$result['message']="";


        }else {
            //$result['data']="";
            $result['has_error']=false;
            $result['code']=409;
            $result['message']="Data Already Exist";
        }

        echo json_encode($result);#send $response as a JSON string
    }

    //Sync received Goods
    public function sync_received_goods()
    {

        $this->load->model('select_db');
        $this->load->model('update_db');
        $counter=0;
        $response=0;
        #Start DB transaction,,,, Return DB Group
        $db_group=$this->transactions_db->transaction_start('default');

        $result0=$this->select_db->last_bill_no($db_group);

        foreach ($result0 as $value) {
            $last_bill=$value->max_no;
        }

        if($last_bill==null)$last_bill=1;


        $result=$this->select_db->valid_contracts_sync($db_group);
        if (count($result) > 0) {
            foreach ($result as $value) {
                $result2=$this->select_db->weigh_bills_sync($db_group,$value->code,$value->category_id,$last_bill,$value->created_date_time,$value->expire_date_time);
                    foreach ($result2 as $value2) {
                        $data = array( //T:Char N : Numeric
                            'supplier_id' => $value2->supplier_id,
                            'contract_no' => $value->contract_no,
                            'contract_id' => $value->id,//Contract ID
                            'category_id' => $value2->category_id,
                            'product' => $value2->category_name,
                            'bill_no' => $value2->bill_no,
                            'bill_id' => $value2->id,
                            'received_date_time' => $value2->received_date_time,
                            'exit_date_time' => $value2->exit_date_time,
                            'truck_no' => $value2->truck_no,
                            'truck_driver' => $value2->truck_driver,
                            'price' => $value->price,
                            'first_weight' => $value2->first_weight,
                            'second_weight' => $value2->second_weight,
                            'net_weight' => $value2->first_weight - $value2->second_weight ,
                            'wet_weight' => 0,
                            'total_qty' => $value2->total_qty,
                            'bad_qty' => $value2->bad_qty,
                            'accepted_qty' => $value2->accepted_qty,
                            'w_b_operator' => $value2->w_b_operator

                        );

                        //$result3=$this->select_db->check_bill_no($value2->bill_no);
                        $result3=$this->select_db->get_recieved_bills($value2->bill_no);
                        if (count($result3) <= 0) {
                            //print_r($data);
                            #Insert Data,,return last ID on success
                            $response = $this->insert_db->received_goods($db_group, $data);

                            if($response!=0){
                                $data = array( //T:Char N : Numeric
                                    'is_received' => 1
                                );
                                $response = $this->update_db->contract($db_group, $data,$value->id);
                            }
                            if ($response != 0) {
                                $data = array( //T:Char N : Numeric
                                    'is_cleared' => 1
                                );
                                $response = $this->update_db->weigh_bills($db_group, $data, $value2->id);
                            }
                        }else {
                            //$result['data']="";
                            $result['has_error']=false;
                            $result['code']=409;
                            $result['message']="Data Already Exist";
                        }
                    }

            }
        }


        #Commit Or rollback Transaction : Return Http MSG -> has_error ,,, code (500,201,400),,, message
        $result=$this->transactions_db->transaction_end($db_group,$response);

        #Uncomment to Override the response
        //$result['data']="";
        //$result['has_error']=false;
        //$result['code']=0;
        //$result['message']="";

        echo json_encode($result);#send $response as a JSON string

    }

}