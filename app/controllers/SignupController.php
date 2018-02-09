<?php


class SignupController extends \Phalcon\Mvc\Controller
{
    public function indexAction()
    {

    }
	public function registerAction()
    {
    	$user = \Users::findFirst([
        	'conditions' => " login = ?0 ",
        	'bind' => [
        		0 => $this->request->getPost('login')
        	]
        ]);
		if($user)
        {
			$this->response->redirect('/');
	        $this->view->disable();
        }
        else
        {
	        $user = new Users();

	        $pass = md5($this->request->getPost('password').'-~4dSWED');
	        $success = $user->save(['login' => $this->request->getPost('login'), 'password' => $pass]);

	        if ($success) {
				$this->response->redirect('/');
	        } else {

	            foreach ($user->getMessages() as $message) {
	                echo $message->getMessage(), "<br/>";
	            }
	        }
	    }
        $this->view->disable();
    }

	public function loginAction()
    {

    }

	public function authAction()
    {
    	$pass = md5($this->request->getPost('password').'-~4dSWED');
        $user = \Users::findFirst([
        	'conditions' => "password = ?0 AND login = ?1 ",
        	'bind' => [
        		0 => $pass,
        		1 => $this->request->getPost('login')
        	]
        ]);
		if($user)
        {
			$this->session->set("user", $user);
			$this->response->redirect('admin/listMessages');
        }

        $this->view->disable();
    }

    public function logoutAction()
    {
    	if(Auth::isAuth())
		{
			$this->session->remove("user");
		}
		$this->response->redirect('/');
        $this->view->disable();
    }
}