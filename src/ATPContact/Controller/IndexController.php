<?php

namespace ATPContact\Controller;

class IndexController extends \ATPCore\Controller\AbstractController
{
	public function indexAction()
	{
        $this->noCache();

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

        $sesMessage = [
            'Destination' => [
                'ToAddresses' => [$this->siteParam('contact-email-to')]
            ],
            'ReplyToAddresses' => [$messageData[$replyToField->label]],
            'Source' => $this->siteParam('contact-email-from'),
            'Message' => [
                'Subject' => ['Data' => $this->siteParam('contact-subject')],
                'Body' => [
                    'Text' => ['Data' => $messageText],
                    'Html' => ['Data' => $messageHtml],
                ]
            ],
        ];

        //echo "<pre>";print_r($sesMessage);die();
        $result = $this->getServiceLocator()->get(\Aws\Sdk::class)->createSes()->sendEmail($sesMessage);
        echo "<pre>";print_r($result);die();

		//TODO: add confirmation message
		$this->flash = $this->flashMessenger();
		$this->flash->addSuccessMessage($this->siteParam('contact-success-message'));
		
		//TODO: forward back to contact page
		$this->redirect()->toRoute('contact');
	}
}