<?php

declare(strict_types=1);

/*
 * This file is part of Contao Alertbox Bundle.
 *
 * (c) Stefan Gruna
 *
 * @license LGPL-3.0-or-later
 */

namespace Slashworks\ContaoAlertboxBundle\Module;

use Contao\PageModel;
use Contao\StringUtil;
use Haste\Frontend\AbstractFrontendModule;

class Alertbox extends AbstractFrontendModule
{
    protected $strTemplate = 'mod_sw_alertbox';

    /**
     * @var \Slashworks\ContaoAlertboxBundle\Model\Alertbox|null
     */
    protected $alertboxModel;

    public function generate()
    {
        if (TL_MODE === 'BE') {
            return parent::generate();
        }

        /** @var PageModel $objPage */
        global $objPage;

        $this->alertboxModel = \Slashworks\ContaoAlertboxBundle\Model\Alertbox::findOnePublishedByPageId($objPage->id);

        if (null === $this->alertboxModel) {
            return false;
        }

        if ($this->alertboxModel->customTpl) {
            $this->strTemplate = $this->alertboxModel->customTpl;
        }

        return parent::generate();
    }

    protected function compile(): void
    {
        $this->Template->type = $this->alertboxModel->type;

        $headline = StringUtil::deserialize($this->alertboxModel->headline);
        $this->headline = \is_array($headline) ? $headline['value'] : $headline;
        $this->hl = \is_array($headline) ? $headline['unit'] : 'h2';

        $this->alert->text = StringUtil::toHtml5($this->alertboxModel->text);
        $this->Template->text = StringUtil::encodeEmail($this->alertboxModel->text);

        $this->compileLink();
    }

    protected function compileLink(): void
    {
        if (0 === strncmp($this->alertboxModel->url, 'mailto:', 7)) {
            $this->alertboxModel->url = StringUtil::encodeEmail($this->alertboxModel->url);
        } else {
            $this->alertboxModel->url = ampersand($this->alertboxModel->url);
        }

        if ('' === $this->alertboxModel->linkTitle) {
            $this->alertboxModel->linkTitle = $this->alertboxModel->url;
        }

        $this->Template->href = $this->alertboxModel->url;
        $this->Template->link = $this->alertboxModel->linkTitle;
        $this->Template->target = '';
        $this->Template->rel = '';

        // Override the link target
        if ($this->alertboxModel->target) {
            $this->Template->target = ' target="_blank"';
            $this->Template->rel = ' rel="noreferrer noopener"';
        }

        $this->Template->buttonClass = 'button button-small';

        if ('type-standard' === $this->alertboxModel->type) {
            $this->Template->buttonClass .= ' button-secondary';
        }

        // Unset the title attributes in the back end (see #6258)
        if (TL_MODE === 'BE') {
            $this->Template->title = '';
            $this->Template->linkTitle = '';
        }
    }
}
