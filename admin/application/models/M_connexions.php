<?php
class M_connexions extends CI_Model {

	public function test_connexion($matricule,$code_acces){
 
        if (ENVIRONMENT !== 'production')
        {$sql = "SELECT
            urs.*,
            pers_str.*,
            pr.*,
            str.*
            FROM sys_user urs
            INNER JOIN sys_type_profil pr ON(pr.id_type_profil = urs.id_profil)
            INNER JOIN personnel pers_str ON(pers_str.matricule = urs.matricule)
            INNER JOIN structure str ON(str.code_str = pers_str.code_str)
            WHERE urs.matricule = '".$matricule."' AND urs.code_acces = '".$code_acces."' " ;
        }
        else
        {
            $sql = "SELECT
            urs.*,
            pers_str.*,
            pr.*,
            str.*
            FROM sys_user urs
            INNER JOIN sys_type_profil pr ON(pr.id_type_profil = urs.id_profil)
            INNER JOIN personnel pers_str ON(pers_str.matricule = urs.matricule)
            INNER JOIN structure str ON(str.code_str = pers_str.code_str)
            WHERE urs.matricule = '".$matricule."' AND = '".$code_acces."' " ;
            }
        $query = $this->db->query($sql);
        return $query->row_array();

    }

    public function get_annees_encours(){
        $sql = "SELECT
        *
        FROM annees
        WHERE etat_annees = '1' ";

        $query = $this->db->query($sql);
        return $query->row_array();
    }

}
