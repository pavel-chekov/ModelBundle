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

trait UuidTrait
{
    /**
     * @var Uuid
     */
    protected $uuid;

    protected function initializeUuid(?Uuid $uuid = null)
    {
        $this->uuid = $uuid ?: new Uuid();
    }

    public function getId(): string
    {
        return $this->uuid->getId();
    }

    public function getUuid(): Uuid
    {
        return $this->uuid;
    }
}
