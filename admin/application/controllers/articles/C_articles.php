<?php
    class C_articles extends MY_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model('articles/M_articles','articles');
        }

        public function index(){
            $data['all_data'] = $this->articles->get_data();
            $this->load->view('articles/V_articles',$data);
        }


        public function save(){
            $id_articles = $this->input->post('id_articles');
    
            if (empty($id_articles)) {
                $this->add();
            } else {
                $this->update($id_articles);
            }
        }
        
        private function add(){                
                $this->articles->titre = $this->input->post('titre');
                $this->articles->description = $this->input->post('description');
                $this->articles->contenu = $this->input->post('contenu');
                $this->articles->publie = $this->input->post('publie');
                $this->articles->alaune = $this->input->post('alaune');
                $this->articles->etat = parse_etat_form($this->input->post('etat'));
                $this->articles->code_annees = date('Y');
                $this->articles->matricule = $_SESSION['matricule'];
                $this->articles->date_creation = date('Y-m-d H:i:s');
                
                $config['upload_path']   = FCPATH . 'assets/upload/articles'; 
                $config['allowed_types'] = 'gif|jpg|png|doc|docx|xls|xlsx|ppt|pptx|csv'; 
                $nameFile=$_FILES["photo"]['name'];
                $this->articles->photo = $nameFile;
                $config['file_name']=$nameFile;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                    if ( ! $this->upload->do_upload('photo')) {
                    $error = array('error' => $this->upload->display_errors()); 
                    }
           
        echo json_encode($this->articles->add_articles(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
        }
        private function update($id_articles){
            $this->articles->id_articles = $this->input->post('id_articles');
                $this->articles->titre = $this->input->post('titre');
                $this->articles->description = $this->input->post('description');
                $this->articles->contenu = $this->input->post('contenu');
                $this->articles->publie = $this->input->post('publie');
                $this->articles->alaune = $this->input->post('alaune');
                $this->articles->photo = $this->input->post('photo');
                $this->articles->etat = parse_etat_form($this->input->post('etat'));
                $this->articles->code_annees = date('Y');
                $this->articles->matricule = $_SESSION['matricule'];
                $this->articles->date_modification = date('Y-m-d H:i:s');
                
                $config['upload_path']   = FCPATH . 'assets/upload'; 
                $config['allowed_types'] = 'gif|jpg|png'; 
                $nameFile=$_FILES["photo"]['name'];
                $this->articles->photo = $nameFile;
                $config['file_name']=$nameFile;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                    if ( ! $this->upload->do_upload('photo')) {
                    $error = array('error' => $this->upload->display_errors()); 
                    }
            echo json_encode($this->articles->update_articles(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
        }

        public function get_record(){
            $args = func_get_args();
            $this->articles->id_articles=$args[0];
            $this->articles->get_record();
            echo json_encode($this->articles, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
        }

        public function delete(){
            $args = func_get_args();
            $this->articles->id_articles=$args[0];
            echo json_encode($this->articles->fake_delete(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
        }
    }