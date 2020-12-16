<?php

declare(strict_types=1);

/*
 * This file is part of Contao Alertbox Bundle.
 *
 * (c) Stefan Gruna
 *
 * @license LGPL-3.0-or-later
 */

namespace Slashworks\ContaoAlertboxBundle\Tests;

use PHPUnit\Framework\TestCase;
use Slashworks\ContaoAlertboxBundle\SlashworksAlertboxBundle;

class ContaoAlertboxBundle extends TestCase
{
    public function testCanBeInstantiated(): void
    {
        $bundle = new SlashworksAlertboxBundle();

        $this->assertInstanceOf('Slashworks\ContaoAlertboxBundle\ContaoAlertboxBundle', $bundle);
    }
}
