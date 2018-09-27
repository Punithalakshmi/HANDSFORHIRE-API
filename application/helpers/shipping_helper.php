<?php
	/**
	 * Get All Shipping Services
	 * @param boolean flag <p>
	 * if true,select text included
	 * </p>
	 * @return shipping services.
	 */
	function get_shipping_services($flag = false)
	{
		
		$services = $flag?array('' => 'select'):array();
		$services['usps'] = 'USPS';
		$services['ups'] = 'UPS';
		$services['fedex'] = 'Fedex';
		$services['frontier'] = 'Frontier';
		$services['freight'] = 'Freight';
		return $services;
		
	}














?>