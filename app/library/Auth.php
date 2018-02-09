
<?php

// namespace Library;

use Phalcon\Mvc\User\Component;
use Phalcon\Di;

class Auth extends Component
{
	public static function isAuth()
	{
		$session = Di::getDefault()->get('session');
		if($session->has('user'))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}