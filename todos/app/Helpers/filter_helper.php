<?php

use Config\Services;
use CodeIgniter\HTTP\ResponseInterface;


/**
 * Get key from request
 * Either as $_GET parameter or as HTTP Header
 *
 * @return mixed
 */
function prepare_filter() {

	// Load API config
	$api_config = config('API');

	// Error flag
	$has_errors = false;

	// Get request object
	$request = \Config\Services::request();

	// Set filter array
	$filter = array();


	// Check limit
	$limit = $request->getGet('limit');
	if (!empty($limit)) {

		// Check max limit
		if ($limit > $api_config->defaults['max_limit']) {
			$has_errors = true;
		}
		else {
			$filter['limit'] = $limit;
		}
		
		// Check page for offset
		$page = $request->getGet('page');
		if (!empty($page)) {
			$filter['offset'] = $filter['limit'] * $page;
		}
	}
	else {
		$filter['limit'] = $api_config->defaults['default_limit'];
	}


	// Check order by
	$order = $request->getGet('order');
	if (!empty($order)) {
		$filter['order'] = $order;
	}
	

	$categoryId = $request->getGet("categoryId");
	log_message("debug", "filter_helper - category id:" . $categoryId);
	if(!empty($categoryId)) {
		$filter["categoryId"] = $categoryId;
	}

	if ($has_errors) {
		return FALSE;
	}
	else  {
		return $filter;
	}


}


