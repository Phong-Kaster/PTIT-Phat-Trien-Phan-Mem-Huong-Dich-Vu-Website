<?php
$langs = [];

// US English
$langs[] = [
    "code" => "en-US",
    "shortcode" => "en",
    "name" => "English",
    "localname" => "English"
];

// Vietname
$langs[] = [
    "code" => "vi-VN",
    "shortcode" => "vi",
    "name" => "Vietnam",
    "localname" => "Vietnam"
];


Config::set("applangs", $langs);
Config::set("default_applang", "en-US");
