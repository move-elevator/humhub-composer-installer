<?php

namespace MoveElevator\Composer\Tests\Unit\Models;

use MoveElevator\Composer\Tests\Fixture\Models\SymlinkFixture;
use PHPUnit\Framework\TestCase;

class SymlinkTest extends TestCase
{
    use SymlinkFixture;

    public function testGetterOfObject()
    {
        $symlink = $this->getSymlinkFixtureObject();

        $this->assertEquals($this->source, $symlink->getSource());
        $this->assertEquals($this->target, $symlink->getTarget());
    }

    public function testGetSymlinkOfNotExistingSource()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->getSymlinkFixtureObject('test');
    }

    public function testGetSymlinkOfExistingSourceAndNotExistingTarget()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->getSymlinkFixtureObject(null, '');
    }
}
