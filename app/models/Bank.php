<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Bank {

    private $_id;
    private $_nama;
    private $_keterangan;
    private $_db;
    public $_registry;
    private $_table = 'r_bank';

    /*
     * Konstruktor
     */

    public function __construct($registry) {
        $this->_registry = $registry;
        $this->_db = new Database();
    }

    /*
     * method untuk mendapatkan semua objek bank
     */

    public function get_bank() {
        $sql = "SELECT * FROM " . $this->_table . "";
        $result = $this->_db->select($sql);
        $data = array();
        foreach ($result as $value) {
            $bank = new Bank($this->_registry);
            $bank->set_id($value['KD_BANK']);
            $bank->set_nama($value['NM_BANK']);
            $bank->set_keterangan($value['KET_BANK']);
            $data [] = $bank;
        }
        return $data;
    }

    /*
     * method untuk mendapatkan semua objek bank dengan parameter id_bank
     */

    public function get_bank_id($KD_BANK) {
        $sql = "SELECT * FROM " . $this->_table . " WHERE KD_BANK = " . $KD_BANK . " ";
        $result = $this->_db->select($sql);
//        var_dump($result);
        $data = array();
        foreach ($result as $value) {
            $bank = new Bank($registry);
            $bank->set_id($value['KD_BANK']);
            $bank->set_nama($value['NM_BANK']);
            $bank->set_keterangan($value['KET_BANK']);
            $data = $bank;
        }
        return $data;
    }

    /*
     * method untuk mendapatkan jumlah bank yang tersimpan didatabase dengan parameter nama_bank
     */

    public function get_bank_name($nama) {
        $sql = "SELECT * FROM " . $this->_table . " WHERE NM_BANK = '" . $nama . "'";
        $result = $this->_db->select($sql);
        $hasil = count($result);
//        var_dump($result);
        return $hasil;
    }

    /*
     * method untuk menambahkan bank dalam database
     */

    public function addBank(Bank $bank) {
        if ($bank->get_bank_name($bank->get_nama()) == 1) {
            echo 'data telah ada di dalam database';
        } else {
            $data = array(
                'NM_BANK' => $bank->get_nama(),
                'KET_BANK' => $bank->get_keterangan()
            );
////       var_dump($data);    
            $this->_db->insert($this->_table, $data);
        }
    }

    /*
     * method untuk merubah bank dalam database
     */

    public function updateBank(Bank $bank) {
        $where = 'KD_BANK =' . $bank->get_id();
        $data = array(
            'NM_BANK' => $bank->get_nama(),
            'KET_BANK' => $bank->get_keterangan()
        );
        $this->_db->update($this->_table, $data, $where);
    }

    /*
     * method untuk merubah keterangan bank dalam database
     */

    public function update_ketbank($data) {
        $where = 'KD_BANK =' . $data['KD_BANK'];
//        print_r($data['id']);
        $input = array(
            'KET_BANK' => $data['KET_BANK']
        );
        $this->_db->update($this->_table, $input, $where);
    }

    /*
     * method untuk menghapus bank dalam database
     */

    public function deleteBank() {
        $where = 'KD_BANK=' . $this->get_id();
//        print_r($where);
        $this->_db->delete($this->_table, $where);
    }

    /*
     * getter 
     */

    public function get_id() {
        return $this->_id;
    }

    public function get_nama() {
        return $this->_nama;
    }

    public function get_keterangan() {
        return $this->_keterangan;
    }

    /*
     * setter 
     */

    public function set_id($id) {
        $this->_id = $id;
    }

    public function set_nama($nama) {
        $this->_nama = $nama;
    }

    public function set_keterangan($keterangan) {
        $this->_keterangan = $keterangan;
    }

}

?>
