<?php

namespace App\Controllers;

use App\Models\Management;

class managementc extends BaseController{

    public function view(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){

            $type = $_POST["type"];
            $year = $_POST["year"];
            $from = $_POST["from"];
            $to = $_POST["to"];


            if($type && $from && $to){
                $this->reports($type,$from,$to);
            }

            else {
                $this->reports($type,$year);
            }

        }

        else {
            echo view('mgmt/viewreport');
        }
    }

    public function reports($name,$arg1=null,$arg2=null){

        $model = new Management();

        switch($name){

            case "quarterlySales":
                $data1 = $model->getQuarterlySales($arg1);
                $report_name = "Quarterly Sales Report";
                $subtitle = "For the Year {$arg1}";
                break;

            case "customer":
                $data1 = $model->getOrders($arg1,$arg2);
                $report_name = "Customer-Order Report";
                $subtitle = "From {$arg1} to {$arg2}";
                break;
 
            case "sales":
                $data1 = $model->getSales($arg1);
                $report_name = "Full Sales Report by Routes and Cities";
                $subtitle = "For the Year {$arg1}";
                break;

            case "workinghrs":
                $data1 = $model->getTripInfo($arg1,$arg2);
                $report_name = "Customer-Order Report";
                $subtitle = "From {$arg1} to {$arg2}";
                break;

            case "topitems":
                $data1 = $model->getTopItems();
                $report_name = "Top Items";
                $subtitle = "Best Selling items of all time";
                break;

            default:
                break;

            }

        if (!$data1){
            $pop = ['report_name'=>$report_name, 'subtitle'=>'No records found '.$subtitle];
        }
        else{
        $pop = ['report_name'=>$report_name, 'subtitle'=>$subtitle,
        'headers'=>array_keys($data1[0]),
        'data'=>$data1];
        }

        echo view('mgmt/report',$pop);
    }



}