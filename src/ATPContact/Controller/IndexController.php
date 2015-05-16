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
		$field = new \ATPContact\Model\Field();
		$fields = $field->loadMultiple(array(
			'orderBy' => 'sort_order ASC'
		));
	
		$messageData = array();
		foreach($fields as $field)
		{
			$name = \ATP\Inflector::underscore($field->label);
			$messageData[$field->label] = $this->params()->fromPost($name);
		}
		
		echo "<pre>";print_r($messageData);die();
	}
}