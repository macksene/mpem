<?php
class C_connexions extends CI_Controller{
	public function __construct(){
		parent::__construct();
		//initialisation de la session
		$this->load->model('M_connexions', 'conn');
		$this->load->model('sys/M_sys_role', 'role');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->library('javascript');
		$this->load->model('sys/M_sys_user', 'user');
		$this->load->model('parametres/M_annees', 'an');
	}

	public function authentication(){
		$suite_req = site_url();
		$matricule 	   = $this->input->post('matricule');
		$passe 	   = $this->input->post('passe');
		$data['an_encours']      = $this->conn->get_annees_encours();
	
		// if (strlen(trim($matricule)) > 8) {
		// 	$info = file_get_contents("http://apps.education.sn/matricule-structure/" . trim($matricule));
		// 	$infos = json_decode($info, true);
		// 	if ($infos["code"] == 1 or $info == false) {
		// 		$this->noconn($matricule, $suite_req);
		// 		exit();
		// 	} else {
		// 		$matricule = $infos["matricule"];
		// 	}
		// }

		$data['connexions_data'] = $this->conn->test_connexion($matricule, $passe);
	
		if (empty($data['connexions_data'])) {
			$this->noconn($matricule, $suite_req);
		}

		$datas_user = array(
			'matricule'		 => $matricule,
			'id'		 =>  $data['connexions_data']['id'],
			'prenom'    => $data['connexions_data']['prenom'],
			'nom'    => $data['connexions_data']['nom'],
			'id_profil'	 => $data['connexions_data']['id_profil'],
			'profil'	 => $data['connexions_data']['libelle_type_profil'],
			'email_pro'  => $data['connexions_data']['email_pro'],
			'code_str_session'   => $data['connexions_data']['code_str'],
			'libelle_str' => $data['connexions_data']['libelle'],
			'code_annees'  => $data['an_encours']['code_annees'],
			'logged_in'  => TRUE
		);
		$id_profil 	= $data['connexions_data']['id_profil'];

		$tab_mrole	= array();   ///Tableau des roles des menus
		$tab_smrole	= array();  ///Tableau des roles des sous menus
		$cur_menu	= '';

		$tab_role	= $this->role->get_conn_roles($id_profil);

		foreach ($tab_role as $val) {
			///Tableau des droits sur les menus
			if ($cur_menu != $val->mcode) {
				$tab_mrole[$val->mcode] = 1;
				$cur_menu = $val->mcode;
			}

			//Tableau des droits sur les sous menus
			//On ne recup�re que les valeurs positives
			if ($val->d_read == 1) {
				$tab_smrole[$val->smcode]['d_read'] = $val->d_read;
			}
			if ($val->d_add == 1) {
				$tab_smrole[$val->smcode]['d_add']	= $val->d_add;
			}
			if ($val->d_upd == 1) {
				$tab_smrole[$val->smcode]['d_upd']	= $val->d_upd;
			}
			if ($val->d_del == 1) {
				$tab_smrole[$val->smcode]['d_del']	= $val->d_del;
			}
		}

		///Chargement des donn�es de la tableau $data
		$data['menu_roles']		= $tab_mrole;
		$data['smenu_roles']	= $tab_smrole;


		$this->session->set_userdata('menu_roles', $data['menu_roles']);
		$this->session->set_userdata('smenu_roles', $data['smenu_roles']);
		$this->session->set_userdata($datas_user);

		//@$photo = file_get_contents("http://apps.education.sn/C_personnel_api/get_pic_src/" . $matricule);
		if ($photo != FALSE) {
			$this->session->set_userdata('photo', base_url() . 'assets/img/profile-photos/4.png');
		} else {
			$this->session->set_userdata('photo', base_url() . 'assets/img/profile-photos/4.png');
		}

		header("Location:" . $suite_req . "dashboard");
	}

	//redefinition de Dashbord
	public function home(){
		$tab_data_ses = $this->session->all_userdata();

		if (!isset($tab_data_ses['matricule']) || empty($tab_data_ses['code_str_session']) || empty($tab_data_ses['prenom'])) {
			$this->session->sess_destroy();
			header("Location:" . site_url() . "sign-in?erreur=login");
			exit();
		} else {
			$this->load->view('template/layout');
		}
	}

	//se_deconnecter
	public function noconn($matricule, $suite_req){
		$the_data = array(
			'ip' 			=> $_SERVER['REMOTE_ADDR'],
			'navigateur' 	=> $_SERVER['HTTP_USER_AGENT'],
			'login' 		=> str_replace("'", "", $matricule)
		);
		//on log les erreurs
		header("Location:" . $suite_req . "sign-in?erreur=login");
	}

	public function se_deconnecter(){
		$suite_req = site_url();
		$this->session->sess_destroy();	// destruction des donnees de la session
		header("Location:" . $suite_req . "sign-in");
	}

	
}
