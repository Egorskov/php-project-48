<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;
use function Differ\Diff\genDiff;

class DiffTest extends TestCase
{
    public function testDiffJson()
    {
        $expected = file_get_contents(__DIR__ . "/fixtures/resultPath.txt");
        $this->assertEquals($expected, genDiff(__DIR__ . "/fixtures/file1.json",
            __DIR__ . "/fixtures/file2.json"));
    }
    public function testDiffYml()
    {
        $expected = file_get_contents(__DIR__ . "/fixtures/resultPath.txt");
        $this->assertEquals($expected, genDiff(__DIR__ . "/fixtures/file1.yml",
            __DIR__ . "/fixtures/file2.yaml"));
    }
}

