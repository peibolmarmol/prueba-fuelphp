<?php
return array(
	'_root_'  => 'posts/index',  // The default route
	'_404_'   => 'welcome/404',    // The main 404 route
	 'login' => 'users/login',
    'logout' => 'users/logout',
    'register' => 'users/register',
	
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
);
