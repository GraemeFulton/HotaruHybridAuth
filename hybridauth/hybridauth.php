<?php
/**
 * name: HybridAuth
 * description: Enables registration and login with Twitter, Facebook ,Google, etc.
 * version: 0.1
 * folder: hybridauth
 * class: Hybridauth
 * hooks: install_plugin, theme_index_top, header_include, pre_close_body, user_signin_login_pre_login_form, userbase_logincheck, user_signin_register_pre_register_form, user_signin_register_password_check, user_signin_register_post_add_user, admin_sidebar_plugin_settings, admin_plugin_settings, users_account_pre_password_user_only, userbase_delete_user, user_signin_register_error_check, user_signin_navigation_logged_out
 * requires: users 1.1, user_signin 0.1
 * author: Graeme Fulton
 * authorurl: http://www.gfulton.me.uk
 *
 * PHP version 5
 *
 * LICENSE: Hotaru CMS is free software: you can redistribute it and/or 
 * modify it under the terms of the GNU General Public License as 
 * published by the Free Software Foundation, either version 3 of 
 * the License, or (at your option) any later version. 
 *
 * Hotaru CMS is distributed in the hope that it will be useful, but WITHOUT 
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or 
 * FITNESS FOR A PARTICULAR PURPOSE. 
 *
 * You should have received a copy of the GNU General Public License along 
 * with Hotaru CMS. If not, see http://www.gnu.org/licenses/.
 * 
 * @category  Content Management System
 * @package   HotaruCMS
 * @author    Nick Ramsay <admin@hotarucms.org>
 * @copyright Copyright (c) 2009, Hotaru CMS
 * @license   http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link      http://www.hotarucms.org/
 */


class Hybridauth
{
    /* Note: Plugin classes are recreated every time a plugin hook is triggered. So if you want 
       persistent class properties, assign them to the $h object and reassign them to their
       properties in the constructor. */
	   
	   //copied these from RPX plugin, don't think I use any of them

 
    protected $provider  = "";
    protected $prefname       = "";
	protected $tokenUrl     = "";
    protected $language     = "en";
    protected $account       = "basic";
    protected $display       = "embed";


    /**
     * Build an object containing $db and $cage ---ok
     */
    public function __construct($h)
    {    	

        $hybridauth_settings = $h->getSerializedSettings('hybridauth');
    }
    
    /**
     * Access modifier to set protected properties
     */
    public function __set($var, $val)
    {
        $this->$var = $val;
    }
    
    
    /**
     * Access modifier to get protected properties
     */
    public function __get($var)
    {
        return $this->$var;
    }


    /**
     * Install RPX
     */
    public function install_plugin($h)
    {
	//this is just a bunch of extra columns to add in the database to store info about users collected from their social logins...
	//It could probably all be done in one statement..
	
        if (!$h->db->column_exists('users', 'user_hybridauth_id')) {
            // add new user_hybridauth_id field
            $sql = "ALTER TABLE " . TABLE_USERS . " ADD user_hybridauth_id VARCHAR(128) AFTER user_date";
            $h->db->query($h->db->prepare($sql));
        }
        
        if (!$h->db->column_exists('users', 'user_hybridauth_provider')) {
            // add new user_hybridauth_provider field
            $sql = "ALTER TABLE " . TABLE_USERS . " ADD user_hybridauth_provider VARCHAR(128) AFTER user_hybridauth_id";
            $h->db->query($h->db->prepare($sql));
        }
		
		       //fname
          if (!$h->db->column_exists('users', 'user_hybridauth_fname')) {
            // add new user_hybridauth_provider field
            $sql = "ALTER TABLE " . TABLE_USERS . " ADD user_hybridauth_fname VARCHAR(128) AFTER user_hybridauth_id";
            $h->db->query($h->db->prepare($sql));
        }
        
        //lastname
         if (!$h->db->column_exists('users', 'user_hybridauth_lname')) {
            // add new user_hybridauth_provider field
            $sql = "ALTER TABLE " . TABLE_USERS . " ADD user_hybridauth_lname VARCHAR(128) AFTER user_hybridauth_id";
            $h->db->query($h->db->prepare($sql));
        }
       //displayname
         if (!$h->db->column_exists('users', 'user_hybridauth_dname')) {
            // add new user_hybridauth_provider field
            $sql = "ALTER TABLE " . TABLE_USERS . " ADD user_hybridauth_dname VARCHAR(128) AFTER user_hybridauth_id";
            $h->db->query($h->db->prepare($sql));
        }
        //websiteurl
         if (!$h->db->column_exists('users', 'user_hybridauth_url')) {
            // add new user_hybridauth_provider field
            $sql = "ALTER TABLE " . TABLE_USERS . " ADD user_hybridauth_url VARCHAR(128) AFTER user_hybridauth_id";
            $h->db->query($h->db->prepare($sql));
        }
         //profileurl
         if (!$h->db->column_exists('users', 'user_hybridauth_profileurl')) {
            // add new user_hybridauth_provider field
            $sql = "ALTER TABLE " . TABLE_USERS . " ADD user_hybridauth_profileurl VARCHAR(128) AFTER user_hybridauth_id";
            $h->db->query($h->db->prepare($sql));
        }
        //photoURL
         if (!$h->db->column_exists('users', 'user_hybridauth_photo')) {
            // add new user_hybridauth_provider field
            $sql = "ALTER TABLE " . TABLE_USERS . " ADD user_hybridauth_photo VARCHAR(128) AFTER user_hybridauth_id";
            $h->db->query($h->db->prepare($sql));
        }
        
        //description
         if (!$h->db->column_exists('users', 'user_hybridauth_desc')) {
            // add new user_hybridauth_provider field
            $sql = "ALTER TABLE " . TABLE_USERS . " ADD user_hybridauth_desc TEXT NULL AFTER user_hybridauth_id";
            $h->db->query($h->db->prepare($sql));
        }
        
        //bday
         if (!$h->db->column_exists('users', 'user_hybridauth_bday')) {
            // add new user_hybridauth_provider field
            $sql = "ALTER TABLE " . TABLE_USERS . " ADD user_hybridauth_bday VARCHAR(128) AFTER user_hybridauth_id";
            $h->db->query($h->db->prepare($sql));
        }
        
        //country
         if (!$h->db->column_exists('users', 'user_hybridauth_country')) {
            // add new user_hybridauth_provider field
            $sql = "ALTER TABLE " . TABLE_USERS . " ADD user_hybridauth_country VARCHAR(128) AFTER user_hybridauth_id";
            $h->db->query($h->db->prepare($sql));
        }
        //region
         if (!$h->db->column_exists('users', 'user_hybridauth_region')) {
            // add new user_hybridauth_provider field
            $sql = "ALTER TABLE " . TABLE_USERS . " ADD user_hybridauth_region VARCHAR(128) AFTER user_hybridauth_id";
            $h->db->query($h->db->prepare($sql));
        }
        //city
         if (!$h->db->column_exists('users', 'user_hybridauth_city')) {
            // add new user_hybridauth_provider field
            $sql = "ALTER TABLE " . TABLE_USERS . " ADD user_hybridauth_city VARCHAR(128) AFTER user_hybridauth_id";
            $h->db->query($h->db->prepare($sql));
        }
         //phone
         if (!$h->db->column_exists('users', 'user_hybridauth_tel')) {
            // add new user_hybridauth_provider field
            $sql = "ALTER TABLE " . TABLE_USERS . " ADD user_hybridauth_tel VARCHAR(128) AFTER user_hybridauth_id";
            $h->db->query($h->db->prepare($sql));
        }
        //gender
         if (!$h->db->column_exists('users', 'user_hybridauth_gender')) {
            // add new user_hybridauth_provider field
            $sql = "ALTER TABLE " . TABLE_USERS . " ADD user_hybridauth_gender VARCHAR(10) AFTER user_hybridauth_id";
            $h->db->query($h->db->prepare($sql));
        }
        //birthyear
           if (!$h->db->column_exists('users', 'user_hybridauth_birthyear')) {
            // add new user_hybridauth_provider field
            $sql = "ALTER TABLE " . TABLE_USERS . " ADD user_hybridauth_birthyear VARCHAR(50) AFTER user_hybridauth_id";
            $h->db->query($h->db->prepare($sql));
        }
        //birthmonth
             if (!$h->db->column_exists('users', 'user_hybridauth_birthmonth')) {
            // add new user_hybridauth_provider field
            $sql = "ALTER TABLE " . TABLE_USERS . " ADD user_hybridauth_birthmonth VARCHAR(50) AFTER user_hybridauth_id";
            $h->db->query($h->db->prepare($sql));
        }
        
           //zip
             if (!$h->db->column_exists('users', 'user_hybridauth_zip')) {
            // add new user_hybridauth_provider field
            $sql = "ALTER TABLE " . TABLE_USERS . " ADD user_hybridauth_zip VARCHAR(50) AFTER user_hybridauth_id";
            $h->db->query($h->db->prepare($sql));
        }
        
        // Plugin settings - not really sure what to do with these, so copied the RPX plugin, and commented out what I didn't use
        $hybridauth_settings = $h->getSerializedSettings();
        if (!isset($hybridauth_settings['application'])) { $hybridauth_settings['application'] = ""; }
       /* if (!isset($rpx_settings['api_key'])) { $rpx_settings['api_key'] = ""; }
        if (!isset($rpx_settings['language'])) { $rpx_settings['language'] = "en"; }
        if (!isset($rpx_settings['account'])) { $rpx_settings['account'] = "basic"; }
        if (!isset($rpx_settings['display'])) { $rpx_settings['display'] = "embed"; } */
        $h->updateSetting('hybridauth_settings', serialize($hybridauth_settings));
        
        // Clean up any leftover temp data from incomplete registrations in previous versions of this plugin - don't know about this either
        $sql = "DELETE FROM " . TABLE_MISCDATA . " WHERE miscdata_key = %s";
        $h->db->query($h->db->prepare($sql, 'hybridauth_identifier'));
    }
    
    
    /**
     * The JavaScript for the RPX pop up - didnt use this yet
     */
    public function pre_close_body($h)
    {
      
    }
    
	/*
	* all this does is include one of the template files
	* the template uses a call back to the same login page after authenticating the user  
	* it adds a query string to the url(using facebook as e.g.): connected_with=facebook
	* We can then use this to check against in theme_index_top, and log the user in if it's present
	*/
      public function user_signin_login_pre_login_form($h)
    {
        //include authenticated user view
		include "templates/inc_authenticated_user.php";
	}
    

    /**
     * Same as user_signin_login_pre_login_form, but returns you to the registration page instead
     */
    public function user_signin_register_pre_register_form($h)
    {
     //include unauthenticated user view
		include "templates/inc_unauthenticated_user.php";
    }
    
    
      
    /**
     * The bulk of the work is done in here. 
	 * There are two main IF statements (marked A and B) - the first handles logins, and the second handles registration.
	 * The registration part actually starts by copying out the login (part A) to check if a user is already logged in with their social account,
	 * and then it goes ahead with registering - It could be separated out, but I was just happy it works.
     */
 public function theme_index_top($h)
{


	//A) if the user is logging in (already registered) - so page is login, and provider connection has been returned
       if ($h->cage->get->keyExists('connected_with')&& $h->pageName == 'login')  
    {   // load hybridauth base file
	require_once( "content/plugins/hybridauth/hybridauth/Hybrid/Auth.php" );
	$hybridauth_config = './content/plugins/hybridauth/hybridauth/config.php';

	$hybridauth = new Hybrid_Auth( $hybridauth_config );
	//if hybridauth connected with key exists	
	if ($hybridauth->isConnectedWith( $h->cage->get->keyExists('connected_with')))
	{				
           $this->provider = $h->cage->get->getAlpha('connected_with'); // $_GET the provider key from url and set it to the constant
           $provider=$this->provider;
            //get hybridauth provider, and user's profile object
            $adapter = $hybridauth->getAdapter( $provider );
            $user_profile = $adapter->getUserProfile();
	
            //Save any user details to the database!
            include 'libs/hybridauth_authentication.php';
                
            $authenticate= new authentication();//create the data access object
      
            
             #1 Check if user is already authenticated using the chosen provider (e.g. facebook)
             $authentication_info= $authenticate->find_by_provider_uid($h, $provider, $user_profile->identifier);
            
             # 2 - if authentication exists in the database, then we set the user as connected and redirect him to his profile page
                 if( $authentication_info ){
  
					//get username 
					$username= $authenticate->get_username_by_provider_uid($h, $user_profile->identifier);
					
		if ($username) {//if there is...
                $login_result = $h->currentUser->loginCheck($h, $username, ''); // no password necessary
				               // echo "<script>alert('$login_result')</script>";
							   
							     //success
                $h->currentUser->name = $username;
                $remember = 1; // keep them logged in for 30 days (not optional)
                require_once(PLUGINS . 'user_signin/user_signin.php');
                $user_signin = new UserSignin();
                $user_signin->loginSuccess($h, $remember);
				
				//redirect via javascript (maybe not the best way) to profile page
              echo "<script>location.href='index.php?page=account'</script>";

            }
                     
                // so that we don't return to the register page:
               // setcookie("hotaru_user", $preferredname);
            } 
			
			//if the user can't log in cos they are not already registered:
			else{
			  //show user not logged in error, and redirect to registration page
			 
			                echo "<script>alert('You must register before logging in.');location.href='index.php?page=register'</script>";
			
			}
			

				
			}
       
    }
	
	//B) if user is registering
	 //if we are on the registration page, and connect with is in the url
    if ($h->cage->get->keyExists('connected_with')&& $h->pageName == 'register')  
    {   // load hybridauth base file
		
		require_once( "content/plugins/hybridauth/hybridauth/Hybrid/Auth.php" );
	$hybridauth_config = './content/plugins/hybridauth/hybridauth/config.php';
	
	$hybridauth = new Hybrid_Auth( $hybridauth_config );
	//if hybridauth connected with key exists	
	if ($hybridauth->isConnectedWith( $h->cage->get->keyExists('connected_with')))
	{				
           $this->provider = $h->cage->get->getAlpha('connected_with'); // $_GET the provider key from url and set it to the constant
           $provider=$this->provider;
            //get hybridauth provider, and user's profile object
            $adapter = $hybridauth->getAdapter( $provider );
            $user_profile = $adapter->getUserProfile();
	
            //Save any user details to the database!
            include 'libs/hybridauth_authentication.php';
                
            $authenticate= new authentication();//create the data access object
      
            
             #1 Check if user is already authenticated using the chosen provider (e.g. facebook)
             $authentication_info= $authenticate->find_by_provider_uid($h, $provider, $user_profile->identifier);
            
             # 2 - if authentication exists in the database, then we set the user as connected and redirect him to his profile page
                  if( $authentication_info ){
                     
					 //get username 
					$username= $authenticate->get_username_by_provider_uid($h, $user_profile->identifier);
				
		if ($username) {
                $login_result = $h->currentUser->loginCheck($h, $username, ''); // no password necessary

            }
                     
                //success
                $h->currentUser->name = $username;
                $remember = 1; // keep them logged in for 30 days (not optional)
                require_once(PLUGINS . 'user_signin/user_signin.php');
                $user_signin = new UserSignin();
                $user_signin->loginSuccess($h, $remember);
           
                //redirect via javascript (maybe not the best way) to profile page
              echo "<script>location.href='index.php?page=account'</script>";
            } 
               # 3 - else, here lets check if the user email we got from the provider already exists in our database ( for this example the email is UNIQUE for each user )
			// if authentication does not exist, but the email address returned  by the provider does exist in database, 
			// then we tell the user that the email  is already in use 
			// but, its up to you if you want to associate the authentication with the user having the adresse email in the database
			if( $user_profile->email ){
				$user_info = $authenticate->find_by_email($h,  $user_profile->email );

				if( $user_info ) {
					die( '<br /><b style="color:red">Well! the email returned by the provider ('. $user_profile->email .') already exist in our database, so in this case you might use the <a href="index.php">Sign-in</a> to login using your email and password.</b>' );
				}
			}
             
         # 4 - if authentication does not exist and email is not in use, then we create a new user 
			$provider_uid  = $user_profile->identifier;
                        //provider is just $provider
			$first_name    = $user_profile->firstName;
			$last_name     = $user_profile->lastName;
            $email         = $user_profile->email;
			$display_name  = $user_profile->displayName;
			$website_url   = $user_profile->webSiteURL;
                        $profile_url   = $user_profile->profileURL;
                        $photo_url     = $user_profile->photoURL;
                        $description   = $user_profile->description;
                        $birthday      = $user_profile->birthDay;
                        $country       = $user_profile->country;
                        $region        = $user_profile->region;
                        $city          = $user_profile->city;
                        $phone         = $user_profile->phone;
                        $gender        = $user_profile->gender;
                        $birthyear     = $user_profile->birthYear;
                        $birthmonth    = $user_profile->birthMonth;
                        $zip           = $user_profile->zip;
					    $password      = ''; # for the password we generate something random
						
						//ask for the username
			if ( $h->cage->get->keyExists('username'))
			{				
           $this->prefname = $h->cage->get->getAlnum('username'); // $_GET the provider key from url and set it to the constant
           $preferredname=$this->prefname;}else{echo "<script>alert('error')</script>";}
		   
		   //username server side validity check (duplicate check)
		  $duplicate = $authenticate->check_username($h, $preferredname);
		  //check for invalid characters
			if (preg_match('/[^a-z0-9.#$-]/i', $preferredname)) die ("Invalid characters found");
		  
		//if duplicate just die
		if($duplicate)
		{
			die('Error: This username is taken.');
		}
		
		
		
			//create new user base
				require_once(BASEURL . 'libs/UserBase.php');
                $user_base = new UserBase();
				$permissions=$user_base->getDefaultPermissions($h, 'member');
				// get user ip
				$userip = $h->cage->server->testIp('REMOTE_ADDR');
				
				
						
						
			// 4.1 - create new user
			$new_user_id = $authenticate->createUser($h, 
								$preferredname,
                                $provider_uid,
                                $provider,
                                $first_name,
                                $last_name,
                                $email,
                                $preferredname,
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
								$preferredname,
								$userip,
								$permissions
								
                               ); 
                        
                        // 4.3 - store the new user_id in session
						
					 #1 Check if user is already authenticated using the chosen provider (e.g. facebook)
             $authentication_info= $authenticate->find_by_provider_uid($h, $provider, $user_profile->identifier);	
		  # 2 - if authentication exists in the database, then we set the user as connected and redirect him to his profile page
                  if( $authentication_info ){
                     
                  	 //get username 
					$username= $authenticate->get_username_by_provider_uid($h, $user_profile->identifier);
					
		if ($username) {
                $login_result = $h->currentUser->loginCheck($h, $username, ''); // no password necessary
				               // echo "<script>alert('$login_result')</script>";

            }
                     
                //success
                $h->currentUser->name = $username;
                $remember = 1; // keep them logged in for 30 days (not optional)
                require_once(PLUGINS . 'user_signin/user_signin.php');
                $user_signin = new UserSignin();
                $user_signin->loginSuccess($h, $remember);
           
                //redirect via javascript (maybe not the best way) to profile page
              echo "<script>location.href='index.php?page=account'</script>";
            }
        }              
                              
    }
		
    }
           
		 
   /**
     * Alternative to the standard username/password check
     *
     * @param array $vars - first element is a username
     * @return bool
     */
    public function userbase_logincheck($h, $vars)
    {
        // if the traditional form has been submitted, return false and 
        // use the traditional login/password authentication:
        if ($h->cage->post->testPage('page') == 'login') { return false; }
        
        $username = $vars[0];
        
        $sql = "SELECT user_id, user_hybridauth_id FROM " . TABLE_USERS . " WHERE user_username = %s";
        $results = $h->db->get_row($h->db->prepare($h->db->prepare($sql, $username)));
        
        if (!$results) { return false; }
            
        if ($results->user_id && $results->user_hybridauth_id) { 
            return true;
        } else {
            return false;
        }

    }
    
    
    
    /**
     * To pass the password check during registration, we'll need a dummy password
	 *not sure if we are using this, adapted it from the RPX plugin
     *
     * @return array
     */
    public function user_signin_register_password_check($h)
    {
        // if the traditional form has been submitted, return false and 
        // use the traditional registration method:
        if ($h->cage->post->testPage('page') == 'register') { return false; }
        
        $password = random_string(16); // generate a random 16 char password
        $passwords = array('password'=>$password, 'password2'=>$password);
        return $passwords;
    }
    
        
    
     /**
     * Show associated providers on user's Account page
     */
    public function users_account_pre_password_user_only($h)
    {
        $output = "<div class='users_account'>\n";
        $output .= "<p id='rpx_providers_header'> Social Login:</p>\n";
        
        $no_providers = false; // a simple flag to indicate whether ther is a social provider connected to the account
               
               
       
            // see if there's a social login linked to the current user
            $sql = "SELECT user_id, user_hybridauth_provider FROM " . TABLE_USERS . " WHERE user_id = %s";
            $result = $h->db->get_row($h->db->prepare($sql, $h->currentUser->id));
            if ($result->user_hybridauth_provider) {
                $output .= "<p id='rpx_providers_desc'>Your account is associated with:</p>\n";
                $output .= "<ul>\n";
				$output .= "<li>&raquo " . $result->user_hybridauth_provider . "</li>";
			
            } else {
                $no_providers = true;
            }
        
           
        $output .= "</ul>\n";
        
        if ($no_providers) {
                    
            $output .= "<p> You aren't connected with any social accounts.";
            //TODO: include a connect social account with existing user
        }
        
        $output .= "</div>";
        
        echo $output;
    }
    
    

    /**
     * Show sign in link if mode is "replace"
     *
     * @param return bool
     */
    public function user_signin_navigation_logged_out($h)
    {
        if ($this->display != 'replace') { return false; }
        
        echo "<li><a class='rpxnow' onclick='return false;' ";
        echo "href='https://" . $this->application . ".rpxnow.com/openid/v2/signin?token_url=" . $this->tokenUrl . "'>";
        echo $h->lang["rpx_navigation_signin"] . "</a></li>\n";
        
        return true;
    }

}
