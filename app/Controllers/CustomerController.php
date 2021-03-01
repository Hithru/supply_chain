<?php


namespace App\Controllers;

use App\Models\Customer;
use Psr\Log\NullLogger;

class CustomerController extends BaseController
{


    public function __construct()
    {
        $session = \Config\Services::session($config);
    }
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

        $model = new Customer();
        $data['routeDetails'] = $model->getRouteDetalails();
        $session = \Config\Services::session($config);
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            //$model ->login($_POST);
            $info = $model->getLoginInfo($_POST);



            if (count($info)>0){
                if (password_verify($_POST['password'],$info[0]['password'])){

                    //set session and redirect
                    session_start();
                    $_SESSION['id'] = $info[0]['customer_id'];
                    $_SESSION['type'] = $info[0]['type'];
                    $newdata = [
                        'customer_id'  => $info[0]['customer_id'],
                        'type'     => $info[0]['type'],
                        'route_id'     => $info[0]['route_id'],
                        'billing_address'     => $info[0]['billing_address']
                    ];

                    $session->set($newdata);



                    $this->viewHome();
                }
                else {
                    echo "wrong password";
                }
            }else{
                echo view('customer/LoginRegistration',$data);
            }

        }

        else{
            echo view('customer/LoginRegistration',$data);
        }

    }

    public function register(){
        $model = new Customer();

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'address' => trim($_POST['address']),
                'route' => trim($_POST['route']),
                'type' => trim($_POST['type']),
                'tel_no' => trim($_POST['tel_no'])
            ];
            // Hash password
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);


            // Register user
            if($model->register($data)) {
                $this->login();
            } else {
                die('Something went wrong');
            }

    }
    }

    public function buyProduct() {
        $session = \Config\Services::session($config);
        $model = new Customer();

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $qty = (int)trim($_POST['qty']);

            if ($qty ){

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $total = (int)trim($_POST['qty']) * (float)trim($_POST['price']);
            $remaining_stock = (int)trim($_POST['stock']) -(int)trim($_POST['qty']) ;
            $data = [
                'customer_id' => $session->get('customer_id'),//Session
                'order_date' => date("Y-m-d"),
                'ship_date' => Null,
                'route_id' => $session->get('type'),
                'status' => "Open",
                'shipping_address' => $session->get('billing_address'),
                'item_id'=>trim($_POST['item_id']),
                'qty' =>trim($_POST['qty']),
                'total_price'=>$total,
                'remainig_stock'=>$remaining_stock

            ];

            if($model->Buy($data)) {
                $this->viewOrders();
            } else {
                die('Something went wrong');
            }

            }else{
                $this->viewProducts();
            }

        }
    }

    public function cancelOrder() {
        $session = \Config\Services::session($config);
        $model = new Customer();

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $data = ['order_id'=>$_POST['order_id']];

            if($model->cancelOrder($data)) {
                print_r("Success");
                //$this->viewOrders();
            } else {
                die('Something went wrong');
            }


        }
    }

    public function viewProducts($data=[]) {
        $session = \Config\Services::session($config);
        $model = new Customer();


        $data['productDetails'] = $model->getProductDetalails();
        $customer_type = $session->get('type');
        //$data['customerDetails'] = $model->getCustomerDetails($customer_type);


        echo view('customer/viewProducts', $data);
    }
    public function viewOrders() {
        $session = \Config\Services::session($config);


        $model = new Customer();
        $user_id = $session->get('customer_id');

        $data['orderDetails'] = $model->getUserOrderDetalails($user_id);
        //print_r($user_id);

        echo view('customer/viewOrders', $data);
    }
    public function viewContact($data=[]) {
        echo view('customer/ContactUs', $data);
    }


    public function viewHome($data=[]) {
        echo view('customer/index', $data);
    }

    public function logout(){
        session_start();
        unset($_SESSION['id']);
        unset($_SESSION['type']);

        session_destroy();
        session_start();
        $this->login();

    }


}