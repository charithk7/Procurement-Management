<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hawk
 * Date: 9/14/2016
 * Time: 7:50 PM
 */


class Transactions_db extends CI_Model
{

    //Start The DB Transaction
    function transaction_start($database) {
        #Start DB transaction,,,, Return DB Group
        $db_group = $this->load->database($database, TRUE); //Select Database 'default'
        $db_group->trans_start();

        return $db_group;
    }

    //End The DB Transaction
    function transaction_end($db_group,$response) {
    #Commit Or rollback Transaction : Return Http MSG -> has_error ,,, code,,, message
        $arr_response=[];



        $db_group->trans_complete();
        if ($db_group->trans_status() === FALSE) {
            $db_group->trans_rollback();
            $arr_response['has_error']=true;
            $arr_response['code']=500;
            $arr_response['message']="Save Failed";
        } else {
            $db_group->trans_commit();
            $arr_response['has_error']=false;
            $arr_response['code']=201;
            $arr_response['message']="Data Saved Successfully";
        }

        if($response==-1){
            $arr_response['has_error']=true;
            $arr_response['code']=204;
            $arr_response['message']="Invalid Data";
        }

        if($response==0){
            $arr_response['has_error']=false;
            $arr_response['code']=304;
            $arr_response['message']="Data Not Modified";
        }

        return $arr_response;

    }
}