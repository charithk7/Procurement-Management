<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hawk
 * Date: 9/14/2016
 * Time: 6:47 PM
 */


class Update_db extends CI_Model
{



    //Update Contract Data
    function contract($db_group,$values,$id){
        //UPDATE `contract` SET `id`=[value-1],`category_id`=[value-2],`contract_no`=[value-3],`supplier_id`=[value-4],`created_date_time`=[value-5],`expire_date_time`=[value-6],`price`=[value-7],`total_weight`=[value-8],`total_qty`=[value-9],`is_disabled`=[value-10],`is_removed`=[value-11],`timestamp`=[value-12],`created_user_id`=[value-13],`is_received`=[value-14],`is_amend`=[value-15],`is_payed`=[value-16] WHERE 1

        $table_name="contract";

        $columns = array( //T:Char N : Numeric
            //'id' => $values->id,
            'category_id' => 'N',
            'contract_no' => 'T',
            'supplier_id' => 'N',
            'created_date_time' => 'D',
            'expire_date_time' => 'D',
            'price' => 'N',
            'total_weight' => 'N',
            'total_qty' => 'N',
            'created_user_id' => 'N',

            'is_disabled' => 'N',
            'is_removed' => 'N',
            'is_received' => 'N',
            'is_complete' => 'N',
            'is_amend' => 'N',
            'is_payed' => 'N',
            'sub_contract_id' => 'N',
            'sub_contract_no' => 'T',
            'cheque_no' => 'T',
            'invoice_number' => 'T'

        );

        $data=$this->clean_data($values,$columns,false); //Clean Data and Build the save array::: True means multiple

        //$db_group->insert($table_name, $data); //Insert into selected table

        $db_group->where('id', $id);
        $db_group->update($table_name, $data);

        if ($db_group->trans_status() === FALSE) {
            return 0;
        } else {
            return 1;
        }

    }

    //Update Contract Data
    function people($db_group,$values,$id){
        //UPDATE `contract` SET `id`=[value-1],`category_id`=[value-2],`contract_no`=[value-3],`supplier_id`=[value-4],`created_date_time`=[value-5],`expire_date_time`=[value-6],`price`=[value-7],`total_weight`=[value-8],`total_qty`=[value-9],`is_disabled`=[value-10],`is_removed`=[value-11],`timestamp`=[value-12],`created_user_id`=[value-13],`is_received`=[value-14],`is_amend`=[value-15],`is_payed`=[value-16] WHERE 1


        $table_name="people";

        $columns = array( //T:Char N : Numeric
            //'id' => $values->id,
            'code' => 'T',
            'first_name' => 'T',
            'middle_name' => 'T',
            'last_name' => 'T',
            'phone' => 'T',
            'email' => 'T',
            'web' => 'T',
            'street_1' => 'T',
            'street_2' => 'T',
            'city' => 'T',
            'province' => 'T',
            'postal_code' => 'T',
            'country' => 'T',
            'account_number'=>'N',
            'type' => 'N',

            'is_disabled' => 'N',
            'is_removed' => 'N'
        );

        //Disabled Due to a null value bug
        //$data=$this->clean_data($values,$columns,false); //Clean Data and Build the save array::: True means multiple

        $db_group->where('id', $id);
        $db_group->update($table_name, $values);

        if ($db_group->trans_status() === FALSE) {
            return 0;
        } else {
            return 1;
        }

    }


    //Update Contract Data
    function weigh_bills($db_group,$values,$id){
        //UPDATE `weigh_bills` SET `id`=[value-1],`product`=[value-2],`bill_no`=[value-3],`received_date_time`=[value-4],`exit_date_time`=[value-5],`truck_no`=[value-6],`truck_driver`=[value-7],`first_weight`=[value-8],`second_weight`=[value-9],`total_qty`=[value-10],`bad_qty`=[value-11],`accepted_qty`=[value-12],`w_b_operator`=[value-13],`is_disabled`=[value-14],`is_removed`=[value-15],`timestamp`=[value-16],`created_user_id`=[value-17],`is_cleared`=[value-18],`supplier_name`=[value-19],`supplier_code`=[value-20] WHERE 1

        $table_name="weigh_bills";

        $columns = array( //T:Char N : Numeric
            //'id' => $values->id,
            'product' => 'T',
            'bill_no' => 'T',
            'received_date_time' => 'D',
            'exit_date_time' => 'D',
            'truck_no' => 'T',
            'truck_driver' => 'T',
            'first_weight' => 'N',
            'second_weight' => 'N',
            'total_qty' => 'N',
            'bad_qty' => 'N',
            'accepted_qty' => 'T',
            'w_b_operator' => 'T',
            'is_disabled' => 'N',
            'is_removed'=>'N',
            'is_cleared' => 'N',

            'is_disabled' => 'N',
            'is_removed' => 'N'
        );

        //Disabled Due to a null value bug
        //$data=$this->clean_data($values,$columns,false); //Clean Data and Build the save array::: True means multiple

        $db_group->where('id', $id);
        $db_group->update($table_name, $values);

        if ($db_group->trans_status() === FALSE) {
            return 0;
        } else {
            return 1;
        }

    }

    //Update received_goods Data
    function received_goods($db_group,$values,$id){
        //UPDATE `weigh_bills` SET `id`=[value-1],`product`=[value-2],`bill_no`=[value-3],`received_date_time`=[value-4],`exit_date_time`=[value-5],`truck_no`=[value-6],`truck_driver`=[value-7],`first_weight`=[value-8],`second_weight`=[value-9],`total_qty`=[value-10],`bad_qty`=[value-11],`accepted_qty`=[value-12],`w_b_operator`=[value-13],`is_disabled`=[value-14],`is_removed`=[value-15],`timestamp`=[value-16],`created_user_id`=[value-17],`is_cleared`=[value-18],`supplier_name`=[value-19],`supplier_code`=[value-20] WHERE 1

        $table_name="received_goods";

        $columns = array( //T:Char N : Numeric
            //'id' => $values->id,
            'product' => 'T',
            'bill_no' => 'T',
            'received_date_time' => 'D',
            'exit_date_time' => 'D',
            'truck_no' => 'T',
            'truck_driver' => 'T',
            'first_weight' => 'N',
            'second_weight' => 'N',
            'total_qty' => 'N',
            'bad_qty' => 'N',
            'price' => 'N',
            'accepted_qty' => 'T',
            'w_b_operator' => 'T',
            'is_disabled' => 'N',
            'is_removed'=>'N',
            'is_cleared' => 'N',

            'is_disabled' => 'N',
            'is_removed' => 'N'
        );

        //Disabled Due to a null value bug
        //$data=$this->clean_data($values,$columns,false); //Clean Data and Build the save array::: True means multiple

        $db_group->where('id', $id);
        $db_group->update($table_name, $values);

        if ($db_group->trans_status() === FALSE) {
            return 0;
        } else {
            return 1;
        }

    }

    private function clean_data($values, $columns,$is_multiple){ //T:Char N : Numeric , D: Date
        $data_clean=[];

        foreach($columns as $key => $value) {
            if (isset($values[$key]) && $values[$key] != "") {
                if ($value == 'T') $data_clean[$key] = trim($values[$key]);
                if ($value == 'N') $data_clean[$key] = $values[$key];
                if ($value == 'D') $data_clean[$key] = $values[$key];
            }
            else {
                if(isset($values[$key])) {
                    unset($values[$key]);
                }
                /*if($value=='T') $data_clean[$key] = null;
                if($value=='N') $data_clean[$key] = 0;
                if($value=='D') $data_clean[$key] = 0;*/
            }
        }
        return $data_clean;
    }


}