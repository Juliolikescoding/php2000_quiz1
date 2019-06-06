<?php

use Phalcon\Mvc\Controller;

class CookiesController extends Controller
{
	public function indexAction()
	{
		// // initialize my session
		// if( ! $this->session->has('cookies')) {
		// 	$this->session->set('cookies', []);
		// }

		// // get the cookies array
		// $cookies = $this->session->get('cookies');

		// get the cookies from the database
		$cookies = Cookies::find();

		// send the info to the view
		$this->view->cookies = $cookies;
	}

	public function newAction()
	{
	}

	public function submitAction()
	{
		// get variables from the form
		$name = $this->request->get('cookie');
		$quantity = $this->request->get('quantity');

		// create a random filename
		$ext = strtolower(pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION));
		$picture = md5(rand() . date() . $_FILES["picture"]["name"]).".".$ext;

		// copy the picture to the images directory
		copy($_FILES["picture"]["tmp_name"], "pictures/".$_FILES["picture"]["name"]);

		// add a new cookie to the database
		$cookie = new Cookies();
		$cookie->cookie = $name;
		$cookie->picture = $picture;
		$cookie->quantity = $quantity;
		$cookie->save();

		// // get the cookies array
		// $cookies = $this->session->get('cookies');

		// // add the new cookie
		// $cookies[] = $cookie;

		// // add the new array to the session 
		// $this->session->set('cookies', $cookies);

		// redirect to the list
		$this->response->redirect('cookies/index');
	}

	public function deleteAction()
	{
		// get the ID of the cookie to delete
		$id = $this->request->get('id');

		// delete cookie from the database
		$cookie = Cookies::findFirst($id);
		$cookie->delete();

		// redirecto to the list of cookies
		$this->response->redirect('cookies/index');
	}
}