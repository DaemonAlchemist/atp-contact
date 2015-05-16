<?php

namespace ATPContact\Controller;

class IndexController extends \ATPCore\Controller\AbstractController
{
	public function indexAction()
	{
		$view = new \Zend\View\Model\ViewModel();
		
		$field = new \ATPContact\Model\Field();
		$view->fields = $field->loadMultiple(array(
			'orderBy' => 'sort_order ASC'
		));
		
		return $view;
	}
	
	public function postAction()
	{
	}
}