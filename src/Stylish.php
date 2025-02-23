<?php

namespace Differ\Stylish;

const SEPARATOR = ' ';
const LENGTH = 4;
const OFFSET = 2;

function formatter (array $ast, string $format)
{
    return match ($format) {
        'stylish' => toStylish($ast),
        default => throw new \Exception('Unknown style to formatter: ' . $format),
    };
}
function toStylish(array $ast, $depth = 1): string
{
    $indent = str_repeat(SEPARATOR, $depth * LENGTH - OFFSET);
    $backIndent = str_repeat(SEPARATOR, ($depth - 1) * LENGTH);

    $lines = array_map(function ($node) use ($indent, $backIndent, $depth) {
        switch ($node['status']) {
            case 'added':
                return "{$indent}+ {$node['key']}: " . normalizeString($node['value']);
            case 'deleted':
                return "{$indent}- {$node['key']}: " . normalizeString($node['value']);
            case 'changed':
                return [
                    "{$indent}- {$node['key']}: " . normalizeString($node['deletedValue']),
                    "{$indent}+ {$node['key']}: " . normalizeString($node['addedValue']),
                ];
            case 'isArray':
                return "{$indent}  {$node['key']}: " . toStylish($node['children'], $depth + 1);
            case 'unchanged':
                return "{$indent}  {$node['key']}: " . normalizeString($node['value']);
            default:
                throw new \Exception("Unknown status: {$node['status']}");
        }
    }, $ast);

    // Убираем вложенные массивы и объединяем их в одну строку
    $lines = array_merge(...array_map(function ($line) {
        return is_array($line) ? $line : [$line];
    }, $lines));

    return "{\n" . implode("\n", $lines) . "\n" . $backIndent . "}";

}

function normalizeString($string): string
{
    return trim(var_export($string, true), "'");
}