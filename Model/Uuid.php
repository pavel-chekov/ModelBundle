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

use Ramsey\Uuid\Uuid as RamseyUuid;

class Uuid
{
    /**
     * @var string
     */
    private $id;

    public function __construct(?string $id = null)
    {
        $this->id = $id ?: RamseyUuid::uuid4()->toString();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return $this->id;
    }
}
