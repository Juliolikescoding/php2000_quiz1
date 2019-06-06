<?php

use Phalcon\Mvc\Controller;

class HomeController extends Controller
{
	public function indexAction()
	{
		// force session to be opened
		if( ! $this->session->has("username")) $this->response->redirect("/login");

		// load the session
		$username = $this->session->get("username");

		// send data to the view
		$this->view->username = $username;
	}
}