<?php
defined ('BASEPATH') OR exit();

class Home extends CI_Controller {
    function __construct(){
        parent ::__construct();

        $this->load->model('Mobil_model', 'm');
        $this->load->helper('form');
        $this->load->helper('url');
    }

    public function index()
    {
        $data['title'] = "CI AJAX";
        $this->load->view('home', $data);
    }

    public function ambildata()
    {
        $dataMobil = $this->m->ambildata()->result();
        echo json_encode($dataMobil);
    }

    public function tambahdata()
    {
        $merk = $this->input->post('merk');
        $warna = $this->input->post('warna');
        $nopol = $this->input->post('nopol');


        if($merk==''){
            $result['pesan']="Merk Harus Diisi";
        }else if($warna==''){
            $result['pesan']="Warna Harus Diisi";
        }else if($nopol==''){
            $result['pesan']="NO. Polisi Harus Diisi";
        }else{
            $result['pesan']="";

            $data = array(
                'merk' => $merk,
                'warna' => $warna,
                'nopol' => $nopol
            );
            $this->m->tambahdata($data, 'mobil');
        }
        echo json_encode($result);
    }
    
    public function ambilId()
    {
        $id = $this->input->post('id');
        $where = array('id'=>$id);
        $dataMobil = $this->m->ambilId('mobil', $where)->result();
        echo json_encode($dataMobil);
    }

    public function ubahdata()
    {
        $id = $this->input->post('id');
        $merk = $this->input->post('merk');
        $warna = $this->input->post('warna');
        $nopol = $this->input->post('nopol');


        if($merk==''){
            $result['pesan']="Merk Harus Diisi";
        }else if($warna==''){
            $result['pesan']="Warna Harus Diisi";
        }else if($nopol==''){
            $result['pesan']="NO. Polisi Harus Diisi";
        }else{
            $result['pesan']="";

            $where = array('id' => $id);

            $data = array(
                'merk' => $merk,
                'warna' => $warna,
                'nopol' => $nopol
            );
            $this->m->updatedata($where, $data, 'mobil');
        }
        echo json_encode($result);
    }

    public function hapusdata()
    {
        $id = $this->input->post('id');
        $where = array('id'=>$id);
        $this->m->hapusdata($where, 'mobil');
    }

}

?>