<?php
declare(strict_types=1);

namespace MoveElevator\Composer\Models;

final class MkdirCollection extends \ArrayObject
{
    /**
     * @param mixed $value
     *
     * @throws \TypeError
     */
    public function append($value)
    {
        if (false === is_string($value)) {
            throw new \TypeError('You only can append Objects of type string');
        }

        parent::append($value);
    }
}
