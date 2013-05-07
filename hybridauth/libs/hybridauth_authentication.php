<?php


class authentication { 

//    function connectdb(){
//     $db = new PDO('');//insert database details e.g  $db = new PDO('mysql:host=localhost;dbname=nameofdb;', 'username', 'password');
//    
//    return($db);
//    }
	 
		
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
	
	
	   
    function createUser($h,
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
               $password
            ){ 
		
            // set password
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
                                                        user_password
                                                    ) VALUES (%s, %s, %s, %d)";
            $h->db->query($h->db->prepare($sql, $display_name,
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
                                                $password
                                        ));
            
                $h->messages['User Created'] = "green";

                $last_insert_id = $h->db->get_var($h->db->prepare("SELECT LAST_INSERT_ID()"));
                
		return $last_insert_id;
	}
	
	


		
}
?>
