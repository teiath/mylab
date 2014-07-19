<?php
header("Content-Type: text/html; charset=utf-8");

class Reports {
    
    /**
     * Get edu admin with the worker edu_admin_code parameter
     * and find the primary and secondary education value.
     * Only secondary education edu admin code contains information about KEPLHNET.
     * 
     * Will return
     * stdClass Object
     * (
     *    [secondary] => "value"
     *    [counter] => "value"
     *    [primary] => "value"
     * )
     *
     * 
     * @param int $edu_admin_code the worker edu_admin_code
     * @return object
     */  
    public static function getKeplhnetfromEduAdminCode($edu_admin_code){
        global $db;
        $searchword = "Δ.Ε.";
         
        $sql = "SELECT edu_admin_id , name 
                FROM edu_admins
                WHERE edu_admins.edu_admin_code='".$edu_admin_code."'";
        $stmt = $db->query( $sql );
        $edu_admins = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (count($edu_admins)==2) {
         $data = new stdClass;
         foreach ($edu_admins as $edu_admin) {
             
            $eduAdminName = convert_greek_accents(trim($edu_admin['name']));
            $pos = mb_strpos($eduAdminName, $searchword, 0, 'UTF-8');
                 
            if($pos!==FALSE) {
            $data->secondary = $edu_admin['edu_admin_id'];
            $data->counter++;
            } else {
            $data->primary = $edu_admin['edu_admin_id'];
            $data->counter++;
            }
         }
        }

         return $data;
    }
  
    public static function getKeplhnetInfo($params) {     
        global $Options; 

        //make the http request to mmsch with cURL 
        $curl = curl_init($Options['Server_Mmsch']);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, $Options['Server_Mmsch_username'] . ":" . $Options['Server_Mmsch_password']);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode( $params ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $data = json_decode( curl_exec($curl), true );
    //
    //$data = curl_exec($curl);
    //$data = json_decode( $data );
    //
    //echo "<pre>"; var_dump($data ); echo "</pre>";die();

        return $data;

    }
    
    public static function Statistics($method, $keplinet , $filters  ) { 
    
        global $Options; 

        $params = array_merge($keplinet,$filters);

        //make the http request to mmsch with cURL 
        $curl = curl_init($Options['Server_MyLab'].$method);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, $Options['Server_MyLab_username'] . ":" . $Options['Server_MyLab_password']);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode( $params ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $data = json_decode( curl_exec($curl), true );

    //$data = curl_exec($curl);
    //$data = json_decode( $data );
    //
    //echo "<pre>"; var_dump($data ); echo "</pre>";die();

        return $data['total'];
    
    }
}

?>