<?php
namespace FB\groupeBundle\Controller;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of outils
 *
 * @author Administrateur
 */
class Outils {
    
    public static function paramDansURL($param,$url){
    $urlParcé=parse_url($url);
    $queryParts = explode('&', $urlParcé['query']); 
    
    foreach ($queryParts as $v_param) { 
        $item = explode('=', $v_param); 
        if($param==$item[0]) return $item[1];
    } 
    
}
}

?>
