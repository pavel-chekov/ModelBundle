<?php

/*
 * This file is part of ChekovModelBundle package.
 *
 * (c) Chekov Bundles <https://github.com/pavel-chekov>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Chekov\Bundle\ModelBundle\Model;

trait TranslationTrait
{
    /**
     * @var Localization
     */
    protected $localization;

    public function setLocalization(Localization $localization)
    {
        $this->localization = $localization;

        return $this;
    }

    public function getLocalization(): Localization
    {
        return $this->localization;
    }

    public function getLocale(): string
    {
        return $this->localization->getLocale();
    }
}
