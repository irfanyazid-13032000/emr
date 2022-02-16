<?php namespace App\Models;

class M_lap_ibu_hamil {

    protected $db;
    
    function __construct() {
        $this->db = \Config\Database::connect('sqlserver');
    }
    
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

