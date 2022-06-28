<?php 
require_once APPPATH.'/config/common.config.php'; // Common configuration
require_once APPPATH.'/config/i18n.config.php'; // i18n configuration

// ASCII Secure random crypto key
define("CRYPTO_KEY", "def00000be0dcaf25c0fb561a6b3253caeef04105f48d2f6cb9e1d7be738d3f8a94a21d79875e02d610bfc31ebff285a9bc31b3d5ef4cb939d60c435ec86e7eb82483123");

// General purpose salt
define("NP_SALT", "ypWYK2YoVUTRbBH2");


// API URL
define("APIURL", APPURL."/api");

// Path to instagram sessions directory
define("SESSIONS_PATH", APPPATH . "/sessions");
// Path to temporary files directory
define("TEMP_PATH", ROOTPATH . "/assets/uploads/temp");
