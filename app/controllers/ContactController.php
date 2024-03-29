<?php

use Phalcon\Mvc\Controller;

class ContactController extends Controller
{
	public function indexAction()
	{
		$this->view->setLayout('home');
	}

	public function submitAction()
	{
		$name = $this->request->get('name');
		$email = $this->request->get('email');
		$message = $this->request->get('message');

		$this->view->name = $name;
		$this->view->email = $email;
		$this->view->message = $message;
		$this->view->setLayout('home');
	}
}