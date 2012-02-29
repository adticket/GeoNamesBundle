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
 * @category Entity
 */

namespace Adticket\Sf2BundleOS\GeoNamesBundle\Entity;

/**
 * A place in the GeoNames universe
 *
 * @author Markus Tacker <m@coderbyheart.de>
 * @package AdTicket:Sf2BundleOS:AdticketGeoNamesBundle
 * @category Entity
 */
class Place
{
    /**
     * @var string 1. order subdivision (state) varchar(100)
     */
    public $adminName1;

    /**
     * @var string 2. order subdivision (county/province) varchar(100)
     */
    public $adminName2;

    /**
     * @var string 3. order subdivision (community) varchar(100)
     */
    public $adminName3;

    /**
     * @var string 1. order subdivision (state) varchar(20)
     */
    public $adminCode1;

    /**
     * @var string 2. order subdivision (county/province) varchar(20)
     */
    public $adminCode2;

    /**
     * @var string 3. order subdivision (community) varchar(20)
     */
    public $adminCode3;

    /**
     * @var string iso country code, 2 characters
     */
    public $countryCode;

    /**
     * @var string varchar(20)
     */
    public $postalcode;

    /**
     * @var string varchar(180)
     */
    public $placeName;

    /**
     * @var float estimated latitude (wgs84)
     */
    public $lat;

    /**
     * @var float estimated longitude (wgs84)
     */
    public $lng;
}