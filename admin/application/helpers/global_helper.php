<?php

function btn_add_action($smenu_code){
	$instance = get_instance();
	$tab_smrole = $instance->session->smenu_roles;
	if ($tab_smrole[$smenu_code]['d_add'] == 1 and $instance->session->annee_en_cours == $instance->session->annee_travail) {
		echo <<<END
	<div class="col-md-6 d-flex gap-1 align-items-center mb-3">
		<button id="btn_add" class="btn btn-light hstack gap-2 align-self-center">
				<i class="demo-psi-add fs-5"></i>
				<span class="vr"></span>
				Nouveau
		</button>

	</div>
	END;
	}
}

function btn_edit_action($id, $smenu_code){
	$instance = get_instance();
	$tab_smrole = $instance->session->smenu_roles;
	if ($tab_smrole[$smenu_code]['d_upd'] == 1 and $instance->session->annee_en_cours == $instance->session->annee_travail) {
		echo <<<END
	<button class="on-default btn_edit btn btn-icon btn-sm btn-light" id="$id">
		<i class="demo-pli-pencil fs-5" />
	</button>

	END;
	}
}

function btn_edit_module($id, $smenu_code){
	$instance = get_instance();
	$tab_smrole = $instance->session->smenu_roles;
	if ($tab_smrole[$smenu_code]['d_upd'] == 1 and $instance->session->annee_en_cours == $instance->session->annee_travail) {
		echo <<<END
	<button class="on-default btn_edit btn btn-icon btn-secondary" id="$id">
		<i class="demo-pli-pencil fs-5" />
	</button>
	END;
	}
}

function btn_delete_action($id, $smenu_code){
	$instance = get_instance();
	$tab_smrole = $instance->session->smenu_roles;
	if ($tab_smrole[$smenu_code]['d_del'] == 1 and $instance->session->annee_en_cours == $instance->session->annee_travail) {
		echo <<<END
	<button class="on-default btn_delete btn btn-icon btn-sm btn-light" id="$id">
			<i class="demo-pli-trash fs-5" />
	</button>&nbsp
	END;
	}
}

function btn_show_action($id, $smenu_code){
	$instance = get_instance();
	$tab_smrole = $instance->session->smenu_roles;
	if ($tab_smrole[$smenu_code]['d_upd'] == 1) {
		echo <<<END
	<button class="on-default btn_delete btn btn-icon btn-sm btn-light" id="$id">
			<i class="demo-pli-trash fs-5" />
	</button>&nbsp
	END;
	}
}

/*
* Gestion des roles sans le data-table
*/

function add_role($smenu_code, $contenu){
	$tab_smrole = $_SESSION['smenu_roles'];
	if (isset($tab_smrole[$smenu_code]['d_add'])) {
		echo $contenu;
	}
}

function del_role($smenu_code, $contenu){
	$tab_smrole = $_SESSION['smenu_roles'];
	if (isset($tab_smrole[$smenu_code]['d_del'])) {
		echo $contenu;
	}
}

function upd_role($smenu_code, $contenu){
	$tab_smrole = $_SESSION['smenu_roles'];
	if (isset($tab_smrole[$smenu_code]['d_upd'])) {
		echo $contenu;
	}
}

function read_role($smenu_code, $contenu){
	$tab_smrole = $_SESSION['smenu_roles'];
	if (isset($tab_smrole[$smenu_code]['d_read'])) {
		echo $contenu;
	}
}

function del_accent($str, $encoding = 'iso-8859-1'){
	$str = htmlentities($str, ENT_NOQUOTES, $encoding);
	$str = preg_replace('#&([A-za-z])(?:acute|grave|cedil|circ|orn|ring|slash|th|tilde|uml);#', '\1', $str);
	$str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // Supprimer tout le reste
	$str = preg_replace('#&[^;]+;#', '', $str);

	return $str;
}

//Focntion de decoupage de texte en nombre de mots
function nbmot($text, $limit){
	$text = strip_tags($text);
	$words = str_word_count($text, 2, '&-');
	$pos = array_keys($words);
	if (count($words) > $limit) {
		$text = substr($text, 0, $pos[$limit]);
	}
	return $text;
}

function btn_details($id, $smenu_code){
	$instance = get_instance();
	$tab_smrole = $instance->session->smenu_roles;

	if ($tab_smrole[$smenu_code]['d_upd'] == 1) {
		echo <<<END
	<a href="' . site_url('etablissements/C_etab/lstetabpol/') . $id . '" class="on-default btn_detail menu"  id="$id">
		<span class="label label-info">Details</span>
	</a>
	END;
	}
}

/**
 * Display a form block for handling `Etat`
 *
 * @param string $label 	The label to display in the form
 * @param string $id 		The `id` to display on the `name` & `id` attribute for the input
 * @return string
 */
function section_etat_form($label = "Etat", $id){
	return <<<END
	<hr class="mt-4" />
	<div class="col-md-12">
		<div class="d-flex justify-content-between">
			<label class="form-check-label h5 mb-0" for="$id">$label</label>
			<div class="form-check form-switch">
				<input name="$id" id="$id" class="form-check-input" type="checkbox" checked>
			</div>
		</div>
		<span>Actif par defaut.</span>
	</div>
	END;
}

/**
 * Parse the `etat` coming from the input form
 *
 * @param string $value Either `on` or `NULL`
 * @return string
 */
function parse_etat_form($value){
	if (is_null($value)) return '-1';
	else return '1';
}

/**
 * Display a badge depending on the state
 *
 * @param int $etat Either '1' or '-1' or '0'
 * @return string
 */
function badge_etat($etat){
	if ($etat > 0) {
		return '<span class="d-inline-block bg-success rounded-circle p-1 me-2"></span>';
	} else if ($etat == 0) {
		return '<span class="d-inline-block bg-warning rounded-circle p-1 me-2">';
	} else {
		return '</span><span class="d-inline-block bg-info rounded-circle p-1 me-2"></span>';
	}
}

// PERF: not used in the project
function btn_etat($etat, $smenu_code){
	if ($etat == 0) {
		# code...
		echo '<span class="on-default btn_active" etat="' . $etat . '" style=""><i class="fa fa-spinner fa-pulse fa-2x fa-fw" style="color:#2c3e50;"></i>En Attente</span>';
	} elseif ($etat == 1) {
		echo '<span class="on-default btn_active" etat="' . $etat . '">En Cours<i class="fa fa-cog fa-spin fa-2x fa-fw" style="color:gray"></i></span>';
	} elseif ($etat == 2) {
		echo '<span class="on-default btn_active" etat="' . $etat . '"><i class="fa fa-on fa-check-square" style="color:#2ed573">Résolu</i></span>';
	} else {
		echo '<span class="on-default btn_default" etat="' . $etat . '"><i class="fa fa-ban fa-fw" style="color:#ff665f">Impossible</i></span>';
	}
}

function edit($id, $etat, $smenu_code){
	if ($etat == 0) {
		echo '<a href="#" class="on-default edit"
           id="' . $id . '" style="color:#ff6b81; border:1px solid; border-radius:12%"><i class="fa fa-cogs"></i>Traiter</a>';
	} elseif ($etat == 1) {
		echo '<a href="#" class="on-default edit"
           id="' . $id . '" style="color:#; border-left:1px solid;border-right:1px solid; border-radius:35%;"><i class="fa fa-eye"></i>Voir...</a>';
	} elseif ($etat == 2) {
		echo '<a href="#" class="on-default edit"
           id="' . $id . '" style="color:#2f3542; border-top:1px solid;border-bottom:1px solid; border-radius:19%"><i class="fa fa-envelope-o fa-fw"></i>Message</a>';
	}
}

function btn_editt($id, $smenu_code){
	echo '<a href="#" class="on-default btn_editt"
           id="' . $id . '" style="color:#ff4757"><i class="fa fa-cogs"></i>Traiter</a>';
}

function btn_show_list_action($id, $smenu_code){
	echo '<a href="#" class="on-default btn_show_list"
           id="' . $id . '"><i class="fa fa-eye" style="color:#3c6382"></i></a>';
}

function btn_affecter_list_action($id, $smenu_code){
	echo '<a href="#" class="on-default btn_affecter_list"
           id="' . $id . '"><i class="label label-info" style="color:#3c6382"></i></a>';
}

function send($id, $id_trt, $smenu_code){
	echo  '<a href="#" class="on-default btn_affect"  id="' . $id . '" id_trt ="' . $id_trt . '" >
           <span class="label label-info"><i class="fa fa-paper-plane-o m-r-5"></i>Sent Mail</span> </a>';
}

// function affecter($id, $smenu_code){
// 	$instance = get_instance();
// 	$tab_smrole = $instance->session->smenu_roles;
// 	if ($tab_smrole[$smenu_code]['d_upd'] == 1 and $instance->session->annee_en_cours == $instance->session->annee_travail) {
// 		echo ' <a href="#" class="on-default btn_affect" id="' . $id . '">
//             <span class="label label-info">Affecter</span> </a>';
// 	}
// }

function btn_archive_action($id, $smenu_code, $etat = ""){
	$instance = get_instance();
	$tab_smrole = $instance->session->smenu_roles;
	if ($tab_smrole[$smenu_code]['d_upd'] == 1 and $instance->session->annee_en_cours == $instance->session->annee_travail) {
		if ($etat == 1) {
			# code...
			echo '<a href="#" class="on-default btn_archive"
           id="' . $id . '" etat="' . $etat . '"><i class="fa fa-toggle-on" style="color:#2ed573"></i></a>';
		} else {
			echo '<a href="#" class="on-default btn_archive"
           id="' . $id . '" etat="' . $etat . '"><i class="fa fa-toggle-off" style="color:#ff4757"></i></a>';
		}
	}
}

function btn_etat_active($etat){
	echo '<span href="#" class="on-default btn_active"
           ><i class="fa fa-toggle-on" style="color:#2ed573"></i></span>';
}

function btn_etat_inactive($etat){
	echo '<span href="#" class="on-default btn_inactive"
           ><i class="fa fa-toggle-off" style="color:#ff4757"></i></span>';
}

function format_date($value){
	if ($value == NULL)
		return '';
	else
		return date('d/m/Y', strtotime($value));
}



// function infocom($matricule){
// 	$arrContextOptions = array(
// 		"ssl" => array(
// 			"verify_peer" => false,
// 			"verify_peer_name" => false
// 		),
// 	);
// 	@$infos = file_get_contents("https://apps.education.sn/C_personnel_api/getmatricule_info_all?matricule=" . $matricule, false, stream_context_create($arrContextOptions));
// 	$infos = json_decode($infos, true);
// 	$infos = $infos["record"];
// 	$prenom = $infos["prenom"];
// 	$nom = $infos["nom"];
// 	$data["pren"] = $prenom . " " . $nom;
// 	@$photo = file_get_contents("https://apps.education.sn/C_personnel_api/get_pic_src/" . $matricule, false, stream_context_create($arrContextOptions));
// 	$data["photo"] = $photo;
// 	$lmatricule = "matricule-get/structure_by_code_admin?code=" . $infos["code_str"];
// 	$base = "codeco";
// 	$co_str = apiGetData($base, $lmatricule, $type = 'array');
// 	$co_str = $co_str["resultat"];
// 	$data["structure"] = $co_str["libelle_structure"];

// 	return $data;
// }

// function info_conn($matricule, $smenu_code){
// 	$instance = get_instance();
// 	$tab_smrole = $instance->session->smenu_roles;
// 	if ($tab_smrole[$smenu_code]['d_upd'] == 1) {
// 		echo ' <a href="#" class="on-default info_conn" id="' . $matricule . '">
//             <span class="label label-info">Send infos</span> </a>';
// 	}
// }

/*
* @$table: 		Tableau dans lequel on fait la recherche
* @$to_find: 	Param�tre de recherche
* @$colonne:  	Colonne sur le sous tableaux
* @$cle:		La colonne du tableau associatif
*/

function multi_array_search($tableau, $valeurConnue, $colonneValeurConnue, $colonneValeurRecherchee){
	if (!empty($tableau)) {
		$tableau = json_decode(json_encode($tableau), true);
		//return array_search($valeurConnue, array_column($tableau, $colonneValeurConnue));
		if (array_search($valeurConnue, array_column($tableau, $colonneValeurConnue)) !== false) {
			$val = $tableau[array_search($valeurConnue, array_column($tableau, $colonneValeurConnue))][$colonneValeurRecherchee];
			return $val;
		} else {
			return false;
		}
	} else {
		return false;
	}
}

function utf8_converter($array){
	array_walk_recursive($array, function ($item, $key) {
		if (!mb_detect_encoding($item, 'utf-8', true)) {
			$item = utf8_encode($item);
		}
	});

	return $array;
}

//Transposer tableau
function array_swap($tab, $id, $valeur){
	$t_swap = array();
	$tab 	= json_decode(json_encode($tab));

	foreach ($tab as $val) {
		$t_swap['id' . $val->$id] = $val->$valeur;
	}

	return $t_swap;
}

function Genere_Password(){
	// Initialisation des caractères utilisables
	do {
		$characters = array("a", "b", "c", "d", "e", "f", "g", "h", "j", "k", "m", "n", "p", "q", "r", "t", "u", "v", "w", "x", "y", "z", 2, 3, 4, 6, 7, 8, 9);
		$carate = array(2, 3, 4, 6, 7, 8, 9);

		$password = $carate[array_rand($carate)];

		for ($i = 0; $i < 6; $i++) {
			$password .= ($i % 2) ? strtoupper($characters[array_rand($characters)]) : $characters[array_rand($characters)];
		}

		$new_password = str_split($password);
		$premier_car = $new_password[0];
		$deuxiem_car = $new_password[1];
		$troisiem_car = $new_password[2];
		$tupl = 0;
		$cinquiem_car = $new_password[3];
		$sixieme_car = $new_password[4];
		$septiem_car = $new_password[5];
		$huitiem_car = $new_password[6];

		for ($i = 0; $i < 6; $i++) {
			$tupl = $tupl + intval($new_password[$i]);
		}
	} while ($tupl == 0);
	$quatriem_car = ($tupl < 22) ? $characters[$tupl - 1] : "z";

	$matricule_array = array(
		"premier_car" => $premier_car,
		"deuxiem_car" => $deuxiem_car,
		"troisiem_car" => $troisiem_car,
		"quatriem_car" => $quatriem_car,
		"cinquiem_car" => $cinquiem_car,
		"sixieme_car" => $sixieme_car,
		"septiem_car" => $septiem_car,
		"huitiem_car" => $huitiem_car
	);
	$data["tupl"] = $tupl;
	$data["tab_matricule"] = $matricule_array;
	$data["matricule"] = strtoupper(implode($matricule_array));
	return $data;

	// return;
}

function verif_algo_matricule($matricule){
	$characters = array("a", "b", "c", "d", "e", "f", "g", "h", "j", "k", "m", "n", "p", "q", "r", "t", "u", "v", "w", "x", "y", "z", 2, 3, 4, 6, 7, 8, 9);
	$tupl = 0;
	$matricule_array = str_split($matricule);
	for ($i = 0; $i < 7; $i++) {
		$tupl = $tupl + intval($matricule_array[$i]);
	}
	$quatriem_car = $matricule_array[3];
	$verif = $characters[$tupl - 1];
	if (strtoupper($verif) == strtoupper($quatriem_car) and is_numeric($matricule_array[0]) == true) {
		$d = array("code" => "0", "status" => "succes", "message" => "matricule Valide");
		//echo json_encode($d, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
		return $d;
	} else {
		$d = array("code" => "1", "status" => "error", "message" => "Mauvais matricule");
		// echo json_encode($d, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
		return $d;
	}
}

function format_json($result, $message){
	$code = "1";
	$array = array(
		'code' => $code,
		"message" => $message
	);
	if (count($result) > 0) {
		$code = "0";
		$message = "success";
		$array = array(
			'code' => $code,
			"message" => $message,
			"records" => $result
		);
	}


	return $array;
}

function send_all($table){
	$db = get_instance();
	loadModel($table);
	if ($table == "categorie_structure") {
		$result = $db->table->get_data();
	} elseif ($table == "fonction") {
		$result = $db->table->get_functions();
	} else {
		$result = $db->table->get_active_data();
	}

	echo json_encode(format_json($result, 'pas de fonction ' . $table));
}

function get_api_data($url, $records = "records"){
	$result = array();
	$data = json_decode(remove_utf8_bom(file_get_contents($url)), true);

	foreach ($data as $param => $value) {
		$result = $value;
	}
	return $result;
}

function remove_utf8_bom($text){
	$bom = pack('H*', 'EFBBBF');
	$text = preg_replace("/^$bom/", '', $text);
	return $text;
}

function format_file_name($localite, $id){
	$file_name = 'download/data/' . md5($localite . '_' . $id) . '.json';
	return $file_name;
}

function get_json_data($struct, $id_ief, $label){
	$filename = format_file_name($struct, $id_ief);
	if (!file_exists($filename) or date_to_modif($filename)) {
		$tab = get_api_data(url_api_list($struct, $id_ief), $records = $label);
		$tab = json_encode($tab);
		@file_put_contents($filename, $tab);
	}
	return file_get_contents($filename);
}

function date_to_modif($filename){
	return (time() - filemtime($filename)) > 60 * 60 * 24 * 7;
}

function create_select_list($data, $key, $label, $default_value=null,$chained_attr=null){
    if (!is_array($data) && !is_object($data)) {
        return '<option value=""></option>';
    }
    $pulldown_list = '<option value=""></option>';
    foreach ($data as $value)
    {
        $selected = '';
        $chained='';
        if($default_value ==  $value->$key && $default_value != null)
            $selected = 'selected';
        
        if($chained_attr != null && isset($value->$chained_attr ))
            $chained='class="'.$value->$chained_attr.'"';
        else if($chained_attr != null && !isset($value->$chained_attr ))  
            $chained='class="-1234"';
        
        $pulldown_list .= '<option '.$selected.'  value="' . $value->$key . '" '.$chained.' >' . $value->$label . '</option>';
    }
    return $pulldown_list;
}