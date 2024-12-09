<?php

namespace Differ\Parsers;

use Symfony\Component\Yaml\Yaml;

function parser($file)
{
    $format = getExtension($file);
    switch ($format) {
        case 'json':
            return json_decode(file_get_contents($file), true);
        case 'yaml':
            //return (array)Yaml::parse(file_get_contents($file), Yaml::PARSE_OBJECT_FOR_MAP);
        case 'yml':
            return (array)Yaml::parse(file_get_contents($file), Yaml::PARSE_OBJECT_FOR_MAP);
            default:
                throw new \Exception('Unknown extension  for Parser: ' . $format);
    }
}

function getExtension ($file)
{
    return pathinfo($file, PATHINFO_EXTENSION);
}