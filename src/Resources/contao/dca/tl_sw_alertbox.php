<?php

$GLOBALS['TL_DCA']['tl_sw_alertbox'] = array
(
    // Config
    'config'   => array
    (
        'dataContainer'     => 'Table',
        'enableVersioning'  => true,
        'onsubmit_callback' => array
        (),
        'sql'               => array
        (
            'keys' => array
            (
                'id' => 'primary',
            ),
        ),
    ),

    // List
    'list'     => array
    (
        'sorting'           => array
        (
            'mode'        => 2,
            'fields'      => array('title'),
            'panelLayout' => 'filter;sort,search,limit',
        ),
        'label'             => array
        (
            'fields' => array('title'),
        ),
        'global_operations' => array
        (
            'all' => array
            (
                'href'       => 'act=select',
                'class'      => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset()" accesskey="e"',
            ),
        ),
        'operations'        => array
        (
            'edit'   => array
            (
                'href' => 'act=edit',
                'icon' => 'edit.svg',
            ),
            'copy'   => array
            (
                'href' => 'act=copy',
                'icon' => 'copy.svg',
            ),
            'delete' => array
            (
                'href'       => 'act=delete',
                'icon'       => 'delete.svg',
                'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
            ),
            'toggle' => array
            (
                'attributes'           => 'onclick="Backend.getScrollOffset();"',
                'haste_ajax_operation' => array
                (
                    'field'   => 'published',
                    'options' => array
                    (
                        array
                        (
                            'value' => '',
                            'icon'  => 'invisible.svg',
                        ),
                        array
                        (
                            'value' => '1',
                            'icon'  => 'visible.svg',
                        ),
                    ),
                ),
            ),
            'show'   => array
            (
                'href' => 'act=show',
                'icon' => 'show.svg',
            ),
        ),
    ),

    // Palettes
    'palettes' => array
    (
        'default' => '{title_legend},title,type;{text_legend},headline,text;{link_legend},url,target,linkTitle;{page_legend},pages;{template_legend},customTpl;{publish_legend},published',
    ),

    // Fields
    'fields'   => array
    (
        'id'        => array
        (
            'sql' => "int(10) unsigned NOT NULL auto_increment",
        ),
        'tstamp'    => array
        (
            'sql' => "int(10) unsigned NOT NULL default 0",
        ),
        'title'     => array
        (
            'exclude'   => true,
            'search'    => true,
            'sorting'   => true,
            'flag'      => 1,
            'inputType' => 'text',
            'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'type'      => array
        (
            'exclude'          => true,
            'search'           => true,
            'sorting'          => true,
            'flag'             => 1,
            'inputType'        => 'select',
            'options_callback' => array(\Slashworks\ContaoAlertboxBundle\DataContainer\Alertbox::class, 'getTypes'),
            'reference'        => $GLOBALS['TL_LANG']['tl_sw_alertbox']['types'],
            'eval'             => array
            (
                'mandatory' => true,
                'tl_class'  => 'w50',
            ),
            'sql'              => "varchar(255) NOT NULL default ''",
        ),
        'headline'  => array
        (
            'exclude'   => true,
            'inputType' => 'inputUnit',
            'options'   => array('h1', 'h2', 'h3', 'h4', 'h5', 'h6'),
            'eval'      => array('maxlength' => 200, 'tl_class' => 'w50 clr'),
            'sql'       => "varchar(255) NOT NULL default 'a:2:{s:5:\"value\";s:0:\"\";s:4:\"unit\";s:2:\"h2\";}'",
        ),
        'text'      => array
        (
            'exclude'     => true,
            'search'      => true,
            'inputType'   => 'textarea',
            'eval'        => array('mandatory' => true, 'rte' => 'tinyMCE', 'helpwizard' => true, 'tl_class' => 'clr'),
            'explanation' => 'insertTags',
            'sql'         => "mediumtext NULL",
        ),
        'url'       => array
        (
            'label'     => &$GLOBALS['TL_LANG']['MSC']['url'],
            'exclude'   => true,
            'search'    => true,
            'inputType' => 'text',
            'eval'      => array(
                'rgxp'           => 'url',
                'decodeEntities' => true,
                'maxlength'      => 255,
                'dcaPicker'      => true,
                'addWizardClass' => false,
                'tl_class'       => 'w50',
            ),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'target'    => array
        (
            'label'     => &$GLOBALS['TL_LANG']['MSC']['target'],
            'exclude'   => true,
            'inputType' => 'checkbox',
            'eval'      => array('tl_class' => 'w50 m12'),
            'sql'       => "char(1) NOT NULL default ''",
        ),
        'linkTitle' => array
        (
            'exclude'   => true,
            'search'    => true,
            'inputType' => 'text',
            'eval'      => array('maxlength' => 255, 'tl_class' => 'w50'),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'pages'     => array
        (
            'exclude'    => true,
            'inputType'  => 'pageTree',
            'foreignKey' => 'tl_page.title',
            'eval'       => array('multiple' => true, 'fieldType' => 'checkbox', 'mandatory' => true, 'csv' => ','),
            'sql'        => "varchar(255)",
            'relation'   => array('type' => 'hasMany', 'load' => 'lazy'),
        ),
        'customTpl' => array
        (
            'exclude'          => true,
            'inputType'        => 'select',
            'options_callback' => static function (Contao\DataContainer $dc) {
                return Contao\Controller::getTemplateGroup('mod_sw_alertbox_', array(),
                    'mod_sw_alertbox');
            },
            'eval'             => array('includeBlankOption' => true, 'chosen' => true, 'tl_class' => 'w50'),
            'sql'              => "varchar(64) NOT NULL default ''",
        ),
        'published' => array
        (
            'exclude'   => true,
            'filter'    => true,
            'inputType' => 'checkbox',
            'sql'       => "char(1) NOT NULL default ''",
        ),
    ),
);
