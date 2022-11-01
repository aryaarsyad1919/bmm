<?php
class Artikel extends CI_Controller{

    function __construct(){
        parent::__construct();
        if($this->session->userdata('masuk') !=TRUE){
            $url=base_url('administrator');
            redirect($url);
        };
        $this->load->model('M_articel','m_articel');
        $this->load->library('upload');
    }

    function index(){
        $x['artikel']=$this->m_articel->get_all_falilitas();
        $this->load->view('admin/v_artikel',$x);
    }

    function add_new(){
        $this->load->view('admin/v_add_artikel');
    }

    function edit(){
        $kode=$this->uri->segment(4);
        $x['artikel']=$this->m_articel->get_artikel_by_kode($kode);
        $this->load->view('admin/v_edit_artikel',$x);
    }

    function simpan_artikel(){
        $config['upload_path'] = './assets/images/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya

        $this->upload->initialize($config);
        if(!empty($_FILES['filefoto']['name']))
        {
            if ($this->upload->do_upload('filefoto'))
            {
                $gbr = $this->upload->data();
                //Compress Image
                $config['image_library']='gd2';
                $config['source_image']='./assets/images/'.$gbr['file_name'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= FALSE;
                $config['quality']= '60%';
                $config['width']= 28.57464;
                $config['height']= 28.57464;
                $config['new_image']= './assets/images/'.$gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $gambar=$gbr['file_name'];
                $nama=strip_tags(htmlspecialchars($this->input->post('xnama',TRUE),ENT_QUOTES));
                $deskripsi=$this->input->post('xdeskripsi',TRUE);

                $this->m_articel->simpan_artikel($nama,$deskripsi,$gambar);
                echo $this->session->set_flashdata('msg','success');
                redirect('admin/artikel');
            }else{
                echo $this->session->set_flashdata('msg','warning');
                redirect('admin/artikel');
            }

        }else{
            redirect('admin/artikel');
        }
    }

    function update_artikel(){
        $config['upload_path'] = './assets/images/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya

        $this->upload->initialize($config);
        if(!empty($_FILES['filefoto']['name']))
        {
            if ($this->upload->do_upload('filefoto'))
            {
                $gbr = $this->upload->data();
                //Compress Image
                $config['image_library']='gd2';
                $config['source_image']='./assets/images/'.$gbr['file_name'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= FALSE;
                $config['quality']= '60%';
                $config['width']= 28.57464;
                $config['height']= 28.57464;
                $config['new_image']= './assets/images/'.$gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $gambar=$gbr['file_name'];
                $kode=$this->input->post('kode');
                $nama=strip_tags(htmlspecialchars($this->input->post('xnama',TRUE),ENT_QUOTES));
                $deskripsi=$this->input->post('xdeskripsi',TRUE);

                $this->m_articel->update_artikel($kode,$nama,$deskripsi,$gambar);
                echo $this->session->set_flashdata('msg','success');
                redirect('admin/artikel');
            }else{
                echo $this->session->set_flashdata('msg','warning');
                redirect('admin/artikel');
            }

        }else{
            $kode=$this->input->post('kode');
            $nama=strip_tags(htmlspecialchars($this->input->post('xnama',TRUE),ENT_QUOTES));
            $deskripsi=$this->input->post('xdeskripsi',TRUE);

            $this->m_articel->update_artikel_no_img($kode,$nama,$deskripsi);
            echo $this->session->set_flashdata('msg','success');
            redirect('admin/artikel');
        }
    }

    function hapus_artikel(){
        $kode=$this->input->post('kode2');
        $this->m_articel->hapus_artikel($kode);
        echo $this->session->set_flashdata('msg','success-hapus');
        redirect('admin/artikel');
    }


}