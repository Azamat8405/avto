<?php

use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class AdminController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
		if(!\Auth::isAuth())
		{
	        echo Phalcon\Tag::linkTo("signup", "Зарегистрироваться");
	        echo Phalcon\Tag::linkTo("signup/login", "Войти");
		}
		else
		{
			echo Phalcon\Tag::linkTo("signup/logout", "Выйти");
		}
    }

    public function listMessagesAction()
    {
    	if(!Auth::isAuth())
		{
			$this->response->redirect('/admin');
		}
		$messages = Messages::find([
			"order" => "add_date DESC"
		]);

		$page = 1;
		if($this->request->has('page'))
			$page = $this->request->get('page');

		$paginator = new PaginatorModel([
			"data"  => $messages,
			"limit" => 10,
			"page"  => $page,
		]);
		$paginatorObj = $paginator->getPaginate();
		$this->view->setVar('messagesList', $paginatorObj->items);
		$this->view->setVar('pagination', $paginatorObj);
	}

	public function deleteMessageAction()
    {
       	if(!Auth::isAuth())
		{
			$this->response->redirect('/admin');
		}
		$message = Messages::findFirst($this->request->get('id'));
		if($message)
		{
			$message->delete();
		}
		$this->response->redirect($this->request->getServer('HTTP_REFERER'));
	}

	public function addMessageAction()
    {
       	if(!Auth::isAuth())
		{
			$this->response->redirect('/admin');
		}

	}
	public function saveMessageAction()
	{
       	if(!Auth::isAuth())
		{
			$this->response->redirect('/admin');
		}

		$id = $this->request->getPost('id');

		$title = $this->request->getPost('title');
		$text = $this->request->getPost('text');

		if($text != '' && $title != '')
		{
			if($id > 0)
			{
				$mess = Messages::findFirst($id);
				if(!$mess)
				{
					$this->response->redirect('admin/listMessages');
				}
			}
			else
			{
				$mess = new Messages();
				$mess->add_date = time();
			}

			$mess->title = $title;
			$mess->text = $text;

			$mess->save();
		}
		$this->response->redirect('admin/listMessages');
	}

	public function editMessageAction()
	{
       	if(!Auth::isAuth())
		{
			$this->response->redirect('/admin');
		}

		$message = Messages::findFirst($this->request->get('id'));
		if($message)
		{
			$this->view->setVar('message', $message);
		}
		else
			$this->response->redirect('admin/listMessages');

	}
}