<?php
declare(strict_types=1);

namespace MoveElevator\Composer\Models;

use ArrayObject;
use TypeError;

final class SymlinkCollection extends ArrayObject
{
    /**
     * @throws TypeError
     */
    public function append($value): void
    {
        if (false === $value instanceof Symlink) {
            throw new TypeError('You only can append Objects of type ' . Symlink::class);
        }

        parent::append($value);
    }

    public function multipleAppend(SymlinkCollection $symlinks): void
    {
        foreach ($symlinks as $symlink) {
            $this->append($symlink);
        }
    }
}
