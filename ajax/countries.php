<?php

$country_list = array(
    "Albania",
    "Bosnia and Herzegovina",
    "Bulgaria",
    "Croatia",
    "Greece",
    "Macedonia",
    "Montenegro",
    "Romania",
    "Serbia",
    "Slovenia",
);



if (isset($_REQUEST['query'])) {
    $query = $_REQUEST['query'];
    $suggestion = "";

    if ($query != "") {
        $query = strtolower($query);
        $len = strlen($query);
        foreach ($country_list as $country) {
            if (stristr($query, substr($country, 0, $len))) {
                if ($suggestion === "") {
                    $suggestion = $country;
                } else {
                    $suggestion .= ", $country";
                }
            }
        }
    }
    echo $suggestion === "" ? "No suggested countries" : $suggestion;
}
