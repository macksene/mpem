<?php
    class C_services extends MY_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model('services/M_services','services');
        }

        public function index(){
            $data['all_data'] = $this->services->get_data();
            $this->load->view('services/V_services',$data);
        }


        public function save(){
            $id_services = $this->input->post('id_services');
    
            if (empty($id_services)) {
                $this->add();
            } else {
                $this->update($id_services);
            }
        }

        private function add(){                
                $this->services->departement = $this->input->post('departement');
                $this->services->categorie = $this->input->post('categorie');
                $this->services->titre = $this->input->post('titre');
                $this->services->description = $this->input->post('description');
                $this->services->fichier = $this->input->post('fichier');
                // $this->services->photo = $this->input->post('photo');
                $this->services->publie = $this->input->post('publie');
                $this->services->etat = parse_etat_form($this->input->post('etat'));
                $this->services->code_annees = date('Y');
                $this->services->matricule = $_SESSION['matricule'];
                $this->services->date_creation = date('Y-m-d H:i:s');
                $config['upload_path']   = FCPATH . 'assets/upload/services'; 
                $config['allowed_types'] = 'gif|jpg|png|pdf|docx'; 
                // correction erreur 
                // $nameFichier=$_FILES["fichier"]['name'];
                $namePhoto=$_FILES["photo"]['name'];
                // $this->services->fichier = $nameFichier;
                $this->services->photo = $namePhoto;
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
           
        echo json_encode($this->services->add_services(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
        }

        private function update($id_services){
            $this->services->id_services = $this->input->post('id_services');
            $this->services->departement = $this->input->post('departement');
            $this->services->categorie = $this->input->post('categorie');
            $this->services->titre = $this->input->post('titre');
            $this->services->description = $this->input->post('description');
            $this->services->fichier = $this->input->post('fichier');
            // $this->services->photo = $this->input->post('photo');
            $this->services->publie = $this->input->post('publie');
            $this->services->etat = parse_etat_form($this->input->post('etat'));
            $this->services->code_annees = date('Y');
            $this->services->matricule = $_SESSION['matricule'];
            $this->services->date_creation = date('Y-m-d H:i:s');
            $config['upload_path']   = FCPATH . 'assets/upload/services'; 
            $config['allowed_types'] = 'gif|jpg|png|pdf|docx'; 
            // correction erreur 
            // $nameFichier=$_FILES["fichier"]['name'];
            $namePhoto=$_FILES["photo"]['name'];
            // $this->services->fichier = $nameFichier;
            $this->services->photo = $namePhoto;
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
       
            echo json_encode($this->services->update_services(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
        }

        public function get_record(){
            $args = func_get_args();
            $this->services->id_services=$args[0];
            $this->services->get_record();
            echo json_encode($this->services, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
        }

        public function delete(){
            $args = func_get_args();
            $this->services->id_services=$args[0];
            echo json_encode($this->services->fake_delete(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
        }
    }