<?php
defined('_JEXEC') or die;

// Create shortcuts to some parameters.
$params =& $this->item->params;
$params->set('access-edit', false);

include_once T3_PATH.'/html/com_content/featured/default_item.php';