<?php
session_start();
date_default_timezone_set('Asia/Bangkok');
require_once __DIR__ . '/controller/template.controller.php';

require_once __DIR__ . '/controller/master/wnv_lg_transportspeed.controller.php';
require_once __DIR__ . '/controller/master/wnv_lg_deliverylocation.controller.php';
require_once __DIR__ . '/controller/master/wnv_lg_deliverytimewindow.controller.php';
require_once __DIR__ . '/controller/master/wnv_lg_trucktype.controller.php';
require_once __DIR__ . '/controller/master/wnv_lg_sobooking.controller.php';
require_once __DIR__ . '/controller/master/wnv_lg_deliverytime.controller.php';
require_once __DIR__ . '/controller/master/wnv_lg_truckdowngrade.controller.php';
require_once __DIR__ . '/controller/master/wnv_lg_trailerrate.controller.php';

require_once __DIR__ . '/Models/master/wnv_lg_transportspeed.model.php';
require_once __DIR__ . '/Models/master/wnv_lg_deliverylocation.model.php';
require_once __DIR__ . '/Models/master/wnv_lg_deliverytimewindow.model.php';
require_once __DIR__ . '/Models/master/wnv_lg_trucktype.model.php';
require_once __DIR__ . '/Models/master/wnv_lg_sobooking.model.php';
require_once __DIR__ . '/Models/master/wnv_lg_deliverytime.model.php';
require_once __DIR__ . '/Models/master/wnv_lg_truckdowngrade.model.php';
require_once __DIR__ . '/Models/master/wnv_lg_trailerrate.model.php';

// ป้องกันการแสดงข้อความจากฐานข้อมูลเป็น HTML
function h($value) {
    return htmlspecialchars((string)($value ?? ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
$_SESSION['csrf_token'] = $_SESSION['csrf_token'] ?? bin2hex(random_bytes(32));
$bootstrapError = null;
try {
    if (!extension_loaded('pdo_sqlsrv')) {
        throw new RuntimeException('PHP ยังไม่ได้เปิด pdo_sqlsrv สำหรับเชื่อม SQL Server');
    }
    require_once __DIR__ . '/dbconnect/Connect.php';
} catch (Throwable $e) {
    error_log('LG Transport: ' . $e->getMessage());
    http_response_code(503);
    $bootstrapError = 'กรุณาตรวจ pdo_sqlsrv, autoload.php และ .env ตาม Connect.php ก่อนใช้งาน';
}
$template = new TemplateController();
$template->ctrTemplate();
