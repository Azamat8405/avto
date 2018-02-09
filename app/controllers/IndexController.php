<?php

class IndexController extends \Phalcon\Mvc\Controller
{
    public function indexAction()
    {
    	if(!Auth::isAuth() && !$this->cookies->has('u_id'))
		{	
			$u_id = md5($this->request->getServer('REMOTE_ADDR').$this->request->getServer('HTTP_USER_AGENT'));
			$this->cookies->set(
		            "u_id",
		            $u_id,
		            time() + 15 * 86400
		        );
		}
    }
}