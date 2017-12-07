<?php
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

$componentURI = JURI::root(true).'/administrator/components/com_gtpihps';
$compJSURI = $componentURI.'/assets/js';
$compCSSURI = $componentURI.'/assets/css';

// Define DS
if(!defined('DS')){
	define('DS',DIRECTORY_SEPARATOR);
}

if(!defined('GT_ADMIN_JS')) {
	define('GT_ADMIN_JS', $compJSURI);
}

if(!defined('GT_ADMIN_CSS')) {
	define('GT_ADMIN_CSS', $compCSSURI);
}

require_once (dirname(__FILE__).DS.'helper.php');
require_once (JPATH_ROOT . DS . 'administrator' . DS . 'components' . DS . 'com_gtpihps' . DS . 'helpers' . DS . 'html.php');
require_once (JPATH_ROOT . DS . 'administrator' . DS . 'components' . DS . 'com_gtpihps' . DS . 'helpers' . DS . 'date.php');

$document = JFactory::getDocument();
$admin_js = JURI::root(true).'/administrator/components/com_gtpihps/assets/js';

$document->addScript($compJSURI . '/datatables.min.js');
$document->addStyleSheet($compCSSURI . '/datatables.min.css');
$document->addStyleSheet($compCSSURI . '/dataTables.fontAwesome.css');

$document->addScript($compJSURI . '/jquery.number.min.js');
$document->addScript($compJSURI . '/jquery.flot.min.js');

$document->addStyleSheet(JURI::root(true).'/modules/mod_gtpihps_map/css/stylesheet.css');
$document->addScript($admin_js.'/jquery.blockUI.js');
$document->addScript(JURI::root(true).'/modules/mod_gtpihps_map/js/raphael.min.js');
$document->addScript(JURI::root(true).'/modules/mod_gtpihps_map/js/jquery.mapael.min.js');
$document->addScript(JURI::root(true).'/modules/mod_gtpihps_map/js/indonesia.js');
$document->addScript(JURI::root(true).'/modules/mod_gtpihps_map/js/script_______.js');

JText::script('MOD_GTPIHPS_MAP_EMPTY');
JText::script('MOD_GTPIHPS_MAP_LOWEST');
JText::script('MOD_GTPIHPS_MAP_LOW');
JText::script('MOD_GTPIHPS_MAP_MODERATE');
JText::script('MOD_GTPIHPS_MAP_HIGH');
JText::script('MOD_GTPIHPS_MAP_HIGHEST');

JText::script('MOD_GTPIHPS_MAP_DOWN');
JText::script('MOD_GTPIHPS_MAP_DESCEND');
JText::script('MOD_GTPIHPS_MAP_STILL');
JText::script('MOD_GTPIHPS_MAP_CLIMB');
JText::script('MOD_GTPIHPS_MAP_UP');

JText::script('MOD_GTPIHPS_MAP_FOREIGN');
JText::script('MOD_GTPIHPS_MAP_TOOLBAR_VIEW_MAP');
JText::script('MOD_GTPIHPS_MAP_UPDATING');
JText::script('MOD_GTPIHPS_MAP_PROVINCE');
JText::script('MOD_GTPIHPS_MAP_VALUE');
JText::script('MOD_GTPIHPS_MAP_PRICE');
JText::script('MOD_GTPIHPS_MAP_CHANGE');
JText::script('MOD_GTPIHPS_MAP_MARKET');
JText::script('MOD_GTPIHPS_MAP_LOADING');

// Data
$commodities	= modGTPIHPSMap::getCommodities();
$commodity_id	= modGTPIHPSMap::getDefaultCommodityID();
$categories		= modGTPIHPSMap::getCategories();
$date			= modGTPIHPSMap::getLatestDate(JHtml::date('+1 days', 'Y-m-d'));

$priceTypeOptions = modGTPIHPSMap::getPriceTypes();
$commodityOptions = GTHelperHtml::setCommodities($categories[0], $categories, $commodities, 'select');

$component_url = JURI::base(true) . '/index.php?option=com_gtpihps&view=province_statistics&Itemid=114';
$document->addScriptDeclaration("
// Set variables
	var component_url = '$component_url';
");

require JModuleHelper::getLayoutPath('mod_gtpihps_map', $params->get('layout', 'default'));
