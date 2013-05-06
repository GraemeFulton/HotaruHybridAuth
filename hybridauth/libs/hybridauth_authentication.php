<?php


class authentication { 

    function connectdb(){
     $db = new PDO('');//insert database details e.g  $db = new PDO('mysql:host=localhost;dbname=nameofdb;', 'username', 'password');
    
    return($db);
    }
	 
		
	function find_by_provider_uid($db, $provider, $provider_uid){
        $stmt = $db->query("SELECT * FROM hotaru_users WHERE user_hybridauth_provider='$provider' AND user_hybridauth_id='$provider_uid'");

	return $stmt->fetchAll();       
	}
        
          #3 - check for matching email
    function find_by_email( $db, $email ){
        
        $stmt = $db->query("SELECT * FROM hotaru_users WHERE user_email = '$email' LIMIT 1");
        
	return $stmt->fetchAll();       

    }
	
	
	   
    function createUser($db,
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
			
$p= md5($password);
			
		$stmt = $db->query("INSERT INTO hotaru_users (
					user_username,
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
                   ) 
                   VALUES ( 
				   '$display_name',
                   '$provider_uid',
                   '$provider',
                   '$first_name', 
                    '$last_name', 
                    '$email', 
                    '$display_name', 
                    '$website_url', 
                    '$profile_url', 
                    '$photo_url', 
                    '$description', 
                    '$birthday', 
                    '$country', 
                    '$region', 
                    '$city', 
                    '$phone', 
                    '$gender', 
                    '$birthyear', 
                    '$birthmonth', 
                    '$zip', 
                    '$password'
                       ) ");

		return $db->lastInsertId();
	}
	
	


		
}
?>
