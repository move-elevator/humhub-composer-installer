<?php

namespace MoveElevator\Composer\Tests\Unit\Models;

use MoveElevator\Composer\Models\SymlinkCollection;
use MoveElevator\Composer\Tests\Fixture\Models\SymlinkFixture;
use PHPUnit\Framework\TestCase;

class SymlinkCollectionTest extends TestCase
{
    use SymlinkFixture;

    public function testAppendSymlinkToCollection()
    {
        $collection = new SymlinkCollection();
        $symlink = $this->getSymlinkFixtureObject();

        $collection->append($symlink);

        $this->assertEquals($collection->offsetGet(0), $symlink);
        $this->assertEquals(1, $collection->count());
    }

    /**
     * @param mixed $element
     *
     * @dataProvider provideWrongSymlinkCollectionTypes
     */
    public function testExceptionWhileAppendSymlinkToCollection($element)
    {
        $this->expectException(\TypeError::class);

        $collection = new SymlinkCollection();
        $collection->append($element);
    }

    /**
     * @return array
     */
    public function provideWrongSymlinkCollectionTypes()
    {
        return [
            [['array']],
            [1],
            [new \stdClass()]
        ];
    }

    public function testAppendMultipleSymlinksToCollection()
    {
        $collection1 = new SymlinkCollection();
        $symlink1 = $this->getSymlinkFixtureObject();
        $collection1->append($symlink1);
        $symlink2 = $this->getSymlinkFixtureObject(__DIR__ . '/../', __DIR__);
        $collection1->append($symlink2);

        $this->assertEquals($collection1->offsetGet(0), $symlink1);
        $this->assertEquals($collection1->offsetGet(1), $symlink2);
        $this->assertEquals(2, $collection1->count());

        $collection2 = new SymlinkCollection();
        $collection2->multipleAppend($collection1);

        $this->assertEquals($collection2->offsetGet(0), $symlink1);
        $this->assertEquals($collection2->offsetGet(1), $symlink2);
        $this->assertEquals(2, $collection2->count());
    }

    public function testExceptionWhileAppendArrayToCollection()
    {
        $this->expectException(\TypeError::class);

        $collection = new SymlinkCollection();
        $collection->append([]);
    }
}
