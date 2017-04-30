<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hawk
 * Date: 9/14/2016
 * Time: 7:09 PM
 */


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Http_put extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('transactions_db');
        $this->load->model('update_db');

    }


    public function mark_payed()
    {
        $this->load->model('select_db');

        $request = file_get_contents("php://input"); // gets the raw data
        $params = json_decode($request, true); // true for return as array

        #Start DB transaction,,,, Return DB Group
        $db_group=$this->transactions_db->transaction_start('default');




        if( $params['boolien_id']!='is_complete') {
            $result = $this->select_db->contract_grid($params['data_id'], '');
            if (count($result) > 0) {
                foreach ($result as $data) {
                    $value = array( //T:Char N : Numeric
                        'is_disabled' => 0
                    );
                    $response = $this->update_db->people($db_group, $value, $data->supplier_id);
                }
            }
        }
       $data = array( //T:Char N : Numeric
            $params['boolien_id'] => 1
        );
        $response = $this->update_db->contract($db_group, $data,$params['data_id']);

        #Commit Or rollback Transaction : Return Http MSG -> has_error ,,, code (500,201,400),,, message
        $result=$this->transactions_db->transaction_end($db_group,$response);

        #Uncomment to Override the response
        //$result['data']="";
        //$result['has_error']=false;
        //$result['code']=0;
        //$result['message']="";

        echo json_encode($result);#send $response as a JSON string

    }

    public function payment_info()
    {
        $this->load->model('select_db');

        $request = file_get_contents("php://input"); // gets the raw data
        $params = json_decode($request, true); // true for return as array

        #Start DB transaction,,,, Return DB Group
        $db_group=$this->transactions_db->transaction_start('default');

        $params['boolien_id']='is_payed';


        if( $params['boolien_id']!='is_complete') {
            $result = $this->select_db->contract_grid($params['data_id'], '');
            if (count($result) > 0) {
                foreach ($result as $data) {
                    $value = array( //T:Char N : Numeric
                        'is_disabled' => 0
                    );
                    $response = $this->update_db->people($db_group, $value, $data->supplier_id);
                }
            }
        }
        $data = array( //T:Char N : Numeric
            $params['boolien_id'] => 1,
            'cheque_no'=>$params['cheque_number'],
            'invoice_number'=>$params['invoice_number']
        );
        $response = $this->update_db->contract($db_group, $data,$params['data_id']);

        #Commit Or rollback Transaction : Return Http MSG -> has_error ,,, code (500,201,400),,, message
        $result=$this->transactions_db->transaction_end($db_group,$response);

        #Uncomment to Override the response
        //$result['data']="";
        //$result['has_error']=false;
        //$result['code']=0;
        //$result['message']="";

        echo json_encode($result);#send $response as a JSON string

    }

    public function enable_suppliers(){
        $this->load->model('select_db');
        #Start DB transaction,,,, Return DB Group
        $response=0;
        $db_group=$this->transactions_db->transaction_start('default');
        $result=$this->select_db->contract_suppliers();
        $not_available_list=[];
        $counter=0;
        if (count($result) > 0) {
            foreach ($result as $data) {
                    if($data->is_complete==0){
                        $not_available_list[$counter++]=$data->supplier_id;
                    }

                    $is_update_data=false;
                    if(in_array($data->supplier_id, $not_available_list)) {
                        $is_update_data=false;
                    }else $is_update_data=true;

                    if (date('yyyy-mm-dd') > date('yyyy-mm-dd',strtotime($data->expire_date_time))) {
                        if ($is_update_data == true) {
                            $update = array( //T:Char N : Numeric
                                'is_disabled' => 0
                            );
                            $response = $this->update_db->people($db_group, $update, $data->supplier_id);
                        }
                    }
                }

        }
        //print_r($not_available_list);
        $result=$this->transactions_db->transaction_end($db_group,$response);
        echo json_encode($result);#send $response as a JSON string
    }

    public function mark_removed()
    {
        $this->load->model('select_db');

        $request = file_get_contents("php://input"); // gets the raw data
        $params = json_decode($request, true); // true for return as array

        #Start DB transaction,,,, Return DB Group
        $db_group=$this->transactions_db->transaction_start('default');


        $data = array( //T:Char N : Numeric
            $params['boolien_id'] => 1
        );
        $response = $this->update_db->people($db_group, $data,$params['data_id']);

        #Commit Or rollback Transaction : Return Http MSG -> has_error ,,, code (500,201,400),,, message
        $result=$this->transactions_db->transaction_end($db_group,$response);

        #Uncomment to Override the response
        //$result['data']="";
        //$result['has_error']=false;
        //$result['code']=0;
        //$result['message']="";

        echo json_encode($result);#send $response as a JSON string

    }

    public function edit_supplier()
    {
        $this->load->model('select_db');

        $request = file_get_contents("php://input"); // gets the raw data
        $params = json_decode($request, true); // true for return as array

        $value=$params['form_data'][0];
        //print_r($value);

        #Start DB transaction,,,, Return DB Group
        $db_group=$this->transactions_db->transaction_start('default');


        $data = array( //T:Char N : Numeric
            'code' => $value['supplier_code'],
            'first_name' => $value['supplier_name'],
            'phone' => $value['phone'],
            'account_number' => $value['supplier_account'],
            'street_1' => $value['street1'],
            'street_2' => $value['street2'],
            'city' => $value['supplier_city'],
            'province' => $value['province'],
            'postal_code' => $value['postal_code'],
            'type' => '1'
        );
        $response = $this->update_db->people($db_group, $data,$value['supplier_id']);

        #Commit Or rollback Transaction : Return Http MSG -> has_error ,,, code (500,201,400),,, message
        $result=$this->transactions_db->transaction_end($db_group,$response);

        #Uncomment to Override the response
        //$result['data']="";
        //$result['has_error']=false;
        //$result['code']=0;
        //$result['message']="";

        echo json_encode($result);#send $response as a JSON string

    }

    public function edit_contract()
    {
        $this->load->model('select_db');

        $request = file_get_contents("php://input"); // gets the raw data
        $params = json_decode($request, true); // true for return as array

        $value=$params['form_data'][0];
        //print_r($value);

        #Start DB transaction,,,, Return DB Group
        $db_group=$this->transactions_db->transaction_start('default');


        $data = array( //T:Char N : Numeric
            'price' => $value['kg_price'],
            'total_weight' => $value['total_weight'],
            'expire_date_time' => date('Y-m-d',strtotime($value['expire_date'])),
            'total_qty' => $value['total_units']
        );
        $response = $this->update_db->contract($db_group, $data,$value['modify_id']);

        #Commit Or rollback Transaction : Return Http MSG -> has_error ,,, code (500,201,400),,, message
        $result=$this->transactions_db->transaction_end($db_group,$response);

        #Uncomment to Override the response
        //$result['data']="";
        //$result['has_error']=false;
        //$result['code']=0;
        //$result['message']="";

        echo json_encode($result);#send $response as a JSON string

    }

    public function edit_bill_data()
    {

        $request = file_get_contents("php://input"); // gets the raw data
        $params = json_decode($request, true); // true for return as array

        $value=$params['form_data'][0];
        //print_r($value);

        #Start DB transaction,,,, Return DB Group
        $db_group=$this->transactions_db->transaction_start('default');


        $data = array( //T:Char N : Numeric
            'first_weight' => $value['first_weight'],
            'second_weight' => $value['second_weight'],
            'price' => $value['price'],
            'total_qty' => $value['total_qty'],
            'bad_qty' => $value['bad_qty']
        );
        $response = $this->update_db->received_goods($db_group, $data,$value['data_id']);

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