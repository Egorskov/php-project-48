<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;
use function Differ\Diff\genDiff;

class DiffTest extends TestCase
{
    public function testDiff()
    {
        $expected = file_get_contents(__DIR__ . "/fixtures/resultJson.txt");
        $this->assertEquals($expected, genDiff(__DIR__ . "/fixtures/testfile1.json",
            __DIR__ . "/fixtures/testfile2.json"));
    }
}

