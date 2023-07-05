<?php

$types[] = 'Zenski';
$types[] = 'Muski';
$types[] = 'Pletenice';
$types[] = 'Farbanje';
$types[] = 'Svecane frizure';


$query = $_REQUEST['query'];
$suggestion = "";

if ($query !== "") {
    $query = strtolower($query);
    $length = strlen($query);

    foreach ($types as $type) {
        if (stristr($query, substr($type, 0, $length))) {
            if ($suggestion == "") {
                $suggestion = $type;
            } else {
                $suggestion .= ", $type";
            }
        }
    }
}
if ($suggestion == "") {
    echo 'No suggestions';
} else {
    echo $suggestion;
}
