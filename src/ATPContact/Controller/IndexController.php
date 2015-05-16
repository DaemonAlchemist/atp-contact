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

		$view->addChild(new \ATPCore\View\Widget\FlashWidget($this->flashMessenger()), 'flash');
		
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
		
		$messageHtml = $this->siteParam('contact-email-template');
		foreach($messageData as $name => $value)
		{
			$messageHtml = str_replace('{' . $name . '}', $value, $messageHtml);
		}
		$messageText = strip_tags($messageHtml);

		$replyToField = new \ATPContact\Model\Field();
		$replyToField->loadById($this->siteParam('contact-reply-to-field'));
		$mandrillMessage = array(
			'html' => $messageHtml,
			'text' => $messageText,
			'subject' => $this->siteParam('contact-subject'),
			'from_email' => $this->siteParam('contact-email-from'),
			'to' => array(
				array(
					'email' => $this->siteParam('contact-email-to'),
					'type' => 'to',
				),
			),
			'headers' => array('Reply-To' => $messageData[$replyToField->label]),
		);
		
		$mandrill = new \Mandrill($this->siteParam('mandrill-api-key'));
		$mandrill->messages->send($mandrillMessage);
		
		//TODO: add confirmation message
		$this->flash = $this->flashMessenger();
		$this->flash->addSuccessMessage($this->siteParam('contact-success-message'));
		
		//TODO: forward back to contact page
		$this->redirect()->toRoute('contact');
	}
}