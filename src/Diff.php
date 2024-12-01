<?php

namespace Differ\Diff;
function genDiff($file1, $file2)
{
    $fileParse1 = json_decode(file_get_contents($file1));
    $fileParse2 = json_decode(file_get_contents($file2));
    return [$fileParse1, $fileParse2];
}


//$diffa = genDiff('file1.json',  '/Users/egorgorskov/file2.json');
//print_r($diffa);