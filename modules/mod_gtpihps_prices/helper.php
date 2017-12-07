<?php

defined ( '_JEXEC' ) or die ( 'Restricted access' );

// loads module function file
jimport('joomla.event.dispatcher');

class modGTPIHPSPrices {
	function getProvinces() {
		// Get a db connection.
		$db = JFactory::getDBO();

		// Create a new query object.
		$query = $db->getQuery(true);

		$query->select($db->quoteName('a.id', 'value'));
		$query->select($db->quoteName('a.name', 'text'));
		$query->from($db->quoteName('#__gtpihps_provinces', 'a'));
		
		$query->where($db->quoteName('a.published') . ' = 1');
		
		$db->setQuery($query);
		$data = $db->loadObjectList();

		array_unshift($data, (object) array(
			'value' => 0,
			'text' => 'Semua Provinsi'
		));

		return $data;
	}

	public static function getPriceTypes() {
		// Get a db connection.
		$db = JFactory::getDBO();

		// Create a new query object.
		$query = $db->getQuery(true);

		$query->select($db->quoteName('a.id', 'value'));
		$query->select($db->quoteName('a.name', 'text'));
		$query->from($db->quoteName('#__gtpihps_price_types', 'a'));
		
		if (JFactory::getUser()->guest) {
			$query->where($db->quoteName('a.published') . ' = 1');
		}
		
		$db->setQuery($query);
		return $db->loadObjectList();
	}
}