<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;
use function Differ\Diff\genDiff;

class DiffTest extends TestCase
{
    public function testDiffJson()
    {
        $expected = file_get_contents(__DIR__ . "/fixtures/result.txt");
        $this->assertEquals($expected, genDiff(__DIR__ . "/fixtures/testfile1.json",
            __DIR__ . "/fixtures/testfile2.json"));
    }
    public function testDiffYml()
    {
        $expected = file_get_contents(__DIR__ . "/fixtures/result.txt");
        $this->assertEquals($expected, genDiff(__DIR__ . "/fixtures/testfile1.yaml",
            __DIR__ . "/fixtures/testfile2.yml"));
    }
}

