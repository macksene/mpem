<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 03/10/2017
 * Time: 12:48
 */

 //echo date_pasre_fr2en('15/10/2015');
//echo date_parse_en2fr('2010-11-10');

// dd/mm/yyyy ==> yyyy-mm-dd
function date_pasre_fr2en($date, $sep='/'){
	if($date == null || $date == '')
		return '';
	else
	{
		$dateConvert = $date == '' ? NULL : date('Y-m-d', strtotime(str_replace($sep, '-', $date)));
		return $dateConvert;
	}
}

// yyyy-mm-dd ==>  dd/mm/yyyy
function date_parse_en2fr($date){
    if($date == null || $date == '')
        return '';
    else
    {
        $new_date = date('d/m/Y',strtotime($date));
        return $new_date;
    }
}

function check_date($date){
	$date = str_replace(' ', "", $date);
	
	$date = str_replace('/', "-", $date);
	
	if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date))
	{
		return $date;
	} 
	else if (preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}$/",$date))
	{
		$separ = '-';
		return substr($date, 6, 4).$separ.substr($date, 3, 2).$separ.substr($date, 0, 2);
		
	}else
	{
		return NULL;
	}
}
function date_control_delay($date_debut, $date_fin){
    if(strtotime($date_debut) < strtotime($date_fin))
    {
        return 1;
    }
    elseif(strtotime($date_debut) == strtotime($date_fin))
    {
        return 0;
    }
    elseif(strtotime($date_debut) > strtotime($date_fin))
    {
        return -1;
    }
    else
    {
        return null;
    }
 }
 
 function validateDate($date, $format = 'Y-m-d'){
     $d = DateTime::createFromFormat($format, $date);
     // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
     return $d && $d->format($format) === $date;
 }
 




 function calcul_age($date){

    $datetime1 = new DateTime($date);
    $datetime2 = new DateTime(date('Y-m-d'));
    $interval = $datetime1->diff($datetime2);

//var_dump($interval);

    $days = $interval->format('%R%a days');

    $year = intval($days)/365;
    return $year;
}

function date_heure_parse_en2fr($date)
{
    if($date == null || $date == '')
        return '';
    else
    {
        $new_date = date('d/m/Y H:i:s',strtotime($date));
        return $new_date;
    }
}

function jr_en_fr($jour)
{
    switch($jour)
    {
        case 'Monday':
            return 'Lundi';
            break;

        case 'Tuesday':
            return 'Mardi';
            break;

        case 'Wednesday':
            return 'Mercredi';
            break;

        case 'Thursday':
            return 'Jeudi';
            break;

        case 'Friday':
            return 'Vendredi';
            break;

        case 'Saturday':
            return 'Samedi';
            break;

        case 'Sunday':
            return 'Dimanche';
            break;
    }
}

function mois_en_fr($mois)
{
    switch($mois)
    {
        case 'January':
            return 'Janvier';
            break;

        case 'February':
            return 'Février';
            break;

        case 'March':
            return 'Mars';
            break;

        case 'April':
            return 'Avril';
            break;

        case 'May':
            return 'Mai';
            break;

        case 'June':
            return 'Juin';
            break;

        case 'July':
            return 'Juillet';
            break;

        case 'August':
            return 'Aout';
            break;

        case 'September':
            return 'Septembre';
            break;

        case 'October':
            return 'Octobre';
            break;

        case 'November':
            return 'Novembre';
            break;

        case 'December':
            return 'Décembre';
            break;
    }
}

function en2fr($odldate = NULL, $separ = '-')
{
	if($odldate == NULL)
		return NULL;
	else
		//2019-08-24 13:06:52
		return substr($odldate, 8, 2).$separ.substr($odldate, 5, 2).$separ.substr($odldate, 0, 4);
}

//02-10-2013
function fr2en($odldate = NULL, $separ = '-')
{
	if($odldate == NULL)
		return NULL;
	else
		
		return substr($odldate, 6, 4).$separ.substr($odldate, 3, 2).$separ.substr($odldate, 0, 2);
}

//07:00:00 => 07:00
function h_m($hr)
{
    return substr($hr, 0, 5);
}


//02-10-2013
function en2lfr($olddate)
{
    $olddate = en2fr($olddate);
    $t_date = explode('-', $olddate);
    //var_dump($t_date);
    //exit();
    //$jour = jr_en_fr($j);
    $jour = jr_en_fr($t_date[0]);
    $mois	= mois_en_fr($t_date[1]);
    $jnum = $t_date[2];
    $an	= $t_date[3];

    return $jour.', '.$jnum.' '.strtolower($mois).' '.$an;
}

function lefafr($date)
{
    /* $t_date = explode('-', $date);
     $a =$t_date[0];
     $m =$t_date[1];
     $jr = substr($t_date[2], 0, 2); // affiche " jour "
     $h = substr($t_date[2], 3, 2); // affiche " heure "
     $min = substr($t_date[2], 6, 2); // affiche " minutes "
     $sec = substr($t_date[2], 9, 2); // affiche " seconde "
     setlocale(LC_TIME, 'fr_FR');
     return strftime("%a %d %b %Hh%M", mktime($h, $min, $sec, $m, $jr, $a));*/

    setlocale(LC_TIME, 'fr_FR.utf8','fr_FR.UTF-8');
    $date = strftime("%a %d %b %Hh%M",strtotime("$date"));
    return $date;
}
function lefafrh($date)
{
    /* $t_date = explode('-', $date);
     $a =$t_date[0];
     $m =$t_date[1];
     $jr = substr($t_date[2], 0, 2); // affiche " jour "
     $h = substr($t_date[2], 3, 2); // affiche " heure "
     $min = substr($t_date[2], 6, 2); // affiche " minutes "
     $sec = substr($t_date[2], 9, 2); // affiche " seconde "
     setlocale(LC_TIME, 'fr_FR');
     return strftime("%a %d %b %Hh%M", mktime($h, $min, $sec, $m, $jr, $a));*/

    setlocale(LC_TIME, 'fr_FR.utf8','fr_FR.UTF-8');
    $date = strftime("%A %d %B %Y",strtotime("$date"));
    return $date;
}

function lefafrmois($date)
{
    /* $t_date = explode('-', $date);
     $a =$t_date[0];
     $m =$t_date[1];
     $jr = substr($t_date[2], 0, 2); // affiche " jour "
     $h = substr($t_date[2], 3, 2); // affiche " heure "
     $min = substr($t_date[2], 6, 2); // affiche " minutes "
     $sec = substr($t_date[2], 9, 2); // affiche " seconde "
     setlocale(LC_TIME, 'fr_FR');
     return strftime("%a %d %b %Hh%M", mktime($h, $min, $sec, $m, $jr, $a));*/

    setlocale(LC_TIME, 'fr_FR.utf8','fr_FR.UTF-8');
    $date = strftime(" %B %Y",strtotime("$date"));
    return $date;
}

function lefafr1($date)
{
    /* $t_date = explode('-', $date);
     $a =$t_date[0];
     $m =$t_date[1];
     $jr = substr($t_date[2], 0, 2); // affiche " jour "
     $h = substr($t_date[2], 3, 2); // affiche " heure "
     $min = substr($t_date[2], 6, 2); // affiche " minutes "
     $sec = substr($t_date[2], 9, 2); // affiche " seconde "
     setlocale(LC_TIME, 'fr_FR');
     return strftime("%a %d %b %Hh%M", mktime($h, $min, $sec, $m, $jr, $a));*/

    setlocale(LC_TIME, 'fr_FR.utf8','fr_FR.UTF-8');
    $date = strftime("%a %d %b %G",strtotime("$date"));
    return $date;
}

