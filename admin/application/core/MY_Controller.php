<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->the_session_expired();
        date_default_timezone_set('UTC');
    }

    private function the_session_expired(){
        $tab_data_ses = $this->session->all_userdata();

        if ( !isset($tab_data_ses['matricule']) || empty($tab_data_ses['matricule']) || empty($tab_data_ses['prenom']) )
        {
            $this->session->sess_destroy();
            header("Location:".base_url());
            exit();
        }
        else
        {
            return 1;
        }
    }

}
