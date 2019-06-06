<?php

use Phalcon\Mvc\Controller;

class ListController extends Controller
{
	public function indexAction()
	{
		// get list of items
		$items = Items::find(['order'=>'checked']);

		// send data to the view
		$this->view->items = $items;
	}

	public function submitAction()
	{
		// get variables from get
		$i = $this->request->get('item');

		// add item to the DB
		$item = new Items();
		$item->item = $i;
		$item->save();

		// redirect to user list
		$this->response->redirect('/list');
	}

	public function checkAction()
	{
		// get variables from get
		$id = $this->request->get('id');

		// delete the user from the DB
		$item = Items::findFirst($id);
		$item->checked = 1;
		$item->save();

		// redirect to user list
		$this->response->redirect('/list');
	}
}