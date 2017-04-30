<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hawk
 * Date: 9/14/2016
 * Time: 6:47 PM
 */


class Insert_db extends CI_Model
{
    //Insert Category Data
    function categories($db_group,$values){
       // INSERT INTO `categories`(`id`, `category_name`, `is_disabled`, `is_removed`, `timestamp`, `created_user_id`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6])
        $table_name="categories";


        $columns = array( //T:Char N : Numeric
            //'id' => $values->id,
            'category_name' => 'T',
            'created_user_id' => 'N'
        );

        $data=$this->clean_data($values,$columns,false); //Clean Data and Build the save array::: True means multiple

        $db_group->insert($table_name, $data); //Insert into selected table

        if ($db_group->trans_status() === FALSE) {
            return 0;
        } else {
            return $db_group->insert_id();
        }

    }

    //Insert Contract Data
    function contract($db_group,$values){
        //INSERT INTO `contract`(`id`, `category_id`, `contract_no`, `supplier_id`, `created_date_time`, `expire_date_time`, `price`, `total_weight`, `total_qty`, `is_disabled`, `is_removed`, `timestamp`, `created_user_id`, `is_received`, `is_amend`, `is_payed`, `is_complete`, `payed_amount`, `sub_contract_id`, `sub_contract_no`, `report_number`, `cheque_no`, `invoice_number`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14],[value-15],[value-16],[value-17],[value-18],[value-19],[value-20],[value-21],[value-22],[value-23])

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
            'report_number' => 'N',
            'cheque_no' => 'T',
            'sub_contract_no'=>'T',
            'invoice_number' => 'T',
            'created_user_id' => 'N',
            'is_complete'=>'N'

        );

        $data=$this->clean_data($values,$columns,false); //Clean Data and Build the save array::: True means multiple

        $db_group->insert($table_name, $data); //Insert into selected table

        if ($db_group->trans_status() === FALSE) {
            return 0;
        } else {
            return $db_group->insert_id();
        }

    }

    //Insert people Data
    function people($db_group,$values){
        //INSERT INTO `people`(`id`, `code`, `first_name`, `middle_name`, `last_name`, `phone`, `email`, `web`, `street_1`, `street_2`, `city`, `province`, `postal_code`, `country`, `type`, `is_disabled`, `is_removed`, `timestamp`, `created_user_id`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14],[value-15],[value-16],[value-17],[value-18],[value-19])

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
            'type' => 'N'
        );

        $data=$this->clean_data($values,$columns,false); //Clean Data and Build the save array::: True means multiple

        $db_group->insert($table_name, $data); //Insert into selected table

        if ($db_group->trans_status() === FALSE) {
            return 0;
        } else {
            return $db_group->insert_id();
        }

    }

    //Insert received_goods Data
    function received_goods($db_group,$values){
        //INSERT INTO `received_goods`(`id`, `supplier_id`, `contract_no`, `contract_id`, `category_id`, `product`, `bill_no`, `bill_id`, `received_date_time`, `exit_date_time`, `truck_no`, `truck_driver`, `price`, `first_weight`, `second_weight`, `net_weight`, `wet_weight`, `total_qty`, `bad_qty`, `accepted_qty`, `w_b_operator`, `is_disabled`, `is_removed`, `timestamp`, `created_user_id`, `is_amend`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14],[value-15],[value-16],[value-17],[value-18],[value-19],[value-20],[value-21],[value-22],[value-23],[value-24],[value-25],[value-26])

        $table_name="received_goods";

        $columns = array( //T:Char N : Numeric
            //'id' => $values->id,
            'supplier_id' => 'N',
            'contract_no' => 'T',
            'contract_id' => 'N',
            'category_id' => 'N',
            'product' => 'N',
            'bill_no' => 'T',
            'bill_id' => 'N',
            'received_date_time' => 'D',
            'exit_date_time' => 'D',
            'truck_no' => 'T',
            'truck_driver' => 'T',
            'price' => 'N',
            'first_weight' => 'N',
            'second_weight' => 'N',
            'net_weight' => 'N',
            'wet_weight' => 'N',
            'total_qty' => 'N',
            'bad_qty' => 'N',
            'accepted_qty' => 'N',
            'w_b_operator' => 'T'
        );

        $data=$this->clean_data($values,$columns,false); //Clean Data and Build the save array::: True means multiple

        $db_group->insert($table_name, $data); //Insert into selected table

        if ($db_group->trans_status() === FALSE) {
            return 0;
        } else {
            return $db_group->insert_id();
        }

    }

    //Insert weigh_bills Data
    function weigh_bills($db_group,$values){
        //INSERT INTO `weigh_bills`(`id`, `product`, `supplier_name`, `supplier_code`, `bill_no`, `received_date_time`, `exit_date_time`, `truck_no`, `truck_driver`, `first_weight`, `second_weight`, `total_qty`, `bad_qty`, `accepted_qty`, `w_b_operator`, `is_disabled`, `is_removed`, `timestamp`, `created_user_id`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14],[value-15],[value-16],[value-17],[value-18],[value-19])

        $table_name="weigh_bills";

        $columns = array( //T:Char N : Numeric
            //'id' => $values->id,
            'product' => 'T',
            'supplier_name' => 'T',
            'supplier_code' => 'T',
            'bill_no' => 'N',
            'received_date_time' => 'D',
            'exit_date_time' => 'D',
            'truck_no' => 'T',
            'truck_driver' => 'T',
            'first_weight' => 'N',
            'second_weight' => 'N',
            'total_qty' => 'N',
            'bad_qty' => 'N',
            'accepted_qty' => 'N',
            'w_b_operator' => 'T'
        );

        $data=$this->clean_data($values,$columns,false); //Clean Data and Build the save array::: True means multiple

        $db_group->insert($table_name, $data); //Insert into selected table

        if ($db_group->trans_status() === FALSE) {
            return 0;
        } else {
            return $db_group->insert_id();
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
                if($value=='T') $data_clean[$key] = null;
                if($value=='N') $data_clean[$key] = 0;
                if($value=='D') $data_clean[$key] = 0;
            }
        }
        return $data_clean;
    }

}