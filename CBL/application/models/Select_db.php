<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hawk
 * Date: 9/14/2016
 * Time: 6:47 PM
 */


class Select_db extends CI_Model
{


    //Select Current inactive suppliers
    function categories(){

        $query="SELECT * FROM `categories` WHERE `is_removed`=0";

        return $this->Select_sql('default', $query);

    }



    //Custom Select Data=========================

    //Select contract_grid Data
    function contract_grid($where_id,$date_filter){
        $where="";
        if(isset($where_id) && $where_id!="*"){
            $where="AND `contract`.`id`=".$where_id;
        }

        $data_filter_sql="";
        $time_between="";
        if(isset($date_filter)&& $date_filter!=""){
            if($date_filter['filter']=='Active'){
                $data_filter_sql="AND `contract`.`is_payed`=0";
            }
            if($date_filter['filter']=='Completed'){
                $data_filter_sql="AND `contract`.`is_payed`=1";
            }
            if($date_filter['filter']=='To Be Payed'){
                $data_filter_sql="AND `contract`.`is_payed`=0 AND `contract`.`is_complete`=1 AND `contract`.`is_received`=1 AND date(`contract`.`expire_date_time`) < NOW()";
            }



            if ($date_filter['start_date'] == null && $date_filter['end_date'] == null) {
                $time_between = "";
            } else {
                $time_between = " AND date(`contract`.`timestamp`) >='" . $date_filter['start_date'] . "' AND date(`contract`.`timestamp`) <='" . $date_filter['end_date'] . "'";
            }

        }


        $query="
        SELECT
        `people`.`first_name`,
        `people`.`code`,
        `categories`.`category_name`,
        `people`.`id` AS `supplier_id`,
        `contract`.*
        FROM `contract`,`people`,`categories`
        WHERE `contract`.`supplier_id`=`people`.`id`
        AND `contract`.`category_id`=`categories`.`id`
        AND `contract`.`is_removed`=0

        ".$where."
        ".$data_filter_sql."
        ".$time_between."

        ORDER BY `contract`.`timestamp` DESC
        ";

        return $this->Select_sql('default', $query);

    }

    //Select suppliers_grid Data
    function suppliers_grid($where_id){
        $where="";
        if(isset($where_id) && $where_id!="*"){
            $where="AND `people`.`id`=".$where_id;
        }

        $query="
        SELECT
        *
        FROM `people`
        WHERE `people`.`type`=1
        AND `people`.`is_removed`=0
        ".$where."
        ORDER BY `people`.`first_name` ASC
        ";

        return $this->Select_sql('default', $query);

    }

    //Select suppliers_grid Data
    function weigh_bridge($where_id,$date_filter){
        $where="";
        if(isset($where_id) && $where_id!="*"){
            $where="AND `id`=".$where_id;
        }

        $time_between = "";
        $custom_filter='';
        if(isset($date_filter)&& $date_filter!=""){

            if ($date_filter['start_date'] == null && $date_filter['end_date'] == null) {
                $time_between = "";
            } else {
                $time_between = " AND date(`timestamp`) >='" . $date_filter['start_date'] . "' AND date(`timestamp`) <='" . $date_filter['end_date'] . "'";
            }

            if($date_filter['filter']=='Not Cleared'){
                $custom_filter=' AND `is_cleared`=0';
                $time_between='';
            }
            if($date_filter['filter']=='Cleared'){
                $custom_filter=' AND `is_cleared`=1';
            }
        }

        $query="
        SELECT * FROM `weigh_bills`
        WHERE (`product` LIKE 'Coconut' OR `product` LIKE 'Firewood-Purchase')
        ".$where." ".$custom_filter."
        ".$time_between."
        ORDER BY `timestamp` DESC
        ";

        return $this->Select_sql('default', $query);

    }

//Select Current inactive suppliers
    function contract_suppliers(){


        $query="SELECT `people`.`first_name`, `people`.`id` AS `supplier_id`,
                `people`.`is_disabled` AS `supplier_disabled`,
                `contract`.*
                FROM `people`,`contract`
                WHERE `contract`.`supplier_id`=`people`.`id`
                AND `contract`.`is_removed`=0
                AND `contract`.`is_payed`=0
                AND `people`.`is_disabled`=1
                ORDER BY `contract`.`timestamp` DESC
        ";

        return $this->Select_sql('default', $query);

    }

    //Select suppliers_grid Data
    function suppliers_active($active){
        $filter="";
        if($active==true){
            $filter="AND `people`.`is_disabled`=0";
        }else{
            $filter="AND `people`.`is_disabled`=1";
        }

        $query="
        SELECT
        *
        FROM `people`
        WHERE `people`.`type`=1
         AND `people`.`is_removed`=0
        ".$filter."
        ORDER BY `people`.`first_name` ASC
        ";

        return $this->Select_sql('default', $query);

    }

    //Select note_grn_grid Data
    public function note_grn_grid($where_id,$date_filter) {
        $where="";
        if(isset($where_id) && $where_id!="*"){
            $where="AND `contract`.`id`=".$where_id;
        }

        $time_between = "";
        if(isset($date_filter)&& $date_filter!=""){

            if ($date_filter['start_date'] == null && $date_filter['end_date'] == null) {
                $time_between = "";
            } else {
                $time_between = " AND date(`received_goods`.`timestamp`) >='" . $date_filter['start_date'] . "' AND date(`received_goods`.`timestamp`) <='" . $date_filter['end_date'] . "'";
            }
        }

        $query="
        SELECT
        `received_goods`.*,
        `contract`.`contract_no`,
        `categories`.`category_name`,
        `people`.`first_name`,
        `people`.`code`
        FROM `received_goods`,`people`,`contract`,`categories`
        WHERE `received_goods`.`supplier_id`=`people`.`id`
        AND `received_goods`.`category_id`=`categories`.`id`
        AND `received_goods`.`contract_id`=`contract`.`id`
        ".$where."
        ".$time_between."

        ORDER BY `contract`.`timestamp` DESC
        ";

        return $this->Select_sql('default', $query);
    }


    //Select note_grn_grid Data
    public function note_grn_info($where_id) {
        $where="";
        if(isset($where_id) && $where_id!="*"){
            $where="AND `received_goods`.`id`=".$where_id;
        }

        $query="
        SELECT
        `received_goods`.*,
        `contract`.`contract_no`,
        `categories`.`category_name`,
        `people`.`first_name`,
        `people`.`code`
        FROM `received_goods`,`people`,`contract`,`categories`
        WHERE `received_goods`.`supplier_id`=`people`.`id`
        AND `received_goods`.`category_id`=`categories`.`id`
        AND `received_goods`.`contract_id`=`contract`.`id`
        ".$where."


        ";

        return $this->Select_sql('default', $query);
    }

    //Select note_grn_grid Data
    public function check_bill_no($where_id) {
        $where="";
        if(isset($where_id) && $where_id!="*"){
            $where="AND `received_goods`.`bill_no`=".$where_id;
        }

        $query="
        SELECT
        `received_goods`.*,
        `contract`.`contract_no`,
        `people`.`first_name`,
        `people`.`code`
        FROM `received_goods`,`people`,`contract`
        WHERE `received_goods`.`supplier_id`=`people`.`id`
        AND `received_goods`.`contract_id`=`contract`.`id`
        ".$where."

        AND contract.is_disabled = 0
        AND contract.is_removed = 0
        AND contract.is_complete = 0
        AND contract.is_amend = 0
        AND contract.is_payed = 0

        ORDER BY `contract`.`timestamp` DESC
        ";

        return $this->Select_sql('default', $query);
    }

    //Select weigh_bills_data for data Sync
    public function weigh_bills_sync($db_group,$supplier_code,$category_id,$last_bill,$created_date_time,$expire_date_time) {

        $sql="
        SELECT
        `weigh_bills`.*,
        `people`.`id` AS `supplier_id`,
        `categories`.`id` AS `category_id`,
        `categories`.`category_name` AS `category_name`
        FROM `weigh_bills`,`people`,`categories`
        WHERE `weigh_bills`.`supplier_code`=`people`.`code`
        AND `weigh_bills`.`product`=`categories`.`category_name`
        AND `weigh_bills`.`supplier_code`='".$supplier_code."'
        AND `categories`.`id`=".$category_id."
        AND `weigh_bills`.`bill_no`>".$last_bill."
        AND date(`weigh_bills`.`exit_date_time`)<='".date('Y-m-d',strtotime($expire_date_time))."'
        AND date(`weigh_bills`.`exit_date_time`)>='".date('Y-m-d',strtotime($created_date_time))."'
        AND `weigh_bills`.`is_cleared`=0
        AND `weigh_bills`.`is_removed`=0
        AND `people`.`is_removed`=0
        ";

        $query = $db_group->query($sql); //table name
        return $query->result();

    }

    //Select in-expired Contracts_data for data Sync
    public function valid_contracts_sync($db_group) {
        $sql="
        SELECT
        `contract`.`contract_no`,
        `contract`.`category_id`,
        `contract`.`id`,
        `contract`.`price`,
        `people`.`code`,
        `contract`.`created_date_time`,
        `contract`.`expire_date_time`
        FROM `contract` ,`people`
        WHERE date(`contract`.`expire_date_time`)>= date(NOW())
        AND date(`contract`.`created_date_time`)<= date(NOW())
        AND `contract`.`supplier_id`=`people`.`id`
        AND `people`.`is_removed`=0
         AND contract.is_disabled = 0
         AND contract.is_removed = 0
         AND contract.is_complete = 0
         AND contract.is_amend = 0
         AND contract.is_payed = 0
        ";

        $query = $db_group->query($sql); //table name
        return $query->result();
    }

    //Select max bill no for Sync
    public function last_bill_no($db_group) {
        $sql="
        SELECT MAX(`bill_no`) as max_no FROM `received_goods`;
        ";

        $query = $db_group->query($sql); //table name
        return $query->result();
    }

    //Select last Contract id to create contract no
    public function number_of_contracts($db_group,$category_id) {
        /*$sql="
        SELECT
        COUNT(`id`) as max_no
        FROM `contract`
        ";*/

        $sql="SELECT DISTINCT `contract_no` FROM contract WHERE sub_contract_no ='0' AND category_id=".$category_id." ";

        $query = $db_group->query($sql); //table name
        $result0=$query->result();

        $count=0;
        foreach ($result0 as $value0) {
            $count++;
        }

        return $count;
    }

    //Select max bill no for Sync
    public function contract_numbers_exist($db_group,$contract_no) {
        $sql="SELECT DISTINCT `contract_no` FROM contract WHERE `contract_no`='".$contract_no."'";
        $query = $db_group->query($sql); //table name
        $result=$query->result();

        if(count($result) == 0) return false;
        else return true;

    }

    //Select last Contract id to create contract no
    public function last_report_id($db_group) {
        $sql="
        SELECT
        MAX(`report_number`) as report_number
        FROM `contract`
        ";

        $query = $db_group->query($sql); //table name
        return $query->result();
    }

  //select contract details and bill numbers
    public function contact_details($supplier_code) {


        $sql="  SELECT contract.supplier_id, contract.*,
                people.first_name,
                people.code,
                categories.category_name

                FROM people,contract,categories

                WHERE people.`id` = contract.`supplier_id`
                AND contract.`category_id`=categories.`id`
                AND  people.id = '".$supplier_code."' AND contract.is_disabled = '0' AND contract.is_complete = '0'
        ";

        return $this->Select_sql('default', $sql); //table name


    }

    public function get_bill_no($supplier_name,$start_date,$end_date) {
//date("Y-m-d h:i:sa",strtotime($start_date))
        $where="";
        if(isset($supplier_name) && $supplier_name!="*"){
            $where="AND `people`.`id`=".$supplier_name;
        }

        $sql="SELECT
weigh_bills.bill_no,
weigh_bills.id
FROM
weigh_bills
WHERE date(exit_date_time) >= '".date("Y-m-d",strtotime($start_date))."'
AND date(exit_date_time) <= '".date("Y-m-d",strtotime($end_date))."'
AND `weigh_bills`.`is_cleared`=0
AND `weigh_bills`.`is_disabled`=0
AND (`weigh_bills`.`product` LIKE 'Coconut' OR `weigh_bills`.`product` LIKE 'Firewood-Purchase')
".$where."
";

        return $this->Select_sql('default', $sql); //table name


    }

    public  function  get_bill_details($bill_id){

        $sql="SELECT * FROM `weigh_bills` WHERE `id`= ".$bill_id;

        return $this->Select_sql('default', $sql); //table name
    }

    public  function  get_recieved_bills($bill_no){

        $sql="SELECT * FROM `received_goods` WHERE `bill_no`= ".$bill_no;

        return $this->Select_sql('default', $sql); //table name
    }

    //select contract details and bill numbers
    public function contact_details_contract_no($contract_no) {


        $sql="  SELECT contract.supplier_id, contract.*,
                people.first_name,
                people.code,
                categories.category_name

                FROM people,contract,categories

                WHERE people.`id` = contract.`supplier_id`
                AND contract.`category_id`=categories.`id`
                AND  contract.contract_no = '".$contract_no."' AND contract.is_disabled = '0' 
                AND contract.is_removed = '0'
                AND contract.is_disabled = '0'
                AND contract.is_amend = '0'
        ";

        return $this->Select_sql('default', $sql); //table name


    }

    //select contract details and bill numbers
    public function received_goods_months($contract_id) {


        $sql=" SELECT 

DATE_FORMAT(`exit_date_time`, '%Y-%m-01') AS date_start,
DATE_FORMAT(`exit_date_time`, '%M') AS month_name

FROM received_goods 
WHERE `contract_id`=".$contract_id."
GROUP BY date_start
        ";

        return $this->Select_sql('default', $sql); //table name


    }


    //Private Functions
    private function Select_sql($database_name, $sql) {
        $db_group = $this->load->database($database_name, TRUE); //Select Database
        $query = $db_group->query($sql); //table name
        return $query->result();
    }

}