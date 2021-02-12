<?php

namespace App\Controllers;

use App\Models\Staff;

class StaffController extends BaseController
{
	public function home()
	{
        session_start();

        if (!isset($_SESSION['id'])){
            //not logged in
            $this->login();

        } else {
            $id = $_SESSION['id'];
            $type = $_SESSION['type'];
            
            //echo "MMMMMM";
            echo view('home');
        }

    }
    
    public function login(){

        $model = new Staff();

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            //$model ->login($_POST);
            $info = $model->getLoginInfo($_POST);

            //print_r($info);

            if (count($info)>0){
                if (password_verify($_POST['password'],$info[0]['password'])){
                    echo "yes";
                    //set session and redirect
                    session_start();
                    $_SESSION['id'] = $info[0]['staff_id'];
                    $_SESSION['type'] = $info[0]['position'];
                    

                    echo view('home');
                }
                else {
                    echo "wrong password";
                }
            }
            
        }

        else{
            echo view('stafflogin');
        }

    }

    public function logout(){
        session_start();
        unset($_SESSION['id']);
        unset($_SESSION['type']);
        session_destroy();
        $this->login();
    }
}