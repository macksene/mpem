<?php
    class C_publications extends MY_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model('publications/M_publications','publications');
        }

        public function index(){
            $data['all_data'] = $this->publications->get_data();
            $this->load->view('publications/V_publications',$data);
        }


        public function save(){
            $id_publications = $this->input->post('id_publications');
    
            if (empty($id_publications)) {
                $this->add();
            } else {
                $this->update($id_publications);
            }
        }

        private function add(){                
                $this->publications->departement = $this->input->post('departement');
                $this->publications->categorie = $this->input->post('categorie');
                $this->publications->titre = $this->input->post('titre');
                $this->publications->description = $this->input->post('description');
                $this->publications->fichier = $this->input->post('fichier');
                // $this->publications->photo = $this->input->post('photo');
                $this->publications->publie = $this->input->post('publie');
                $this->publications->etat = parse_etat_form($this->input->post('etat'));
                $this->publications->code_annees = date('Y');
                $this->publications->matricule = $_SESSION['matricule'];
                $this->publications->date_creation = date('Y-m-d H:i:s');
                
                $config['upload_path']   = FCPATH . 'assets/upload/publications'; 
                $config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx|xls|xlsx|ppt|pptx|csv'; 
                // $nameFichier=$_FILES["fichier"]['name'];
                $namePhoto=$_FILES["photo"]['name'];
                // $this->publications->fichier = $nameFichier;
                $this->publications->photo = $namePhoto;
                // $config['file_name']=$nameFichier;
                $config['file_name']=$namePhoto;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                    // if ( ! $this->upload->do_upload('fichier')) {
                    // $error = array('error' => $this->upload->display_errors()); 
                    // }
                    if ( ! $this->upload->do_upload('photo')) {
                        $error = array('error' => $this->upload->display_errors()); 
                        }
           
        echo json_encode($this->publications->add_publications(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
        }

        private function update($id_publications){
            $this->publications->id_publications = $this->input->post('id_publications');
            $this->publications->departement = $this->input->post('departement');
            $this->publications->categorie = $this->input->post('categorie');
            $this->publications->titre = $this->input->post('titre');
            $this->publications->description = $this->input->post('description');
            $this->publications->fichier = $this->input->post('fichier');
            // $this->publications->photo = $this->input->post('photo');
            $this->publications->publie = $this->input->post('publie');
            $this->publications->etat = parse_etat_form($this->input->post('etat'));
            $this->publications->code_annees = date('Y');
            $this->publications->matricule = $_SESSION['matricule'];
            $this->publications->date_creation = date('Y-m-d H:i:s');
            $config['upload_path']   = FCPATH . 'assets/upload/publications'; 
            $config['allowed_types'] = 'gif|jpg|png|pdf|docx'; 
            // correction erreur 
            // $nameFichier=$_FILES["fichier"]['name'];
            $namePhoto=$_FILES["photo"]['name'];
            // $this->publications->fichier = $nameFichier;
            $this->publications->photo = $namePhoto;
            //convertissons le fichier 
            // $config['fichier_name']=$nameFichier;
            $config['photo_name']=$namePhoto;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
                // if ( ! $this->upload->do_upload('fichier')) {
                // $error = array('error' => $this->upload->display_errors()); 
                // }
                if ( ! $this->upload->do_upload('photo')) {
                    $error = array('error' => $this->upload->display_errors()); 
                    }
       
            echo json_encode($this->publications->update_publications(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
        }

        public function get_record(){
            $args = func_get_args();
            $this->publications->id_publications=$args[0];
            $this->publications->get_record();
            echo json_encode($this->publications, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
        }

        public function delete(){
            $args = func_get_args();
            $this->publications->id_publications=$args[0];
            echo json_encode($this->publications->fake_delete(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
        }
    }