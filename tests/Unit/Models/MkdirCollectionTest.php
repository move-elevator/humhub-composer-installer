<?php

namespace MoveElevator\Composer\Tests\Unit\Models;

use MoveElevator\Composer\Models\MkdirCollection;
use PHPUnit\Framework\TestCase;

class MkdirCollectionTest extends TestCase
{
    public function testAppendStringToCollection()
    {
        $testValue = 'test';
        $collection = new MkdirCollection();
        $collection->append($testValue);

        $this->assertEquals($testValue, $collection->offsetGet(0));
    }

    /**
     * @param mixed $element
     *
     * @dataProvider provideWrongSymlinkCollectionTypes
     */
    public function testExceptionWhileAppendMkdirCollection($element)
    {
        $this->expectException(\TypeError::class);

        $collection = new MkdirCollection();
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
}
