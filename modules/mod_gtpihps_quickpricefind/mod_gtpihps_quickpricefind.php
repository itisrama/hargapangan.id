<?php
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
// Define DS
if(!defined('DS')){
	define('DS',DIRECTORY_SEPARATOR);
}

require_once (dirname(__FILE__).DS.'helper.php');
require_once (JPATH_ROOT . DS . 'administrator' . DS . 'components' . DS . 'com_gtpihps' . DS . 'helpers' . DS . 'array.php');
require_once (JPATH_ROOT . DS . 'administrator' . DS . 'components' . DS . 'com_gtpihps' . DS . 'helpers' . DS . 'html.php');

$regionOptions = modGTPIHPSQuickPriceFind::getRegionOptions();
$regionID = modGTPIHPSQuickPriceFind::getRegionID();

$document = JFactory::getDocument();
$document->addScript(JURI::root(true).'modules/mod_gtpihps_quickpricefind/script.js');

$component_url = JURI::base(true) . '/index.php?option=com_gtpihps&view=province_statistics&Itemid=114';
$document->addScriptDeclaration("
// Set variables
	var component_url = '$component_url';
");

require JModuleHelper::getLayoutPath('mod_gtpihps_quickpricefind', $params->get('layout', 'default'));