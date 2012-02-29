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
 * @category Exception
 */

namespace Adticket\Sf2BundleOS\GeoNamesBundle\Exception;

/**
 * Package exception class
 *
 * @author Markus Tacker <m@coderbyheart.de>
 * @package AdTicket:Sf2BundleOS:AdticketGeoNamesBundle
 * @category Exception
 */
class ApiException extends Exception
{
    const AUTHORIZATION_EXCEPTION = 10;
    const RECORD_DOES_NOT_EXIST = 11;
    const OTHER_ERROR = 12;
    const DATABASE_TIMEOUT = 13;
    const INVALID_PARAMETER = 14;
    const NO_RESULT_FOUND = 15;
    const DUPLICATE_EXCEPTION = 16;
    const POSTALCODE_NOT_FOUND = 17;
    const DAILY_LIMIT_OF_CREDITS_EXCEEDED = 18;
    const HOURLY_LIMIT_OF_CREDITS_EXCEEDED = 19;
    const WEELKLY_LIMIT_OF_CREDITS_EXCEEDED = 20;
    const INVALID_INPUT = 21;
    const SERVER_OVERLOAD_EXCEPTION = 22;
    const SERVICE_NOT_IMPLEMENTED_EXCEPTION = 23;

    public static $errorCodeLabels = array(
        10 => 'Authorization Exception',
        11 => 'record does not exist',
        12 => 'other error',
        13 => 'database timeout',
        14 => 'invalid parameter',
        15 => 'no result found',
        16 => 'duplicate exception',
        17 => 'postal code not found',
        18 => 'daily limit of credits exceeded',
        19 => 'hourly limit of credits exceeded',
        20 => 'weekly limit of credits exceeded',
        21 => 'invalid input',
        22 => 'server overloaded exception',
        23 => 'service not implemented',
    );

    /**
     * @param $message
     * @param $code
     * @param $previous
     */
    public function __construct($message = null, $code = null, $previous = null)
    {
        if (isset(self::$errorCodeLabels[$code])) $message .= ' (' . self::$errorCodeLabels[$code] . ')';
        parent::__construct($message, $code, $previous);
    }
}