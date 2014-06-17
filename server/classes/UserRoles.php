<?php

class UserRoles {
    
private static $Permissions = array(
    
    'edu_admins'            => array(
                                        'GET' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'POST' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'PUT' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'DELETE' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        ) , 
    'education_levels'      => array(
                                        'GET' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'POST' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'PUT' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'DELETE' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        ) ,  
    'municipalities'        => array(
                                        'GET' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'POST' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'PUT' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'DELETE' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        ) , 
    'prefectures'           => array(
                                        'GET' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'POST' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'PUT' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'DELETE' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        ) ,                  
    'region_edu_admins'     => array(
                                        'GET' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'POST' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'PUT' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'DELETE' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        ) , 
    'school_units'          => array(
                                        'GET' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'POST' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'PUT' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'DELETE' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        ) ,     
    'school_unit_types'     => array(
                                        'GET' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'POST' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'PUT' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'DELETE' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        ) , 
    'transfer_areas'        => array(
                                        'GET' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'POST' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'PUT' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'DELETE' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        ) , 
    'states'                => array(
                                        'GET' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'POST' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'PUT' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'DELETE' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        ) , 
    'school_unit_workers'   => array(
                                        'GET' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'POST' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'PUT' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'DELETE' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        ) , 
    'circuits'              => array(
                                        'GET' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'POST' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'PUT' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'DELETE' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        ) , 
    'circuit_types'         => array(
                                        'GET' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'POST' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'PUT' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'DELETE' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        ) , 
    'aquisition_sources'    => array(
                                        'GET' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'POST' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'PUT' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'DELETE' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        ) ,
    'worker_positions'      => array(
                                        'GET' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'POST' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'PUT' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'DELETE' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        ) ,
    'equipment_categories'  => array(
                                        'GET' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'POST' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'PUT' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'DELETE' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        ) ,
    'equipment_types'       => array(
                                        'GET' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'POST' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'PUT' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'DELETE' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        ) ,
    'labs'                  => array(
                                        'GET' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'POST' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'PUT' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'DELETE' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        ) ,
    'lab_aquisition_sources'=> array(
                                        'GET' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'POST' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'PUT' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'DELETE' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        ) ,
    'lab_equipment_types'   => array(
                                        'GET' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'POST' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'PUT' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'DELETE' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        ) ,
    'workers'               => array(
                                        'GET' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'POST' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'PUT' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'DELETE' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        ) ,
    'lab_types'             => array(
                                        'GET' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'POST' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'PUT' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'DELETE' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        ) ,
    'worker_specializations'=> array(
                                        'GET' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'POST' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'PUT' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'DELETE' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        ) ,
    'lab_relations'         => array(
                                        'GET' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'POST' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'PUT' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'DELETE' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        ) ,
    'relation_types'        => array(
                                        'GET' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'POST' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'PUT' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'DELETE' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        ) ,
    'lab_sources'           => array(
                                        'GET' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'POST' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'PUT' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'DELETE' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        ) ,
    'lab_transitions'       => array(
                                        'GET' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'POST' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'PUT' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'DELETE' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        ) ,
    'lab_workers'           => array(
                                        'GET' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'POST' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'PUT' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'DELETE' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        ) ,
    'search_school_units'   => array(
                                        'GET' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'POST' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'PUT' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'DELETE' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        ) ,
    'search_labs'           => array(
                                        'GET' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'POST' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'PUT' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'DELETE' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        ) ,
    'search_lab_workers'    => array(
                                        'GET' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'POST' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'PUT' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'DELETE' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        ) ,
    'statistic_school_units'=> array(
                                        'GET' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'POST' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'PUT' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'DELETE' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        ) ,
    'statistic_labs'        => array(
                                        'GET' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'POST' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'PUT' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'DELETE' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        ) ,
    'statistic_lab_workers' => array(
                                        'GET' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'POST' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'PUT' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        'DELETE' => array('ΠΡΟΣΩΠΙΚΟ ΠΣΔ'),
                                        ) ,
    );
    
    
 public static function checkUserRolePermissions($controller,$method,$user_role){

    if (array_key_exists($controller, UserRoles::$Permissions)) {
         if (in_array( $user_role , UserRoles::$Permissions[$controller][$method] ) ) {
             //return UserRoles::$Permissions[$controller][$method];
             return true;
         } else {
             throw new Exception(ExceptionMessages::UserNoPermissions, ExceptionCodes::UserNoPermissions);
         }
    }
    return false; 
}

}
?>