<?php

namespace App\Models;
use CodeIgniter\Database\Query;

class Management extends Staff{

    protected $DBGroup = 'root';
    protected $table = 'staff';
    protected $primaryKey = 'staff_id';

    protected $db;

    public function __construct()
    {
        parent::__construct();
        //$this->db = \Config\Database::connect('root');
    }

    public function getQuarterlySales($year){

        $prep = $this->db->prepare(function($db)
        {
            $sql = "SELECT count(*) as 'Number of Orders',sum(total_bill) as 'Total Revenue' FROM `orders` 
            where `order_date`>? and `order_date`<?;";

            return (new Query($db))->setQuery($sql);
        });

        $first = array("Quarter"=>"Q1 - January to March");
        $first = array_merge($first,$prep->execute("{$year}-01-01","{$year}-03-31")->getResultArray()[0]);
        
        $second = array("Quarter"=> "Q2 - April to June");
        $second = array_merge($second,$prep->execute("{$year}-04-01","{$year}-06-30")->getResultArray()[0]);

        $third = array("Quarter" => "Q3 - July to September");
        $third = array_merge($third,$prep->execute("{$year}-07-01","{$year}-09-30")->getResultArray()[0]);

        $fourth = array("Quarter" => "Q4 - October to December");
        $fourth = array_merge($fourth,$prep->execute("{$year}-10-01","{$year}-12-31")->getResultArray()[0]);

        $results = array($first, $second, $third, $fourth);

        foreach($results as &$row){
            if(!$row['Total Revenue']){
                $row['Total Revenue']='0.00';
            }
        }

        return($results);

    }

    public function getSales($year){

        $sql = "select name as 'City',route_id as 'Route No',
        count(order_id) as 'No. of Orders',sum(total_bill) as 'Total Revenue'
         from cityroutes left join `orders` using(route_id)
         where `order_date`>'{$year}-01-01' and `order_date`<'{$year}-12-31' group by(route_id);";

         $results = $this->db->query($sql)->getResultArray();

         foreach($results as &$row){
            if(!$row['Total Revenue']){
                $row['Total Revenue']='0.00';
            }
             if(!$row['No. of Orders']){
                $row['No. of Orders']='None';
            }
         }
 
         return($results);

        

    }

    public function getTopItems(){

        $sql = "SELECT name as 'Item Name', `count(order_id)` as 'Number of Orders' 
        from topitems;";

        $results = $this->db->query($sql)->getResultArray();


        return($results);

    }

    public function getOrders($from,$to){

        $sql = "SELECT name as 'Customer Name',type as 'Customer Type',
        count(order_id) as 'Number of Orders',sum(total_bill) as 'Total Amount Paid' 
        FROM customer INNER JOIN `order` 
        USING(`customer_id`) WHERE `order_date`>'{$from}' and `order_date`<'{$to}' GROUP BY `customer_id`;";

        $results = $this->db->query($sql)->getResultArray();

        foreach($results as &$row){
            if(!$row['Total Amount Paid']){
                $row['Total Amount Paid']='0.00';
            }
        }
        
        return($results);

    }

    public function getTripInfo($from,$to){

        $sql = "select count(*) from staff where position='driver';";
        $drivers = $this->db->query($sql)->getResultArray()[0]['count(*)'];

        $results = array(array('..'=>'No. of Drivers','Stats'=>$drivers));

        $sql = "select count(*) from staff where position='assistant';";
        $assists = $this->db->query($sql)->getResultArray()[0]['count(*)'];

        $sql = "select sum(max_time_mins)/60 as hrs from truck_schedule left join route using(route_id);;";
        $worked_hours = $this->db->query($sql)->getResultArray()[0]['hrs'];

        $results = array_merge($results,array(array('No.of Assistants',$assists)),
        array(array('Total Hours Spent on Transport',$worked_hours)));

        return($results);
    }



}