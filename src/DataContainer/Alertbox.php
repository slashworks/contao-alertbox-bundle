<?php

declare(strict_types=1);

/*
 * This file is part of Contao Alertbox Bundle.
 *
 * (c) Stefan Gruna
 *
 * @license LGPL-3.0-or-later
 */

namespace Slashworks\ContaoAlertboxBundle\DataContainer;

use Contao\DataContainer;
use Contao\System;

class Alertbox
{
    public function getTypes(DataContainer $dc)
    {
        $types = [
            'type-standard',
            'type-job-offer',
        ];

        if (isset($GLOBALS['SW_ALERTBOX_HOOKS']['getTypes']) && \is_array($GLOBALS['SW_ALERTBOX_HOOKS']['getTypes'])) {
            foreach ($GLOBALS['SW_ALERTBOX_HOOKS']['getTypes'] as $callback) {
                $types = System::importStatic($callback[0])->{$callback[1]}($types, $dc);
            }
        }

        return $types;
    }
}
