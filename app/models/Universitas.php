<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Universitas {

    private $db;
    /*private $_no;
    private $_kd_univ;
    private $_kode_univ;
    private $_kode_pic;
    private $_nama;
    private $_alamat;
    private $_telepon;
    private $_status;
    private $_lokasi;*/
    private $_error;
    private $_valid = TRUE;
    private $_table = 'r_univ';
    public $registry;

    /*
     * konstruktor
     */

    public function __construct($registry = Registry) {
        $this->db = $registry->db;
        $this->registry = $registry;
    }

    /*
     * mendapatkan data dari tabel universitas
     * @param limit batas default null
     * return array objek universitas
     */

    public function get_univ($kd_user=null, $limit = null, $batas = null) {
        $sql = "SELECT * FROM " . $this->_table . " ";
        if(!is_null($kd_user)){
            $sql .= " WHERE KD_USER=".$kd_user;
        }
        if (!is_null($limit) AND !is_null($batas)) {
            $sql .= " LIMIT " . $limit . "," . $batas;
        }
        $urut=$limit+1;
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            //$univ = new $this($this->registry);
            $univ = new UniversitasDao();
            $univ->set_no($urut++);
            $univ->set_kode_in($val['KD_UNIV']);
            $univ->set_kode($val['SINGKAT_UNIV']);
            $user = new User($this->registry);
            $pic = $user->getUser_id($val['KD_USER']);
            $univ->set_pic($pic->get_nmUser());
            $univ->set_nama($val['NM_UNIV']);
            $univ->set_alamat($val['ALMT_UNIV']);
            $univ->set_telepon($val['TELP_UNIV']);
            $univ->set_status($val['STATUS_UNIV']);
            $univ->set_lokasi($val['LOK_UNIV']);
            $data[] = $univ;
            unset($user);
        }

        return $data;
    }

    /*
     * mendapatkan universitas sesuai id
     * @param objek Universitas
     * return objek Universitas
     */

    public function get_univ_by_id($univ = UniversitasDao) {
        if (is_null($univ->get_kode_in())) {
            return false;
        }
        $sql = "SELECT * FROM " . $this->_table . " WHERE KD_UNIV=" . $univ->get_kode_in();
        //echo $sql;
        $result = $this->db->select($sql);
        $univ = new UniversitasDao();
        foreach ($result as $val) {
            $univ->set_kode_in($val['KD_UNIV']);
            $univ->set_kode($val['SINGKAT_UNIV']);
            $univ->set_pic($val['KD_USER']);
            $univ->set_nama($val['NM_UNIV']);
            $univ->set_alamat($val['ALMT_UNIV']);
            $univ->set_telepon($val['TELP_UNIV']);
            $univ->set_status($val['STATUS_UNIV']);
            $univ->set_lokasi($val['LOK_UNIV']);
        }
        return $univ;
    }

    /*
     * tambah data universitas
     * param array data array key=>value, nama kolom=>data
     */

    public function add_univ(UniversitasDao $univ) {

        $data = array(
            'KD_USER' => $univ->get_pic(),
            'SINGKAT_UNIV' => $univ->get_kode(),
            'NM_UNIV' => $univ->get_nama(),
            'ALMT_UNIV' => $univ->get_alamat(),
            'TELP_UNIV' => $univ->get_telepon(),
            'LOK_UNIV' => $univ->get_lokasi()
        );
        $this->validate($univ);
        if (!$this->get_valid())
            return false;
        if (!is_array($data))
            return false;
        return $this->db->insert($this->_table, $data);
    }

    /*
     * update universitas, id harus di set terlebih dahulu
     * param data array
     */

    public function update_univ(UniversitasDao $univ) {
        $data = array(
            'KD_USER' => $univ->get_pic(),
            'SINGKAT_UNIV' => $univ->get_kode(),
            'NM_UNIV' => $univ->get_nama(),
            'ALMT_UNIV' => $univ->get_alamat(),
            'TELP_UNIV' => $univ->get_telepon(),
            'LOK_UNIV' => $univ->get_lokasi()
        );
        $this->validate($univ);
        if (!$this->get_valid())
            return false;
        if (!is_array($data))
            return false;
        $where = ' KD_UNIV=' . $univ->get_kode_in();
        return $this->db->update($this->_table, $data, $where);
    }

    /*
     * hapus universitas, id harus di set terlebih dahulu
     */

    public function delete_univ(UniversitasDao $univ) {
        $where = ' KD_UNIV=' . $univ->get_kode_in();
        $this->db->delete($this->_table, $where);
    }

    public function validate(UniversitasDao $univ) {
        if ($univ->get_pic() == 0) {
            $this->_error .= "User belum dipilih!</br>";
            $this->_valid = FALSE;
        }
        if ($univ->get_kode() == "") {
            $this->_error .= "Nama singkat Perguruan Tinggi belum diinput!<?br>";
            $this->_valid = FALSE;
        }
        if ($univ->get_nama() == "" OR !Validasi::validate_string($univ->get_nama())) {
            $this->_error .= "Nama Perguruan Tinggi belum diinput!</br>";
            $this->_valid = FALSE;
        }
        if ($univ->get_alamat() == "") {
            $this->_error .= "Alamat belum diinput!</br>";
            $this->_valid = FALSE;
        }
        if ($univ->get_telepon() == "" OR !Validasi::validate_number($univ->get_telepon())) {
            $this->_error .= "Telepon belum diinput!</br>";
            $this->_valid = FALSE;
        }
        if ($univ->get_lokasi() == "" OR !Validasi::validate_string($univ->get_lokasi())) {
            $this->_error .= "Lokasi belum diinput!</br>";
            $this->_valid = FALSE;
        }
    }

    /*
     * setter
     *

    public function set_no($no) {
        $this->_no = $no;
    }
    
    public function set_kode_in($kode) {
        $this->_kd_univ = $kode;
    }

    public function set_kode($kode) {
        $this->_kode_univ = $kode;
    }

    public function set_pic($pic) {
        $this->_kode_pic = $pic;
    }

    public function set_nama($nama) {
        $this->_nama = $nama;
    }

    public function set_alamat($alamat) {
        $this->_alamat = $alamat;
    }

    public function set_telepon($telepon) {
        $this->_telepon = $telepon;
    }

    public function set_status($status) {
        $this->_status = $status;
    }

    public function set_lokasi($lokasi) {
        $this->_lokasi = $lokasi;
    }
    
    */
    public function set_table($table) {
        $this->_table = $table;
    }

    /*
     * getter
     *
    
    public function get_no() {
        return $this->_no;
    }

    public function get_kode_in($where = null) {
        if (!is_null($where)) {
            $sql = "SELECT KD_UNIV FROM '" . $this->_table . "' WHERE '" . $where . "'";
            $result = $this->db->select($sql);
            foreach ($result as $val) {
                $this->set_kode_in($val['KD_UNIV']);
            }
        }
        return $this->_kd_univ;
    }

    public function get_kode() {
        return $this->_kode_univ;
    }

    public function get_pic() {
        return $this->_kode_pic;
    }

    public function get_alamat() {
        return $this->_alamat;
    }

    public function get_lokasi() {
        return $this->_lokasi;
    }

    public function get_nama() {
        return $this->_nama;
    }

    public function get_status() {
        return $this->_status;
    }

    public function get_telepon() {
        return $this->_telepon;
    }

    */

    public function get_error() {
        return $this->_error;
    }

    public function get_valid() {
        return $this->_valid;
    }

    /*
     * mendapatkan data universitas berdasarkan jurusan
     */

    public function get_univ_by_jur($kd_jur) {
        $table = "r_jur a, r_fakul b, r_univ c";
        $where = "c.KD_UNIV = b.KD_UNIV AND b.KD_FAKUL=a.KD_FAKUL AND a.KD_JUR = '" . $kd_jur . "'";
        $sql = "SELECT * FROM $table where $where";
        $result = $this->db->select($sql);
        //var_dump($result);
        // $data = array();
        $univ = new UniversitasDao();
        foreach ($result as $val) {
            $univ->set_kode_in($val['KD_UNIV']);
            $univ->set_kode($val['SINGKAT_UNIV']);
            $univ->set_pic($val['KD_USER']);
            $univ->set_nama($val['NM_UNIV']);
            $univ->set_alamat($val['ALMT_UNIV']);
            $univ->set_telepon($val['TELP_UNIV']);
            $univ->set_status($val['STATUS_UNIV']);
            $univ->set_lokasi($val['LOK_UNIV']);
        }
        return $univ;
    }
	
	public function get_univ_by_pic($pic) {
        $table = "r_univ";
        $where = "KD_USER = '".$pic."'";
        $sql = "SELECT * FROM $table where $where";
        $result = $this->db->select($sql);
        //var_dump($result);
        $data = array();
        foreach ($result as $val) {
            //$univ = new $this($this->registry);
            $univ = new UniversitasDao();
            $univ->set_kode_in($val['KD_UNIV']);
            $univ->set_kode($val['SINGKAT_UNIV']);
            $univ->set_pic($val['KD_USER']);
            $univ->set_nama($val['NM_UNIV']);
            $univ->set_alamat($val['ALMT_UNIV']);
            $univ->set_telepon($val['TELP_UNIV']);
            $univ->set_status($val['STATUS_UNIV']);
            $univ->set_lokasi($val['LOK_UNIV']);
            $data[] = $univ;
        }
        return $data;
    }

    /*
     * destruktor
     */

    public function __destruct() {
        ;
    }

}

?>
