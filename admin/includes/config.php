<?php
require_once dirname(__DIR__, 2) . '/includes/helpers.php';

$localConfig = __DIR__ . '/config.local.php';
if (is_file($localConfig)) {
    require $localConfig;
}

defined('DB_HOST') || define('DB_HOST', env_value('DB_HOST', 'localhost'));
defined('DB_USER') || define('DB_USER', env_value('DB_USER', 'root'));
defined('DB_PASS') || define('DB_PASS', env_value('DB_PASS', ''));
defined('DB_NAME') || define('DB_NAME', env_value('DB_NAME', 'tms'));

if (!DB_USER || !DB_NAME) {
    exit('Database configuration is missing.');
}

try {
    $dbh = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME,
        DB_USER,
        DB_PASS,
        [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        ]
    );
} catch (PDOException $e) {
    error_log($e->getMessage());
    exit('Database connection failed.');
}
?>
