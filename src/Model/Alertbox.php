<?php

declare(strict_types=1);

/*
 * This file is part of Contao Alertbox Bundle.
 *
 * (c) Stefan Gruna
 *
 * @license LGPL-3.0-or-later
 */

namespace Slashworks\ContaoAlertboxBundle\Model;

use Contao\Model;

/**
 * Class Alertbox.
 *
 * @property int $id
 * @property int $tstamp
 * @property string  $title
 * @property string  $type
 * @property string  $headline
 * @property string  $text
 * @property string  $url
 * @property bool $target
 * @property string  $linkTitle
 * @property string  $pages
 * @property bool $published
 */
class Alertbox extends Model
{
    protected static $strTable = 'tl_sw_alertbox';

    public static function findOnePublishedByPageId($pageId)
    {
        $t = static::$strTable;

        $options = [
            'column' => [
                "FIND_IN_SET($pageId, pages)",
            ],
            'value' => null,
            'limit' => 1,
            'return' => 'Model',
        ];

        if (!static::isPreviewMode($options)) {
            $options['column'][] = "$t.published = '1'";
        }

        return static::find($options);
    }
}
