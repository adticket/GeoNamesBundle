<?php

//  +-----------------------------------------------------------+
//  | Copyright (c) AD ticket GmbH                              |
//  | All rights reserved.                                      |
//  +-----------------------------------------------------------+
//  | AD ticket GmbH                                            |
//  | Kaiserstraße 69                                           |
//  | D-60329 Frankfurt am Main                                 |
//  |                                                           |
//  | phone: +49 (0)69 407 662 0                                |
//  | fax:   +49 (0)69 407 662 50                               |
//  | mail:  github@adticket.de                                 |
//  | web:   www.ADticket.de                                    |
//  +-----------------------------------------------------------+
//  | This file is part of                                      |
//  | AdticketGeoNamesBundle.                                   |
//  | https://github.com/adticket/AdticketGeoNamesBundle        |
//  +-----------------------------------------------------------+
//  | This bundle is free software: you can redistribute it     |
//  | and/or modify it under the terms of the GNU General       |
//  | Public License as published by the Free Software          |
//  | Foundation, either version 3 of the License, or (at your  |
//  | option) any later version.                                |
//  |                                                           |
//  | In addition you are required to retain all author         |
//  | attributions provided in this software and attribute all  |
//  | modifications made by you clearly and in an appropriate   |
//  | way.                                                      |
//  |                                                           |
//  | This software is distributed in the hope that it will be  |
//  | useful, but WITHOUT ANY WARRANTY; without even the        |
//  | implied warranty of MERCHANTABILITY or FITNESS FOR A      |
//  | PARTICULAR PURPOSE.  See the GNU General Public License   |
//  | for more details.                                         |
//  |                                                           |
//  | You should have received a copy of the GNU General Public |
//  | License along with this software.                         |
//  | If not, see <http://www.gnu.org/licenses/>.               |
//  +-----------------------------------------------------------+

/**
 * @author Markus Tacker <m@coderbyheart.de>
 * @package AdTicket:Sf2BundleOS:AdticketGeoNamesBundle
 * @category Service
 */

namespace Adticket\GeoNamesBundle\Service;

use Adticket\GeoNamesBundle\Entity\Place;
use Adticket\GeoNamesBundle\Exception\Exception;
use Adticket\GeoNamesBundle\Exception\ApiException;

/**
 * Implements the GeoNames interface postalCodeLookup.
 *
 * @see http://www.geonames.org/export/web-services.html#postalCodeLookupJSON
 *
 * @author Markus Tacker <m@coderbyheart.de>
 * @package AdTicket:Sf2BundleOS:AdticketGeoNamesBundle
 * @category Service
 */
class PostalCodeLookup
{
    /**
     * @var string
     */
    private $apiendpoint;

    /**
     * @var string
     */
    private $username;

    /**
     * Constructor
     *
     * @param string API endpoint
     * @param string API username
     */
    public function __construct($apiendpoint, $username)
    {
        $this->apiendpoint = $apiendpoint;
        $this->username = $username;
    }

    /**
     * returns a list of places for the given postalcode in JSON format
     *
     * @param string $postalcode
     * @param string $country Default is all countries.
     * @return \Adticket\GeoNamesBundle\Entitiy\Place[]
     */
    public function lookupPostalcode($postalcode, $country = null)
    {
        return $this->query(array('postalcode' => $postalcode, 'country' => $country));
    }

    /**
     * returns a list of places for the given place name in JSON format
     *
     * @param string $placename
     * @param string $country Default is all countries.
     * @return \Adticket\GeoNamesBundle\Entitiy\Place[]
     */
    public function lookupPlacename($placename, $country = null)
    {
        return $this->query(array('placename' => $placename, 'country' => $country));
    }

    /**
     * @param array Query parameter
     * @return \Adticket\GeoNamesBundle\Entitiy\Place[]
     */
    protected function query(array $params)
    {
        $params['username'] = $this->username;
        $url = $this->apiendpoint . '?' . http_build_query($params);
        if (!$response = file_get_contents($url)) throw new Exception("Request failed: " . $url);
        $result = json_decode($response);

        # If a request for a geonames web service encounters an error the following
        # exception format will be used for the returned document. GeoNames supports
        # two flavor of web services : JSON and XML. The exception message returned
        # is either JSON or XML and consists of a status element with a numeric error
        # code and a message string.
        if (property_exists($result, 'status')) throw new ApiException($result->status->message, (int)$result->status->value);

        if (!property_exists($result, 'postalcodes')) throw new Exception("Missing postalcodes in response: " . $response . ' from  ' . $url);
        $places = array();
        foreach ($result->postalcodes as $placeData) {
            $place = new Place();
            foreach (array('adminCode3', 'adminName2', 'adminName3', 'adminCode2', 'postalcode', 'adminCode1', 'countryCode', 'lng', 'placeName', 'lat', 'adminName1') as $attr) {
                // $this->assertAttributeNotEmpty($attr, $place);
                if (property_exists($placeData, $attr)) $place->$attr = $placeData->$attr;
            }
            $places[] = $place;
        }
        return $places;
    }
}
