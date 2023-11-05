<?php
class Matakuliah extends CI_Controller{
  public function index()
    {$data['matkul']=$this->M_matakuliah->tampilMatakuliah()->result();
        $this->load->view('view-form-matakuliah',$data);
    }
  public function cetak()
    {
      $this->form_validation->set_rules('kode', 'Kode Matakuliah', 'trim|required|numeric|min_length[3]',
      array('required' => '%s wajib diisi.',
      'numeric'=> '%s wajib diisi angka.',
      'min_length'=> '%s minimal 3 karakter.'));
      $this->form_validation->set_rules('nama', 'Nama Matakuliah', 'trim|required|alpha[3]',
      array('required' => '%s wajib diisi.',
      'alpha'=> '%s wajib diisi huruf.'));
      $this->form_validation->set_rules('sks', 'SKS', 'trim|required|numeric[3]',
      array('required' => '%s wajib dipilih.',
      'numeric'=> '%s wajib diisi angka.'));
      if ($this->form_validation->run() == FALSE)
                {
                        $this->load->view('view-form-matakuliah');
                }
                else
                {
                  $data = [
                  'kode' => $this->input->post('kode'),
                  'nama' => $this->input->post('nama'),
                  'sks' => $this->input->post('sks')
                          ];
          $this->M_matakuliah->simpanMatakuliah($data);
          redirect('Matakuliah');
        }
            }
            public function hapus(){
              $where=['kode'=>$this->uri->segment(3)];
              $this->M_matakuliah->hapusMatakuliah($where);
              redirect('Matakuliah');
            }
            public function edit(){
              $matkul=$this->M_matakuliah->matkulWhere(['kode'=>$this->uri->segment(3)])->result_array();
              $data=array(
                'kode'=>$matkul[0]['kode'],
                'nama'=>$matkul[0]['nama'],
                'sks'=>$matkul[0]['sks']
              );
              $this->load->view('view-edit-matakuliah',$data);
            }
            public function update()
            {
              $this->form_validation->set_rules('kode', 'Kode Matakuliah', 'trim|required|min_length[3]',
              array('required' => '%s wajib diisi.',
              'min_length'=> '%s terlalu pendek.'));
              $this->form_validation->set_rules('nama', 'Nama Matakuliah', 'required',
              array('required' => '%s wajib diisi.',
              'min_length'=> '%s terlalu pendek.'));
              $this->form_validation->set_rules('sks', 'SKS', 'required',
              array('required' => '%s wajib dipilih.'));
              if ($this->form_validation->run() == FALSE)
                        {
                                $this->load->view('view-edit-matakuliah');
                        }
                        else
                        {
                          $data = [
                          'kode' => $this->input->post('kode'),
                          'nama' => $this->input->post('nama'),
                          'sks' => $this->input->post('sks')
                                  ];
                  $this->M_matakuliah->updateMatakuliah($data,['kode'=>$this->input->post('kode')]);
                  redirect('Matakuliah');
                }
                    }
                    }
                       
