<?php
require_once dirname(__FILE__).'/../../Core.php';

use DhlAssistant\Wrappers;
use DhlAssistant\Classes\Controllers;

class DhlAssistantHelpController extends ModuleAdminController
{
	public function initContent()
	{
		$this->display = 'view';
		parent::initContent();
	}
	public function renderView()
	{
		$iframe_link = (new Controllers\Help())->GetLink();
		$this->context->controller->addJS(Wrappers\ConfigWrapper::Get('BaseUrl').'Media/Js/iframeResizer.min.js');
		$this->context->smarty->assign(array('dhlassistant_iframe_link'=>$iframe_link));
		return $this->context->smarty->fetch(\DhlAssistant\Core::$BASEDIR.'LocalTemplates/ModuleConfiguration.tpl');	
	}
	
}