<?php

declare(strict_types=1);

/*
 * This file is part of Contao Alertbox Bundle.
 *
 * (c) Stefan Gruna
 *
 * @license LGPL-3.0-or-later
 */

namespace Slashworks\ContaoAlertboxBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Slashworks\ContaoAlertboxBundle\ContaoAlertboxBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(ContaoAlertboxBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
