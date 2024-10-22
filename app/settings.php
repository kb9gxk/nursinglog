<?php

/* Primary Database */
define("DB_USER", "bst");
define("DB_PASS", "bt6pine6");
define("DB_NAME", "bst");
define("DB_HOST", "127.0.0.1");
define("DB_PORT", "3306");
define("base_path", $_SERVER["DOCUMENT_ROOT"] . "/");
date_default_timezone_set("America/Chicago");

/* Set all the cookie security stuff */
ini_set("session.cookie_secure", 1);
ini_set("session.cookie_httponly", 1);
ini_set("session.use_cookies", 1);
ini_set("session.use_only_cookies", 1);
ini_set("session.cookie_samesite", "Strict");
ini_set("session.cookie_path", "/");
ini_set("session.cookie_domain", PREFIX . ".nursinglog." . SUFFIX);
ini_set("session.cache_limiter", "nocache");
ini_set("session.use_trans_sid", 0);
ini_set("session.sid_length", 56);
ini_set("session.sid_bits_per_character", 6);
/* How far back should Full Log go */

/* Set Error Reporting Level */
ini_set("display_errors", 1);
error_reporting(E_ERROR | E_COMPILE_ERROR | E_CORE_ERROR | E_PARSE);
//error_reporting(E_ALL);
