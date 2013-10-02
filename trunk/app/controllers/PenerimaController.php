<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class PenerimaController extends BaseController{
    
    public function __construct($registry){
        parent::__construct($registry);
    }
    
    public function profil($id=null){
        $pb = new Penerima($this->registry); //mendapatkan informasi pb
        $st = new SuratTugas($this->registry); //mendapatkan informasi surat tugas
        $el = new ElemenBeasiswa($this->registry); //mendapatkan pembayaran
        $bank = new Bank($this->registry); //mendapatkan nama bank
        $jst = new JenisSuratTugas($this->registry); //mendapatkan jenis surat tugas
        $jur = new Jurusan($this->registry);
        $univ = new Universitas($this->registry);
        $nilai = new Nilai($this->registry);
        $cuti = new Cuti($this->registry);
        $mas = new MasalahPenerima($this->registry);
        $beaya = new Biaya();
        if(!is_null($id)){
            $pb->set_kd_pb($id);
            $this->view->d_pb = $pb->get_penerima_by_id($pb);
            $st->set_kd_st($this->view->d_pb->get_st());
            $this->view->d_st = $st->get_surat_tugas_by_id($st);
            $this->view->d_bank = $bank->get_bank_id($this->view->d_pb->get_bank());
            $jur->set_kode_jur($this->view->d_pb->get_jur());
            $this->view->d_jur = $jur->get_jur_by_id($jur);
            $jst->set_kode($this->view->d_st->get_jenis_st());
            $this->view->d_jst = $jst->get_jst_by_id($jst);
            $this->view->d_univ = $univ->get_univ_by_jur($this->view->d_jur->get_kode_jur());
            $this->view->d_nil = $nilai->get_nilai($pb);
            $this->view->d_cur_ipk = $nilai->get_current_ipk($pb);
            $this->view->d_cuti = $cuti->get_cuti($pb);
            $this->view->d_rwt_beas = $pb->get_penerima_by_column($pb,'nip',true);
            $elem = $el->get_elem_per_pb($pb, false);
            $bea = $beaya->get_cost_per_pb($pb,false);
            $this->view->d_mas = $mas->get_masalah($pb);
            $d_bea = array();
            /*
             * sementara versi dummy dulu ye :p
             */
            foreach($elem as $v){
                $d = new BiayaPenerimaBeasiswa();
                $d->set_nama_biaya($v->get_kd_r());
                $d->set_jumlah_biaya($v->get_total_bayar());
                $d_bea[] = $d;
            }
            
            foreach($bea as $v){
                $d = new BiayaPenerimaBeasiswa();
                $d->set_nama_biaya($v->nama_tagihan);
                $d->set_jumlah_biaya($v->biaya_per_pegawai);
                $d_bea[] = $d;
            }
            $this->view->d_bea = $d_bea;
        }
        
        $this->view->render('profil/data_profil');
    }
    
    public function datapb(){
        $pb = new Penerima($this->registry);
        $univ = new Universitas($this->registry);
        $st = new SuratTugas($this->registry);
        $this->view->th_masuk = $st->get_list_th_masuk();
        $this->view->univ = $univ->get_univ();
        $this->view->d_pb = $pb->get_penerima();
        $this->view->render('riwayat_tb/data_pb');
    }
    
    /*
     * menampilkan form rekam, ubah, daftar data penerima tb
     */
    public function penerima($id=null){
        $pb = new Penerima($this->registry);
        
        $upload = $this->registry->upload;
        $upload->init('fupload'); //awali dengan fungsi ini
        $upload->setDirTo('files/'); //set direktori tujuan
        $ubahNama = array('KAKA','KIKI','KEKE'); //pola nama baru dalam array
        $upload->changeFileName($upload->getFileName(), $ubahNama); //ubah nama
        
        if(isset($_POST['sb_add'])){
            $st = $_POST['st'];
            $bank = $_POST['bank'];
            $nip = $_POST['nip'];
            $telp = $_POST['telp'];
            $alamat = $_POST['alamat'];
            $email = $_POST['email'];
            $no_rek = $_POST['no_rek'];
            
            $data = array(
                'KD_ST'=>$st,
                'KD_BANK'=>$bank,
                'NIP_PB'=>$nip,
                'EMAIL_PB'=>$email,
                'TELP_PB'=>$telp,
                'ALMT_PB'=>$alamat,
                'NO_REKENING_PB'=>$no_rek,
                'FOTO_PB'=>$upload->getFileTo(),
            );
            
            if(!Validasi::validate_nip($nip)) echo 'nip salah....!';
            if($pb->add_penerima($data)){
                /*
                 * upload file
                 */
                $upload->uploadFile();
            }
            
            
        }
        
        if(!is_null($id)){
            $pb->set_kd_pb($id);
            $this->view->d_ubah = $pb->get_penerima_by_id($pb);
        }
        $st = new SuratTugas($this->registry);
        $this->view->d_st = $st->get_surat_tugas();
        $this->view->d_pb = $pb->get_penerima();
        $this->view->render('riwayat_tb/penerima_beasiswa');
        
    }
    
    public function pb_by_st(){
        $kd_st = $_POST['param'];
        $pb = new Penerima($this->registry);
        $pb->set_st($kd_st);
        $this->view->d_pb = $pb->get_penerima_by_st($pb);
        $this->view->load('riwayat_tb/tabel_pb');
        
    }
    
    public function find_pb(){
        $param = explode(",",$_POST['param']);
        $nama = $param[0];
        $st = $param[1];
        $pb = new Penerima($this->registry);
        $pb->set_nama($nama);
        $pb->set_st($st);
        $this->view->d_pb = $pb->get_penerima_by_name($pb);
        $this->view->load('riwayat_tb/tabel_pb');
        
    }


    /*
     * tambah penerima pada surat tugas
     */
    public function add_from_dialog_to_st(){
        $pb = new Penerima($this->registry);
        $st = new SuratTugas($this->registry);
        $kd = $_POST['st'];
        $bank = $_POST['bank'];
        $nip = $_POST['nip'];
        $nama = $_POST['nama'];
        $telp = $_POST['telp'];
        $email = $_POST['email'];
        $no_rek = $_POST['no_rek'];
        $jkel = $_POST['jkel'];
        $gol = $_POST['gol'];
        $unit = $_POST['unit'];
        
        /*
         * mendapatkan kode jurusan 
         */
        $st->set_kd_st($kd);
        $st->get_surat_tugas_by_id($st);
        $jur = $st->get_jur();
        $data = array(
            'KD_ST'=>$kd,
            'KD_BANK'=>$bank,
            'NIP_PB'=>$nip,
            'NM_PB'=>$nama,
            'TELP_PB'=>$telp,
            'EMAIL_PB'=>$email,
            'NO_REKENING_PB'=>$no_rek,
            'JK_PB'=>$jkel,
            'KD_GOL'=>$gol,
            'UNIT_ASAL_PB'=>$unit,
            'KD_JUR'=>$jur,
            'KD_STS_TB'=>1
        );
        
        $pb->add_penerima($data);
    }
    
    /*
     * update penerima tb
     */
    public function updpenerima(){
        $pb = new Penerima($this->registry);
        
        $kd = $_POST['kd_pb'];
        $st = $_POST['st'];
        $bank = $_POST['bank'];
        /*$jur = $_POST['jur'];
        $status = $_POST['status'];
        $nama = $_POST['nama'];*/
        $nip = $_POST['nip'];
        /*$gol = $_POST['gol'];
        $unit_asal = $_POST['unit_asal'];*/
        $telp = $_POST['telp'];
        $alamat = $_POST['alamat'];
        $email = $_POST['email'];
        $no_rek = $_POST['no_rek'];
        /*$jkel = $_POST['jk'];
        $tgl_lapor = $_POST['tgl_lap'];
        $skl = $_POST['skl'];
        $spmt = $_POST['spmt'];
        $skripsi = $_POST['skripsi'];*/
        
        $data = array(
            'KD_ST'=>$st,
            /*'KD_JUR'=>$jur,*/
            'KD_BANK'=>$bank,
            /*'KD_STATUS_TB'=>$status,*/
            'NIP_PB'=>$nip,
            /*'NAMA_PB'=>$nama,
            'JK_PB'=>$jkel,
            'GOLONGAN_PB'=>$gol,
            'UNIT_ASAL_PB'=>$unit_asal,*/
            'EMAIL_PB'=>$email,
            'TELP_PB'=>$telp,
            'ALMT_PB'=>$alamat,
            'NO_REKENING_PB'=>$no_rek,
            /*'TANGGAL_LAPOR_PB'=>$tgl_lapor,
            'NOMOR_SKL_PB'=>$skl,
            'NO_SPMT_PB'=>$spmt,
            'JUDUL_SKRIPSI_PB'=>$skripsi*/
        );
        
        if(!is_null($_FILES['fupload'])){
            $upload = $this->registry->upload;
            $upload->init('fupload'); //awali dengan fungsi ini
            $upload->setDirTo('files/foto'); //set direktori tujuan
            $ubahNama = array('KAKA','KIKI','KEKE'); //pola nama baru dalam array
            $upload->changeFileName($upload->getFileName(), $ubahNama); //ubah nama
            $data['FOTO_PB'] = $upload->getFileTo();
            $upload->uploadFile();
        }
        
        
        $pb->set_kd_pb($kd);
        $pb->update_penerima($data);
        header('location:'.URL.'penerima/penerima');
    }
    
    /*
     * hapus penerima tb
     */
    public function delpb($id){
        $pb = new Penerima($this->registry);
        $pb->set_kd_pb($id);
        $pb->get_penerima_by_id($pb);
        $file = 'files/'.$pb->get_foto();
        $pb->delete_penerima();
        if(file_exists($file)) unlink($file);
        header('location:'.URL.'penerima/penerima');
    }
    
    public function get_nama_peg(){
        $nip = $_POST['param'];
        
        $peg = new Pegawai($this->registry);
        $peg->set_nip($nip);
        $data = $peg->get_peg_by_nip($peg);
        $nm = $data->get_nama();
        $jk = $data->get_jkel();
        $gol = $data->get_golongan();
        $unit = $data->get_unit_asal();
        $pb = new Penerima($this->registry);
        $pb->set_nip($nip);
        $d_cek = $pb->cek_exist_pb();
        $d_cek = $d_cek['cek'];
        $return = json_encode(array(
            'nama'=>$nm,
            'jkel'=>$jk,
            'gol'=>$gol,
            'unit'=>$unit,
            'registered'=>$d_cek
        ));
        
        echo $return;
    }
    
    public function editpb($kode_pb){
        $pb = new Penerima($this->registry); //mendapatkan informasi pb
        $st = new SuratTugas($this->registry); //mendapatkan informasi surat tugas
        $bank = new Bank($this->registry); //mendapatkan nama bank
        $jst = new JenisSuratTugas($this->registry); //mendapatkan jenis surat tugas
        $jur = new Jurusan($this->registry);
        $univ = new Universitas($this->registry);
        $nilai = new Nilai($this->registry);
        $cuti = new Cuti($this->registry);
        $mas = new MasalahPenerima($this->registry);
        $pb->set_kd_pb($kode_pb);
        $this->view->d_pb = $pb->get_penerima_by_id($pb);
        $st->set_kd_st($this->view->d_pb->get_st());
        $this->view->d_st = $st->get_surat_tugas_by_id($st);
        $this->view->d_bank = $bank->get_bank_id($this->view->d_pb->get_bank());
        $jur->set_kode_jur($this->view->d_pb->get_jur());
        $this->view->d_jur = $jur->get_jur_by_id($jur);
        $jst->set_kode($this->view->d_st->get_jenis_st());
        $this->view->t_jst = $jst->get_jst();
        $this->view->d_jst = $jst->get_jst_by_id($jst);
        $this->view->d_univ = $univ->get_univ_by_jur($this->view->d_jur->get_kode_jur());
        $this->view->d_nil = $nilai->get_nilai($pb);
        $this->view->d_cur_ipk = $nilai->get_current_ipk($pb);
        $this->view->d_cuti = $cuti->get_cuti($pb);
        $this->view->d_rwt_beas = $pb->get_penerima_by_column($pb,'nip',true);
        $this->view->d_mas = $mas->get_masalah($pb);
        $this->view->render('profil/ubah_profil_v2');
    }
    
    public function dialog_masalah($kd_pb){
        $this->view->kd_pb = $kd_pb;
        $pb = new Penerima($this->registry);
        $pb->set_kd_pb($kd_pb);
        $this->view->d_pb = $pb->get_penerima_by_id($pb);
        $this->view->load('profil/dialog_masalah');
    }
    
    public function add_problem(){
        $kd_pb = $_POST['kd_pb'];
        $uraian = $_POST['uraian'];
        $sumber = $_POST['sumber'];
        
        $mas = new MasalahPenerima($this->registry);
        $mas->set_kode_pb($kd_pb);
        $mas->set_uraian($uraian);
        $mas->set_sumber_masalah($sumber);
        $mas->add_masalah();
    }
    
    public function get_masalah($kd_pb){
        $pb = new Penerima($this->registry);
        $pb->set_kd_pb($kd_pb);
        
        $mas = new MasalahPenerima($this->registry);
        $this->view->d_mas = $mas->get_masalah($pb);
        
        $this->view->load('profil/tabel_masalah');
    }
    
    public function dialog_nilai($kd_pb){
        $this->view->kd_pb = $kd_pb;
        $pb = new Penerima($this->registry);
        $pb->set_kd_pb($kd_pb);
        $this->view->d_pb = $pb->get_penerima_by_id($pb);
        $this->view->load('profil/dialog_nilai');
    }
    
    public function add_nilai(){
        $kd_pb = $_POST['kd_pb'];
        $ips = $_POST['ips'];
        $ipk = $_POST['ipk'];
        $sem = $_POST['semester'];
        $pb = new Penerima($this->registry);
        $pb->set_kd_pb($kd_pb);
        $d_pb = $pb->get_penerima_by_id($pb);
        /*
         * upload file
         */
        //        $upload = new Upload();
        $this->registry->upload->init('sfile');
        $this->registry->upload->setDirTo('files/transkrip');
        $nm_file = array('TRANSKRIP',$d_pb->get_nip(),$sem);
        $this->registry->upload->changeFileName($this->registry->upload->getFileName(), $nm_file);
        $file = $this->registry->upload->getFileName();
        $this->registry->upload->uploadFile();
        /*
         * rekam nilai di tabel d_nil
         */
        $nilai = new Nilai($this->registry);
        $nilai->set_pb($kd_pb);
        $nilai->set_ips($ips);
        $nilai->set_ipk($ipk);
        $nilai->set_semester($sem);
        $nilai->set_file($file);
        $nilai->add_nilai();
    }
    
    public function get_nilai($kd_pb){
        $pb = new Penerima($this->registry);
        $pb->set_kd_pb($kd_pb);
        $nil = new Nilai($this->registry);
        $this->view->d_nil= $nil->get_nilai($pb);
        
        
        $this->view->load('profil/tabel_nilai');
    }

    public function __destruct() {
        parent::__destruct();
    }
}
?>
