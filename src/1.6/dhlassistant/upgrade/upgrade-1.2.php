<?php
if (!defined('_PS_VERSION_'))
	exit;

function upgrade_module_1_2($module)
{
	Tools::clearSmartyCache();
	Tools::clearXMLCache();
	Media::clearCache();
	Tools::generateIndex();
	return true;
}
?>