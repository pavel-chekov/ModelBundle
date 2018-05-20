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

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

trait TranslateableTrait
{
    /**
     * @var Collection|TranslationInterface[]
     */
    protected $translations;

    /**
     * @var Localization
     */
    protected $currentLocalization;

    protected function initializeTranslations(?Collection $translations = null)
    {
        $this->translations = $translations ?: new ArrayCollection();
    }

    public function setCurrentLocalization(Localization $currentLocalization): void
    {
        $this->currentLocalization = $currentLocalization;
    }

    public function getTranslation(
        ?Localization $localization = null,
        bool $createIfNotExist = false
    ): ?TranslationInterface {
        $localization = $localization ?: $this->currentLocalization;

        foreach ($this->translations as $translation) {
            if ($localization->equal($translation->getLocalization())) {
                return $translation;
            }
        }

        if ($createIfNotExist) {
            return $this->createTranslation($localization);
        }

        return null;
    }

    abstract protected function createTranslation(Localization $localization): TranslationInterface;
}
