<?php

function sh_ensure_package_visibility_column($dbh)
{
    static $done = false;
    if ($done) {
        return;
    }

    try {
        $query = $dbh->prepare("SELECT COUNT(*)
            FROM INFORMATION_SCHEMA.COLUMNS
            WHERE TABLE_SCHEMA = DATABASE()
              AND TABLE_NAME = 'tbltourpackages'
              AND COLUMN_NAME = 'is_active'");
        $query->execute();
        $exists = (int) $query->fetchColumn();

        if ($exists === 0) {
            $dbh->exec("ALTER TABLE tbltourpackages ADD COLUMN is_active TINYINT(1) NOT NULL DEFAULT 1");
        }
    } catch (Exception $e) {
        error_log('Package visibility column check failed: ' . $e->getMessage());
    }

    $done = true;
}
