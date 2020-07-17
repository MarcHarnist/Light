 
 
				README
				 
 
 @author : Marc Harnist
 @date : 2020-07-17 
 
# News

## Plugin "config-manager"

This plugin works for update config-localhost but design is broken. 
The problem comes from formular : action send the posts to another page without pass by root/index.
So, it must be create à new complete index in config-manager/index.php just like in root/index.

I do not see better way to do that.

This directory named "engine" will store all the common files of all my creations running with the CMS Light.
This directory will be easily updated when the CMS Light version is updated, without deleting or disturbing the public directory and the specific files of my clients.