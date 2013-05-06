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
1. Currently, on the user account page, the change user name and password fields must be removed, as we are relying on the social login whereby password is not used.
2. The 2 files in the template folder use a direct url: $widgetURL= BASEURL."content/plugins/hybridauth/widget/"; - this shows briefly in the browser - not sure if this is a problem?
3. When a user registers, their permissions are not set, so the entry in the db to user_permissions is null...need to give them standard user permissions on registration, or they can't make submissions or comments etc.
4. The username is based on the display name - with white space removed.
   e.g. John Smith becomes JohnSmith...therefore if we have two users logging in as JohnSmith, the username is not unique. 
5. No function for existing users to ADD a social login to their account yet.
6. There's no admin page - hybridauth_settings.php is pretty much none functioning, started copying the rpx_settings.php
7. CHange hybridauth_authentication.php so that it accesses the database using hotaru connection

Instructions
-------------
1. Drop the hybridauth folder into your plugin directory, and install the plugin from your admin page.
2. navigate to http://yoursitename.com/content/plugins/hybridauth/hybridauth/install.php
3. Create your social apps, and input the details as instructed on the hybridauth install page
4. I think that's all

Changelog
---------

v.0.1 2013/05/06 - Graeme - test version.



note - I had to make some small changes to the Facebook file in the 3rd party folder of Hybridauth, because it was checking for cookies and causing warning messages
       some detail of this change can be seen here: http://stackoverflow.com/questions/16382900/warning-array-key-exists-how-to-solve-this-warning
	I removed : "if (array_key_exists($cookie_name, $_COOKIE))". Since the change there have been no problems logging in and registerying with facebook.
