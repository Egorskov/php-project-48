<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;
use function Differ\Diff\genDiff;

class DiffTests extends TestCase
{
    public function testDiff()
    {
        $expected = file_get_contents("resultJson.txt");
        $this->assertEquals($expected, genDiff("file1.json", "/Users/egorgorskov/file2.json"));
    }
}

