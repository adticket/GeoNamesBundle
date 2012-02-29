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
 * @category DependencyInjection
 */

namespace Adticket\Sf2BundleOS\GeoNamesBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class AdticketGeoNamesExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();

        $config = $this->processConfiguration($configuration, $configs);
        foreach ($config as $k => $v) $container->setParameter('adticket.geonames.' . $k, $v);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');
    }
}
