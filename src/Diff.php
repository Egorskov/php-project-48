<?php

namespace Differ\Diff;

use function Functional\sort;
use function Differ\Parsers\parser;
use function Differ\Stylish\formatter;

function genDiff($file1, $file2, $format = 'stylish'): string
{
    $fileParse1 = parser($file1);
    $fileParse2 = parser($file2);
    $ast = makeAst($fileParse1, $fileParse2);
    $result = formatter($ast, $format);
    return $result;
}

function makeAst($fileParse1, $fileParse2)
{
    $allKeys = [...array_keys($fileParse1), ...array_keys($fileParse2)];
    $uniqueKeys = array_unique($allKeys);
    $keys = sort($uniqueKeys, fn($left, $right) => strcmp($left, $right));
    $tree = array_map(function ($key) use ($fileParse1, $fileParse2) {
        $value1 = array_key_exists($key, $fileParse1) ?? null;
        $value2 = array_key_exists($key, $fileParse2) ?? null;
        if (is_array($value1) && is_array($value2)) {
            return ['status' => 'isArray',
                'key' => $key,
                'children' => makeAst($value1,$value2)];
        }
        elseif (!array_key_exists($key, $fileParse1)) {
            return ['status' => 'added',
                'key' => $key,
                'value' => $value2];
        } elseif (!array_key_exists($key, $fileParse2)) {
            return ['status' => 'deleted',
                'key' => $key,
                'value' => $value1];
        } elseif ($value1 !== $value2) {
            return ['status' => 'changed',
                'key' => $key,
                'deletedValue' => $value1,
                'addedValue' => $value2];
        } else {
            return ['status' => 'unchanged',
                'key' => $key,
                'value' => $value1];
        }
    }, $keys);
    return $tree;
}
