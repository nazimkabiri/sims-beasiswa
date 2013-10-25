<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class NotifikasiController extends BaseController{
    
    public function __construct($registry) {
        parent::__construct($registry);
    }
    
    public function index(){
        $this->view->d_notif = $this->get_notifikasi();
        $this->view->load('notifikasi');
    }
    
    private function get_notifikasi(){
        $notif = new Notifikasi($this->registry);
        $data = $notif->get_notifikasi();
        
        $d_notif = array();
        $i = 0;
        foreach ($data as $data){
            $pic = $data->get_pic();
            $nama_pic = $pic['nama'];
            $kode_pic = $pic['kode'];
            $foto_pic = $pic['foto'];
            $jatuh_tempo = explode('-',$data->get_jatuh_tempo());
            $count = count($jatuh_tempo)>1;
            $bln = $count?$jatuh_tempo[1]:'';
            $thn = $jatuh_tempo[0];
            $temp = array(
                'jatuh_tempo'=>$data->get_jatuh_tempo(),
                'bulan'=>  Tanggal::bulan_indo($bln),
                'tahun'=>  $thn,
                'nama_pic'=>$nama_pic,
                'kode_pic'=>$kode_pic,
                'foto_pic'=>$foto_pic,
                'tahun_masuk'=>$data->get_tahun_masuk(),
                'jurusan'=>$data->get_jurusan(),
                'univ'=>$data->get_univ(),
                'jenis'=>$data->get_jenis_notif(),
                'status'=>$data->get_status_notif()
            );
            $d_notif[] = $temp;
            $i++;
        }
        
        return json_encode($d_notif);
    }
    
    public function __destruct() {
        parent::__destruct();
    }
    
}
?>