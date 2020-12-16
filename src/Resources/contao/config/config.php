<?php

/**
 * Backend modules
 */
$GLOBALS['BE_MOD']['content']['sw_alertboxes'] = array
(
    'tables' => array('tl_sw_alertbox'),
);


/**
 * Front end modules
 */
$GLOBALS['FE_MOD']['miscellaneous']['sw_alertbox'] = \Slashworks\ContaoAlertboxBundle\Module\Alertbox::class;


/**
 * Models
 */
$GLOBALS['TL_MODELS']['tl_sw_alertbox'] = \Slashworks\ContaoAlertboxBundle\Model\Alertbox::class;
