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
//  | MediaBackendAdticketApiBundle.                            |
//  | https://github.com/adticket/MediaBackendAdticketApiBundle |
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
 * @package AdTicket:Elvis:MediaBackendFilesystemBundle
 * @category Tests
 */

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Service' . DIRECTORY_SEPARATOR . 'PostalCodeLookup.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Entity' . DIRECTORY_SEPARATOR . 'Place.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Exception' . DIRECTORY_SEPARATOR . 'Exception.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Exception' . DIRECTORY_SEPARATOR . 'ApiException.php';

use Adticket\Sf2BundleOS\GeoNamesBundle\Service\PostalCodeLookup;
use Adticket\Sf2BundleOS\GeoNamesBundle\Entity\Place;

/**
 * Tests für das Backend
 *
 * @author Markus Tacker <m@coderbyheart.de>
 * @package AdTicket:Elvis:MediaBackendFilesystemBundle
 * @category Tests
 */
class PostalCodeLookupTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test for PostalCodeLookup::lookupPostalcode()
     */
    public function testLookupPostalcode()
    {
        $service = new PostalCodeLookup('http://api.geonames.org/postalCodeLookupJSON', $GLOBALS['apiusername']);
        $result = $service->lookupPostalcode('63069', 'DE');
        $this->assertEquals(1, count($result));
        $place = array_shift($result);
        $this->assertInstanceOf('\Adticket\Sf2BundleOS\GeoNamesBundle\Entity\Place', $place);
        foreach (array('adminCode3', 'adminName2', 'adminName3', 'adminCode2', 'postalcode', 'adminCode1', 'countryCode', 'lng', 'placeName', 'lat', 'adminName1') as $attr) {
            $this->assertAttributeNotEmpty($attr, $place);
        }
        $this->assertEquals('63069', $place->postalcode);
        $this->assertEquals('Offenbach', $place->placeName);
    }

    /**
     * Test for PostalCodeLookup::lookupPlacename()
     */
    public function testLookupPlacename()
    {
        $service = new PostalCodeLookup('http://api.geonames.org/postalCodeLookupJSON', $GLOBALS['apiusername']);
        $result = $service->lookupPlacename('Offenbach am Main', 'DE');
        $place = array_shift($result);
        $this->assertInstanceOf('\Adticket\Sf2BundleOS\GeoNamesBundle\Entity\Place', $place);
        foreach (array('adminCode3', 'adminName2', 'adminName3', 'adminCode2', 'postalcode', 'adminCode1', 'countryCode', 'lng', 'placeName', 'lat', 'adminName1') as $attr) {
            $this->assertAttributeNotEmpty($attr, $place);
        }
        $this->assertEquals('Offenbach', $place->placeName);
    }
}
