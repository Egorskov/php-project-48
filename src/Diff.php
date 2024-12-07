<?php

namespace Differ\Diff;

use function Functional\sort;

function genDiff($file1, $file2)
{
    $fileParse1 = json_decode(file_get_contents($file1), true);
    $fileParse2 = json_decode(file_get_contents($file2), true);
    $allKeys = array_merge(array_keys($fileParse1), array_keys($fileParse2));
    $uniqueKeys = array_unique($allKeys);
    $keys = sort($uniqueKeys, fn($left, $right) => strcmp($left, $right));
    $arrayForJson = array_reduce($keys, function ($acc, $key) use ($fileParse1, $fileParse2) {
        $value1 = array_key_exists($key, $fileParse1) ? normalizeString($fileParse1[$key]) : null;
        $value2 = array_key_exists($key, $fileParse2) ? normalizeString($fileParse2[$key]) : null;
        if (!array_key_exists($key, $fileParse1)) {
            return [...$acc,"+ {$key}: {$value2}"];
        } elseif (!array_key_exists($key, $fileParse2)) {
            return [...$acc,"- {$key}: {$value1}"];
        } elseif ($value1 != $value2) {
            return [...$acc,"- {$key}: {$value1}\n+ {$key}: {$value2}"];
        } else {
            return [...$acc, "  {$key}: $value1"];
        }
    }, []);
    $result = ['{', ...$arrayForJson, '}'];
    $result = implode("\n", $result);
    return $result;
}

function normalizeString($string): string
{
    return str_replace([",", "'", " "], '', var_export($string, true));
}
