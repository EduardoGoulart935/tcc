<?php 

require_once('../vendor/autoload.php');

use \App\Session\User as SessionUser;

SessionUser::logout();
header("Location: login");
exit;