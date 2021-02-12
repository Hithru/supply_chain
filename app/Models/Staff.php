<?php

namespace App\Models;

use CodeIgniter\Model;

class Staff extends Model
{
    protected $DBGroup = 'root';
    protected $table = 'staff';
    protected $primaryKey = 'staff_id';

    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect('root');
    }


    public function getLoginInfo($array){

        $sql = "SELECT `staff_id`,`nic`,`password`,`position` FROM `staff` WHERE `nic`={$array['nic']};";
        $results = $this->db->query($sql)->getResult('array');
        return $results;
    }
}