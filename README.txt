HybridAuth Plugin for Hotaru CMS
---------------------------------
Created by: Graeme Fulton

Description
-----------
This plugin allows your users to register and login via third party providers such as Twitter, Facebook, Google and Yahoo.

I've made this plugin by starting with the RPX plugin, and changing it, so many of the same plugin hooks are used.
Needs some more work, here are the to-do (that I can think of):

TO-DO
------
1. No function for existing users to ADD a social login to their account yet.
2. There's no admin page - hybridauth_settings.php is pretty much none functioning, started copying the rpx_settings.php
3. When a user registers, they get redirected to the registration page, before their account page. 
   It may pause on the register page for a couple seconds - could do with a loading gif here.

Issue
-----
Probably won't work if your site does not have jquery. 


Instructions
-------------
1. Drop the hybridauth folder into your plugin directory, and install the plugin from your admin page.
2. navigate to http://yoursitename.com/content/plugins/hybridauth/hybridauth/install.php
3. Create your social apps, and input the details as instructed on the hybridauth install page
4. Put the users_account.php into the following directory: plugins/users/templates/
5. I think that's all - it should work but no garuantees as it's not been tested much!

Changelog
---------
  
v.0.1 2013/05/27 - Graeme - test version.


Notes
--------
The users_account.php file has been modified for the Hybridauth Social Login plugin to work efficiently.
A check has been added to see if the user registered to our site with a social login- if so, we no
longer display the password change fields, as social users don't log in with passwords - just their social 
account. The email update is also disabled.

note - I had to make some small changes to the Facebook file in the 3rd party folder of Hybridauth, because it was checking for cookies and causing warning messages
       some detail of this change can be seen here: http://stackoverflow.com/questions/16382900/warning-array-key-exists-how-to-solve-this-warning
	I removed : "if (array_key_exists($cookie_name, $_COOKIE))". Since the change there have been no problems logging in and registerying with facebook.
