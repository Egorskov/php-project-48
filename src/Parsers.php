<?php

namespace Differ\Parsers;

use Symfony\Component\Yaml\Yaml;

function parser($file)
{
    $extension = getExtension($file);
    switch ($extension) {
        case 'json':
            return json_decode(file_get_contents($file), true);
        case 'yaml':
            //return (array)Yaml::parse(file_get_contents($file), Yaml::PARSE_OBJECT_FOR_MAP);
        case 'yml':
            return Yaml::parse(file_get_contents($file), Yaml::PARSE_OBJECT_FOR_MAP);
        default:
            throw new \Exception('Unknown extension  for Parser: ' . $extension);
    }
}

function getExtension($file): string
{
    return pathinfo($file, PATHINFO_EXTENSION);
}
