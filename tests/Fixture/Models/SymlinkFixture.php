<?php

namespace MoveElevator\Composer\Tests\Fixture\Models;

use MoveElevator\Composer\Models\Symlink;

trait SymlinkFixture
{
    /**
     * @var string
     */
    protected $source = __DIR__;

    /**
     * @var string
     */
    protected $target = __DIR__;

    protected function getSymlinkFixtureObject($source = null, $target = null): Symlink
    {
        $newSource = $this->source;
        $newTarget = $this->target;

        if (null !== $source) {
            $newSource = $source;
        }

        if (null !== $target) {
            $newTarget = $target;
        }

        return new Symlink($newSource, $newTarget);
    }
}
