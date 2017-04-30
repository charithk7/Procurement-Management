<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//http://stackoverflow.com/questions/419900/remember-me-login-in-codeigniter Refer This link to create secure session with remember function
class Verify_login extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        //This method will have the credentials validation
        $this->load->library('form_validation');

        //$this->form_validation->set_rules('company_code', 'Company Code', 'trim|required|xss_clean');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

        if ($this->form_validation->run() == FALSE) {
            //Field validation failed.  User redirected to login page
            $data['image_name'] = '1.jpg';
            $data['system_name'] = 'BIZi';

            $company_code=$this->input->get('company');
            if(isset($company_code) && $company_code!=""){
                $data['company_code']=$company_code;
            }
            else $data['company_code']="not_set";

            $this->load->view('login/login_view', $data);
        } else {
            //Go to private area
            redirect('/', 'refresh');
        }
    }

    function check_database($password) {

        $payed_for_system=true; //Change This When payed
        $licenced_system=false;

        if(date('Y-m-d')<date('Y-m-d',strtotime('2016-12-31')) || $payed_for_system==true){
            $licenced_system=true;
        }

        if($licenced_system==true) {
            //Field validation succeeded.  Validate against database
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $direct_login = $this->input->post('direct_login');

            if ($direct_login == "enabled") $direct_login = true;
            else $direct_login = false;

            //query the database
            //$result = $this->Check_login->login($username, $company_code, $password);


            # Check whether the new generated password matches the old one
            if (($username === "user" && $password === "cbl@user") ||
                ($username === "admin" && $password === "system@admin") ||
                ($username === "finance_user" && $password === "cbl@finance") ||
                ($username === "finance_admin" && $password === "finance@admin")
            ) {
                # Log in the user ...
                $remember_me = FALSE;
                if ($this->input->post('remember_me')) {
                    $remember_me = TRUE;
                }

                $version = "1.4.2";
                if ($username === "user") {

                    $sess_array = array(
                        //'user_id' => $row->user_id,
                        'username' => 'user',
                        'first_name' => "CBL",
                        'last_name' => "User",
                        'logon_date' => date("Y/m/d"),
                        'remember_sess' => $remember_me,
                        'is_admin' => false,
                        'user_role' => 'user',
                        'version' => $version

                    );

                }

                if ($username === "admin") {

                    $sess_array = array(
                        //'user_id' => $row->user_id,
                        'username' => 'admin',
                        'first_name' => "System",
                        'last_name' => "Admin",
                        'logon_date' => date("Y/m/d"),
                        'remember_sess' => $remember_me,
                        'is_admin' => true,
                        'user_role' => 'admin',
                        'version' => $version
                    );

                }

                if ($username === "finance_user") {

                    $sess_array = array(
                        //'user_id' => $row->user_id,
                        'username' => 'finance_user',
                        'first_name' => "Finance",
                        'last_name' => "User",
                        'logon_date' => date("Y/m/d"),
                        'remember_sess' => $remember_me,
                        'is_admin' => false,
                        'user_role' => 'finance_user',
                        'version' => $version
                    );

                }

                if ($username === "finance_admin") {

                    $sess_array = array(
                        //'user_id' => $row->user_id,
                        'username' => 'finance_admin',
                        'first_name' => "Finance",
                        'last_name' => "Admin",
                        'logon_date' => date("Y/m/d"),
                        'remember_sess' => $remember_me,
                        'is_admin' => true,
                        'user_role' => 'finance_admin',
                        'version' => $version
                    );

                }

                $this->session->set_userdata('logged_in', $sess_array);


                return TRUE;
            } else {
                # Show an error...
                $this->form_validation->set_message('check_database', 'Invalid Credentials');
                return false;
            }
        }else{
            # Show an error...
            $this->form_validation->set_message('check_database', 'Free trial has expired!');
            return false;
        }
    }

    function check_session() {
        #Check If the user is logged in
        $is_logged_in = $this->session->userdata('logged_in');
        if ($is_logged_in == true) {
            #Go to Private Dashboard
            echo 1;
        } else {
            #Go to login page if not logged in
            echo 0;
        }
    }

}

?>