<?php


class authentication { 
		
		
	/*
     * @param type $h
     * @return type: true/false
     */	
	public function social_check($h){
	 $sql = "SELECT user_id, user_hybridauth_provider FROM " . TABLE_USERS . " WHERE user_id = %s";
            $result = $h->db->get_row($h->db->prepare($sql, $h->currentUser->id));
	 if ($result->user_hybridauth_provider) {return true;}
	 else{return false;}
	}
		
		
    /*
     * @param type $h
     * @param type $provider
     * @param type $provider_uid
     * @return type 
     */
    function find_by_provider_uid($h, $provider, $provider_uid){
        $sql = "SELECT * FROM " . TABLE_USERS . " WHERE user_hybridauth_provider=%s AND user_hybridauth_id=%s";
        $query = $h->db->prepare($sql, $provider, $provider_uid);
                
	return $parents = $h->db->get_results($query);      
    }
	
	 /*
     * @param type $h
     * @param type $username
     * @return type 
     */
    function check_username($h, $username){
        $sql = "SELECT user_username FROM " . TABLE_USERS . " WHERE user_username=%s";
        $query = $h->db->prepare($sql, $username);
        
		return $uname = $h->db->get_results($query);	
    }
	
	
	
	    
    /**
     * check for matching email
     * @param type $h
     * @param type $db
     * @param type $email
     * @return type
     */
    function find_by_email($h, $email ){
        
        $sql = "SELECT * FROM " . TABLE_USERS . " WHERE user_email=%s LIMIT 1";
        $query = $h->db->prepare($sql, $email);
                
	return $parents = $h->db->get_results($query);;       
    }


    /**
     * check for user id
     * @param type $h
     * @param type $db
     * @param type $email
     * @return type
     */
    function get_user_id_by_provider_uid($h, $provider_uid ){
        
        $sql = "SELECT user_id FROM " . TABLE_USERS . " WHERE user_hybridauth_id =%s ";
        $query = $h->db->prepare($sql, $provider_uid);
                
	return $userId = $h->db->get_var($query);;       
    }
	
	
	
	 /**
     * check for username from identification number
     * @param type $h
     * @param type $db
     * @param type $email
     * @return type
     */
    function get_username_by_provider_uid($h, $provider_uid ){
        
        $sql = "SELECT user_username FROM " . TABLE_USERS . " WHERE user_hybridauth_id =%s ";
        $query = $h->db->prepare($sql, $provider_uid);
                
	return $userId = $h->db->get_var($query);;       
    }


	
	 /**
     * get username by email
     * @param type $h
     * @param type $db
     * @param type $email
     * @return type
     */
	 function get_username_by_email($h, $email){
        
        $sql = "SELECT user_username FROM " . TABLE_USERS . " WHERE user_email=%s LIMIT 1";
        $query = $h->db->prepare($sql, $email);
                
	return $username= $h->db->get_var($query);
    }
	
	   
    function createUser($h,
               $preferredname,
			   $provider_uid,
               $provider,
               $first_name,
               $last_name,
               $email,
               $display_name,
               $website_url,
               $profile_url,
               $photo_url,
               $description,
               $birthday,
               $country,
               $region,
               $city,
               $phone,
               $gender,
               $birthyear,
               $birthmonth,
               $zip,
               $password,
			   $hotaru_display_name,
			   $userip,
			   $permissions
            ){ 
		
       	
            $p= md5($password);
			
            $sql = "INSERT INTO " . TABLE_USERS . " (   user_username,
                                                        user_hybridauth_id,
                                                        user_hybridauth_provider,
                                                        user_hybridauth_fname,
                                                        user_hybridauth_lname,
                                                        user_email,
                                                        user_hybridauth_dname,
                                                        user_hybridauth_url,
                                                        user_hybridauth_profileurl,
                                                        user_hybridauth_photo,
                                                        user_hybridauth_desc,
                                                        user_hybridauth_bday,
                                                        user_hybridauth_country,
                                                        user_hybridauth_region,
                                                        user_hybridauth_city,
                                                        user_hybridauth_tel,
                                                        user_hybridauth_gender,
                                                        user_hybridauth_birthyear,
                                                        user_hybridauth_birthmonth,
                                                        user_hybridauth_zip,
                                                        user_password,
														user_hotaru_display_name,
														user_ip,
														user_permissions,
														user_date
                                                    ) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, CURRENT_TIMESTAMP)";
            $h->db->query($h->db->prepare($sql, $preferredname,
                                                $provider_uid,
                                                $provider,
                                                $first_name,
                                                $last_name,
                                                $email,
                                                $display_name, 
                                                $website_url, 
                                                $profile_url, 
                                                $photo_url, 
                                                $description, 
                                                $birthday, 
                                                $country, 
                                                $region, 
                                                $city, 
                                                $phone, 
                                                $gender, 
                                                $birthyear, 
                                                $birthmonth, 
                                                $zip, 
                                                $password,
												$hotaru_display_name,
												$userip,
												serialize($permissions)
                                        ));
            
                $h->messages['User Created'] = "green";
				
                $last_insert_id = $h->db->get_var($h->db->prepare("SELECT LAST_INSERT_ID()"));
                
		return $last_insert_id;
	}
	
	


		
}
?>
