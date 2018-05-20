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

class Localization
{
    /**
     * @var string
     */
    private $locale;

    public function __construct(string $language, ?string $country = null)
    {
        $this->locale = implode('_', array_filter([$language, $country]));
    }

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function getLanguage(): string
    {
        $parts = explode('_', $this->locale);

        return $parts[0];
    }

    public function getCountry(): ?string
    {
        $parts = explode('_', $this->locale);

        return isset($parts[1]) ? $parts[1] : null;
    }

    public function equal(Localization $localization): bool
    {
        return $this->locale === $localization->getLocale();
    }

    public function __toString(): string
    {
        return $this->locale;
    }

}
