<?php

/////////////////////
/// Created Date    : June 9, 2017
/// Author          : Mark Anthony M. Villaflor
/// Filename        : Sale.php
/// Description     :
///             It allows the application to add, get, and delete sale data.
/////////////////////

class Sale{
    private $_db,
            $_data;

    public function __construct(){
        $this->_db = DB::getInstance();
    }

    public function create($fields = array()){
        if(!$this->_db->insert('sale', $fields)){
            throw new Exception('There was a problem creating an sale');
        }
    }

    public function getSale($clientId = null){
        if ($clientId){
            $stringQuery = "SELECT sale.* FROM client JOIN category ON category.client_id = client.client_id JOIN good ON good.category_id = category.category_id JOIN sale ON sale.sale_id = good.sale_id WHERE client.client_id = ? GROUP BY sale.sale_id";
            $data = $this->_db->query($stringQuery, array(30));
            $this->_data = $data->results();
        }
    }

    public function getGoodWithSale($clientId = null){
        if ($clientId){
            $stringQuery = "SELECT good.*, sale.* FROM client JOIN category ON category.client_id = client.client_id JOIN good ON good.category_id = category.category_id JOIN sale ON sale.sale_id = good.sale_id WHERE client.client_id = ?";
            $data = $this->_db->query($stringQuery, array(30));
            $this->_data = $data->results();
        }
    }

    public function findSale($where = array()){
        $data = $this->_db->get('sale', $where);
        if($data->count()) {
            $this->_data = $data->first();

            return true;
        }
        return false;
    }

//    public function offSale(){
//        $this->_data = $this->_data->get('sale', null);
//    }

    public function exists(){
        return (!empty($this->_data)) ? true : false;
    }

    public function delete($id = null){
        if($id){
            $this->_db->delete('sale', array('sale_id', '=', $id));
        }
    }

    public function data(){
        return $this->_data;
    }
}