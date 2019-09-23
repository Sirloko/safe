<?php
define('DEBUG', true);
define('DB_NAME', 'vault'); //Database name
define('DB_USER', 'root'); //Database user
define('DB_PASSWORD', 'eportal4school'); //Database password
define('DB_HOST', '127.0.0.1'); //Database host *** Using ip address to avoid dns lookup

define('DEFAULT_CONTROLLER', 'Dashboard'); // Default controller if none is defined
define('DEFAULT_LAYOUT', 'default'); //if no layer is sef,use default

define('SITE_TITLE', 'VAULT');
define('MENU_BRAND', 'VAULT');//brand name

define('PROOT', '/vault/');

define('CURRENT_USER_SESSION_NAME', 'tphjqrepgusdgkfhjrytrdwdqgjdkdldmnc'); //Session name for logged in user
define('REMEMBER_ME_COOKIE_NAME', 'mreghwdcvxznbhyvturolpeytrwqqngvtkx'); //Cookie name for logged in user
define('REMEMBER_ME_COOKIE_EXPIRY', 2592000); //Expiry validity time in seconds(30days)
define('ACCESS_RESTRICTED', 'Restricted'); //controlller name for the restricted redirect
date_default_timezone_set('Africa/Lagos');