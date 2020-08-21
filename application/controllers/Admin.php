<?php
class Admin extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('model_admin');
        $this->load->library(array('pagination','form_validation','upload'));
    }
    function index(){
        $data=array(
            'title'=>'Master Data',
            'active_master'=>'active',
            'kode_foto'=>$this->model_admin->getKodeFoto(),
            'data_foto'=>$this->model_admin->getAllData('tbl_foto'),
        );
        $this->load->view('view_foto',$data);
    }
    // Admin
    function tambah_foto(){
        $config['upload_path'] = './assets/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1000';
        $config['max_width']  = '2000';
        $config['max_height']  = '1024';

        $this->upload->initialize($config);
        if(!$this->upload->do_upload('foto')){
            $foto="";
        }else{
            $foto=$this->upload->file_name;
        }
        $data=array(
            'kode_foto'=>$this->input->post('kode_foto'),
            'nama_foto'=>$this->input->post('nama_foto'),
            'foto'=>$foto,
        );
        $this->model_admin->insertData('tbl_foto',$data);
        redirect("admin");
    }
    function edit_foto(){
        $config['upload_path'] = './assets/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1000';
        $config['max_width']  = '2000';
        $config['max_height']  = '1024';

        $this->upload->initialize($config);
        if(!$this->upload->do_upload('foto')){
            $foto="";
        }else{
            $foto=$this->upload->file_name;
        }

        $id['kode_foto'] = $this->input->post('kode_foto');
        $detail=$this->model_admin->getSelectedData('tbl_foto',$id)->result();
        foreach($detail as $row):
            unlink("assets/".$row->foto);
        endforeach;
        $data=array(
            'nama_foto'=>$this->input->post('nama_foto'),
            'foto'=>$foto,
        );
        $this->model_admin->updateData('tbl_foto',$data,$id);
        redirect("admin");
    }
    function hapus_foto(){
        $id['kode_foto'] = $this->uri->segment(3);
        $detail=$this->model_admin->getSelectedData('tbl_foto',$id)->result();
        foreach($detail as $row):
            unlink("assets/".$row->foto);
        endforeach;
        $this->model_admin->deleteData('tbl_foto',$id);
        redirect("admin");
    }

}

