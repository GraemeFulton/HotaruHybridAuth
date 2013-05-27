<?php

 $username=$_POST["username"];
 
 require_once('../../../../hotaru_settings.php');
		require_once('../../../../Hotaru.php');    // Not the cleanest way of getting to the root...		
		$h = new Hotaru();
		$h->start();
		
		check_username($h, $username);


	 /*
     * @param type $h
     * @param type $username
     * @return type 
     */
    function check_username($h, $username){
        $sql = "SELECT user_username FROM " . TABLE_USERS . " WHERE user_username=%s";
        $query = $h->db->prepare($sql, $username);
        
		$uname = $h->db->get_results($query);      

		echo $uname;
 

  
    }



?>