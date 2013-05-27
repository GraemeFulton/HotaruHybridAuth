Users plugin adjustment
---------------------------------
Created by: Graeme Fulton

Description
-----------
The users_account.php file has been modified for the Hybridauth Social Login plugin to work efficiently.

A check has been added to see if the user registered to our site with a social login- if so, we no
longer display the password change fields, as social users don't log in with passwords - just their social 
account. The email update is also disabled.

Instructions
-------------
Put the users_account.php into the following directory: plugins/users/templates/