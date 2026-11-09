<?php
$bootstrapError = $GLOBALS['bootstrapError'] ?? null;
$_route = $_GET['r'] ?? 'wnv_lg_transportspeed';
if (!is_string($_route) || (isset($_GET['s']) && $_GET['s'] !== 'master')) {
    http_response_code(404); exit('ไม่พบหน้า');
}
$_route = strtolower($_route);
switch ($_route) {
    case 'wnv_lg_transportspeed':
        $pageTitle = 'Transport Speed';
        $moduleFile = __DIR__ . '/modules/Master/WNV_LG_TransportSpeed.php';
        break;
    case 'wnv_lg_deliverylocation':
        $pageTitle = 'Delivery Location';
        $moduleFile = __DIR__ . '/modules/Master/WNV_LG_DeliveryLocation.php';
        break;
    case 'wnv_lg_deliverytimewindow':
        $pageTitle = 'Delivery Time Window';
        $moduleFile = __DIR__ . '/modules/Master/WNV_LG_DeliveryTimeWindow.php';
        break;
    case 'wnv_lg_trucktype':
        $pageTitle = 'Truck Type';
        $moduleFile = __DIR__ . '/modules/Master/WNV_LG_TruckType.php';
        break;
    case 'wnv_lg_sobooking':
        $pageTitle = 'SO Booking';
        $moduleFile = __DIR__ . '/modules/Master/WNV_LG_SOBooking.php';
        break;
    case 'wnv_lg_deliverytime':
        $pageTitle = 'Delivery Time';
        $moduleFile = __DIR__ . '/modules/Master/WNV_LG_DeliveryTime.php';
        break;
    case 'wnv_lg_truckdowngrade':
        $pageTitle = 'Truck Downgrade';
        $moduleFile = __DIR__ . '/modules/Master/WNV_LG_TruckDowngrade.php';
        break;
    case 'wnv_lg_trailerrate':
        $pageTitle = 'Trailer Rate';
        $moduleFile = __DIR__ . '/modules/Master/WNV_LG_TrailerRate.php';
        break;
    default:
        http_response_code(404); exit('ไม่พบหน้า');
}
?>
<!doctype html>
<html lang="th">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= h($pageTitle) ?> · LG Transport</title>
<link rel="stylesheet" href="views/component/css/adminlteV3.2.0.css">
<link rel="stylesheet" href="views/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="views/plugins/toastr/toastr.min.css">
<link rel="stylesheet" href="views/css/master.css">
</head>
<body>
<?php include __DIR__ . '/../theme/Header.php'; ?>
<?php include __DIR__ . '/../theme/Navbar.php'; ?>
<?php include __DIR__ . '/../theme/Script.php'; ?>
<main>
    <?php include $moduleFile; ?>
</main>
<div id="loading-overlay" role="status" style="display:none;">กำลังดำเนินการ กรุณารอ...</div>
<?php
if (isset($_SESSION['msg'])) {
    $args = json_encode([$_SESSION['title'], $_SESSION['msg'], $_SESSION['stat']],
        JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    echo '<script>$(function(){toastralert.apply(null,' . $args . ');});</script>';
    unset($_SESSION['msg'], $_SESSION['stat'], $_SESSION['title']);
}
?>
</body>
</html>
