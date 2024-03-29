<?php
/**
 * This file contains a number of functions that are  called by other pages
 *
 * @package:	Gardens
 * @copyright:	March 2012 Pat Wilkins
 * @author:		Pat Wilkins - wilk0146@algonquinlive.com
 * @link:		https://github.com/wilk0146/open-data-app
 * @license:	New BSD License <> See License.txt
 * @version:	See Version.txt
 **/

/**
 * Sets a cookie to remember the user has already voted.
 * We have to remember the ID of every single thing they voted on
 *  and they must all be inside one single cookie--which is a string.
 * So, we have to come up with a solution to store all the IDs
 *  and since we are storing the IDs, we may as well store what they rated.
 *
 * Our cookie will look something like this:
 *  1:4;5:3;6:2
 *
 * Or, translated:
 *  id:rate;id:rate;id:rate
*/
function save_rate_cookie ($id, $rate) {
	$cookie = get_rate_cookie();

	$rated = array();

	foreach ($cookie as $key=>$value) {
		$rated[] = $key . ':' . $value;
	}

	$rated[] = $id . ':' . $rate;
	$cookie_content = implode(';', $rated);

	// http://php.net/setcookie
	// setcookie($name, $content, $expiry_time, $path);
	// Cookie expirations are in seconds
	setcookie('gardens_rated', $cookie_content, time() + 60 * 60 * 24 * 365, '/');
}

/**
 * Gets the cookie and splits it apart into its component pieces
 *
 * Takes:
 *  id:rate;id:rate;id:rate
 * And translates to:
 *  array(
 *    id => rate
 *    , id => rate
 *    , id => rate
 *  )
 */
function get_rate_cookie () {
	$cookie_content = filter_input(INPUT_COOKIE, 'gardens_rated', FILTER_SANITIZE_STRING);

	if (empty($cookie_content)) {
		return array();
	}

	$rated = explode(';', $cookie_content);

	$ratings = array();

	foreach ($rated as $item) {
		$pieces = explode(':', $item);
		$ratings[$pieces[0]] = $pieces[1];
	}

	return $ratings;
}


/**
 * Sets a cookie to remember where the user marker should be placed.
 * We have to remember the latitude and longitude of the user.
 * Our cookie will look something like this:
 *  75.5437543, -45.578935
 *
*/
function save_loc_cookie ($lat, $long) {
	$cookie = get_loc_cookie();

	$location = array($lat, $long);
	$cookie_content = implode(':', $location);

	// http://php.net/setcookie
	// setcookie($name, $content, $expiry_time, $path);
	// Cookie expirations are in seconds
	setcookie('location', $cookie_content, time() + 60 * 60 * 24 * 365, '/');
}

/**
 * Gets the cookie and splits it apart into its component pieces
 *
 * Takes:
 *  lattitude;longitude
 * And translates to:
 *  array(
 *    lattitude,
 *    longitude
 *  )
 */
function get_loc_cookie () {
	$location_content = filter_input(INPUT_COOKIE, 'location', FILTER_SANITIZE_STRING);

	if (empty($location_content)) {
		return array();
	}

	$location = explode(':', $location_content);

	return $location;
}



/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*::                                                                         :*/
/*::  this routine calculates the distance between two points (given the     :*/
/*::  latitude/longitude of those points). it is being used to calculate     :*/
/*::  the distance between two zip codes or postal codes using our           :*/
/*::  zipcodeworld(tm) and postalcodeworld(tm) products.                     :*/
/*::                                                                         :*/
/*::  definitions:                                                           :*/
/*::    south latitudes are negative, east longitudes are positive           :*/
/*::                                                                         :*/
/*::  passed to function:                                                    :*/
/*::    lat1, lon1 = latitude and longitude of point 1 (in decimal degrees)  :*/
/*::    lat2, lon2 = latitude and longitude of point 2 (in decimal degrees)  :*/
/*::    unit = the unit you desire for results                               :*/
/*::           where: 'm' is statute miles                                   :*/
/*::                  'k' is kilometers (default)                            :*/
/*::                  'n' is nautical miles                                  :*/
/*::  united states zip code/ canadian postal code databases with latitude & :*/
/*::  longitude are available at http://www.zipcodeworld.com                 :*/
/*::                                                                         :*/
/*::  For enquiries, please contact sales@zipcodeworld.com                   :*/
/*::                                                                         :*/
/*::  official web site: http://www.zipcodeworld.com                         :*/
/*::                                                                         :*/
/*::  hexa software development center © all rights reserved 2004            :*/
/*::                                                                         :*/
/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

function distance($lat1, $lon1, $lat2, $lon2, $unit) { 

  $theta = $lon1 - $lon2; 
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)); 
  $dist = acos($dist); 
  $dist = rad2deg($dist); 
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);

  if ($unit == "K") {
    return ($miles * 1.609344); 
  } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
        return $miles;
      }
}