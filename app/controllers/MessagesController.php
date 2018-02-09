<?php

class MessagesController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {

    }

    public function ajaxGetMessagesAction()
    {
    	if(Auth::isAuth())
    		$id = $this->session->get('user')->id;
    	elseif($this->cookies->has('u_id'))
			$id = $this->cookies->get('u_id');
		else
    		$this->view->disable();

    	$new_messages = $this->modelsManager->executeQuery("SELECT m.*
    		FROM Messages m LEFT JOIN ScannedMessages sm ON sm.u_id = :u_id: AND sm.m_id = m.id
    		WHERE sm.m_id is null OR sm.u_id is null 
    		ORDER BY m.add_date DESC", [
    			"u_id" => $id
    		]);

    	if($new_messages)
        {
            echo json_encode($new_messages);
        }
   		$this->view->disable();
    }
    
    public function ajaxSetShowMessageAction()
    {
        if($this->request->getPost('id') > 0)
        {
            if(Auth::isAuth())
                $u_id = $this->session->get('user')->id;
            elseif($this->cookies->has('u_id'))
                $u_id = (string)$this->cookies->get('u_id');
            else
                $u_id = 0;

            if($u_id == 0)
            {
                $u_id = md5($this->request->getServer('REMOTE_ADDR').$this->request->getServer('HTTP_USER_AGENT'));
                $this->cookies->set(
                    "u_id",
                    $u_id,
                    time() + 15 * 86400
                );
            }

            $exist = ScannedMessages::find([
                'conditions' => 'm_id = ?0 AND u_id = ?1',
                'bind' => [
                    0 => $this->request->getPost('id'),
                    1 => $u_id
                ]
            ]);

            if($exist->count() > 0)
            {
                $this->view->disable();
            }

            $sm = new ScannedMessages();
            $sm->m_id = $this->request->getPost('id');
            $sm->u_id = $u_id;

            $this->db->begin();
            if(!$sm->save())
            {
                $this->db->rollback();
                $this->view->disable();
            }
            $m = Messages::findFirst($this->request->getPost('id'));
            $m->views++;

            if(!$m->save())
            {
                $this->db->rollback();
                $this->view->disable();
            }
            $this->db->commit();
        }
    }
}