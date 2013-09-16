<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Pemberi extends BaseModel {
    var $kd_pemberi;
    var $nama_pemberi;
    var $alamat_pemberi;
    var $telp_pemberi;
    var $pic_pemberi;
    var $telp_pic_pemberi;
    
    public function __construct() {
        parent::__construct();
        
    }

    /*
     * mendapatkan seluruh data strata dari database dalam bentuk array
     * mengubah masing-masing array ke dalam objek stata
     * return array objek 
     */

    public function get_All() {
        $table = "r_pemb";
        $sql = "SELECT * FROM $table";
        $result = $this->db->select($sql);
        //var_dump($result);
        $data = array();
        foreach ($result as $val) {
            $pemberi = new $this();
            $pemberi->kd_pemberi = $val['KD_PEMB'];
            $pemberi->nama_pemberi = $val['NAMA_PEMB'];
            $pemberi->alamat_pemberi = $val['ALAMAT_PEMB'];
            $pemberi->telp_pemberi = $val['TELP_PEMB'];
            $pemberi->pic_pemberi = $val['PIC_PEMB'];
            $pemberi->telp_pic_pemberi = $val['TELP_PIC_PEMB'];
            $data[] = $pemberi;
        }
        //var_dump($data);
        return $data;
    }
     /*
     * mendapatkan seluruh data strata dari database dalam bentuk array
     * mengubah masing-masing array ke dalam objek stata
     * return array objek 
     */

    public function get_by_id($id) {
        $table = "r_pemb";
        $where = "KD_PEMB='".$id."'";
        $sql = "SELECT * FROM $table where $where";
        $result = $this->db->select($sql);
        //var_dump($result);
        
        foreach ($result as $val) {
            $pemberi = new $this();
            $pemberi->kd_pemberi = $val['KD_PEMB'];
            $pemberi->nama_pemberi = $val['NAMA_PEMB'];
            $pemberi->alamat_pemberi = $val['ALAMAT_PEMB'];
            $pemberi->telp_pemberi = $val['TELP_PEMB'];
            $pemberi->pic_pemberi = $val['PIC_PEMB'];
            $pemberi->telp_pic_pemberi = $val['TELP_PIC_PEMB'];
            
        }
        //var_dump($data);
        return $pemberi;
    }
    

    /*
     * menambahkan data strata ke dalam database
     * param objek strata diubah ke bentuk array
     * return void 
     */

    public function add(Pemberi $pemberi) {
        $table = "r_pemb";
        $data = array(
                'NAMA_PEMB'=>$pemberi->nama_pemberi,
                'ALAMAT_PEMB'=>$pemberi->alamat_pemberi,
                'TELP_PEMB'=>$pemberi->telp_pemberi,
                'PIC_PEMB'=>$pemberi->pic_pemberi,
                'TELP_PIC_PEMB'=>$pemberi->telp_pic_pemberi
            );
        //var_dump($data);
        $this->db->insert($table, $data);
    }

    /*
     * menghapus data strata dari database
     * param id = kd_strata
     * return void 
     */
    public function delete($id = null) {
        $table = "r_PEMB";
        $where = 'KD_PEMB='.$id;
        //echo $id;
        $this->db->delete($table,$where);
    }

    public function update(Pemberi $pemberi) {
        $table= "r_pemb";
        $data = array(
                'NAMA_PEMB'=>$pemberi->nama_pemberi,
                'ALAMAT_PEMB'=>$pemberi->alamat_pemberi,
                'TELP_PEMB'=>$pemberi->telp_pemberi,
                'PIC_PEMB'=>$pemberi->pic_pemberi,
                'TELP_PIC_PEMB'=>$pemberi->telp_pic_pemberi
            );
        $where = "KD_PEMB='".$pemberi->kd_pemberi."'";
        $this->db->update($table, $data, $where);
    }
    
    

}

?>
