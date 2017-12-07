<?php

defined ( '_JEXEC' ) or die ( 'Restricted access' );

// loads module function file
jimport('joomla.event.dispatcher');

class modGTPIHPSQuickPriceFind {

	public static function getRegionID() {
		// Get a db connection.
		$db = JFactory::getDBO();

		// Create a new query object.
		$query = $db->getQuery(true);

		$query->select($db->quoteName('a.id'));
		$query->from($db->quoteName('#__gtpihps_regions', 'a'));
		$query->where($db->quoteName('a.published') . ' = 1');
		
		$query->order($db->quoteName('a.province_id').','.$db->quoteName('a.id'));
		$query->limit(1);
		$db->setQuery($query);
		return intval(@$db->loadObject()->id);
	}

	public static function getRegions($all = false) {
		$region_id = self::getRegionID();

		// Get a db connection.
		$db = JFactory::getDBO();

		// Create a new query object.
		$query = $db->getQuery(true);

		$query->select($db->quoteName(array('a.id', 'a.name')));
		$query->from($db->quoteName('#__gtpihps_regions', 'a'));
		
		$query->where($db->quoteName('a.published') . ' = 1');
		if(!$all) {
			$query->where($db->quoteName('a.id') . ' IN ('.implode(',', $region_id).')');
		}

		$query->order($db->quoteName('a.province_id').','.$db->quoteName('a.id'));

		$db->setQuery($query);
		$raw = $db->loadObjectList();
		$data = array();
		foreach ($raw as $item) {
			$data[$item->id] = $item->name;
		}
		return $data;
	}

	public static function getRegionOptions() {
		$options = self::getRegions(true);

		return GTHelperArray::toOption($options);
	}
}
