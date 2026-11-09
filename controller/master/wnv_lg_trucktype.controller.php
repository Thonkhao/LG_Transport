<?php
class controller_wnv_lg_trucktype
{
    public static function GetTruckType()
    {
        $result = model_wnv_lg_trucktype::GetTruckType();
        return $result;
    }

    public static function Action_TruckType()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                TemplateController::validateCsrf();
                $action = TemplateController::sanitizeInput($_POST["action"] ?? '');
                if ($action === 'I') {
                    $TruckType = TemplateController::sanitizeInput($_POST['TruckType'] ?? '');
                    $TruckTypeName = TemplateController::sanitizeInput($_POST['TruckTypeName'] ?? '');
                    $Capacity = TemplateController::sanitizeInput($_POST['Capacity'] ?? '');
                    $Tolerance = TemplateController::sanitizeInput($_POST['Tolerance'] ?? '');
                    $Installment = TemplateController::sanitizeInput($_POST['Installment'] ?? '');
                    $DriverCost = TemplateController::sanitizeInput($_POST['DriverCost'] ?? '');
                    $HelperCost = TemplateController::sanitizeInput($_POST['HelperCost'] ?? '');
                    $FuelRate = TemplateController::sanitizeInput($_POST['FuelRate'] ?? '');
                    $WearCost = TemplateController::sanitizeInput($_POST['WearCost'] ?? '');
                    $MaintCost = TemplateController::sanitizeInput($_POST['MaintCost'] ?? '');
                    $TransRate = TemplateController::sanitizeInput($_POST['TransRate'] ?? '');
                    $Day = TemplateController::sanitizeInput($_POST['Day'] ?? '');
                    $LoadMin = TemplateController::sanitizeInput($_POST['LoadMin'] ?? '');
                    $BkkBan = TemplateController::sanitizeInput($_POST['BkkBan'] ?? '');
                    $MaxTrailer = TemplateController::sanitizeInput($_POST['MaxTrailer'] ?? '');
                    $NightCost = TemplateController::sanitizeInput($_POST['NightCost'] ?? '');
                } else if ($action === 'E') {
                    $Recordedit = TemplateController::sanitizeInput($_POST["Recordedit"] ?? '');
                    $ArrayReason = array_map('rawurldecode', explode("|", $Recordedit));
                    $TruckType = TemplateController::sanitizeInput($ArrayReason[0] ?? '');
                    $TruckTypeName = TemplateController::sanitizeInput($_POST['TruckTypeName'] ?? '');
                    $Capacity = TemplateController::sanitizeInput($_POST['Capacity'] ?? '');
                    $Tolerance = TemplateController::sanitizeInput($_POST['Tolerance'] ?? '');
                    $Installment = TemplateController::sanitizeInput($_POST['Installment'] ?? '');
                    $DriverCost = TemplateController::sanitizeInput($_POST['DriverCost'] ?? '');
                    $HelperCost = TemplateController::sanitizeInput($_POST['HelperCost'] ?? '');
                    $FuelRate = TemplateController::sanitizeInput($_POST['FuelRate'] ?? '');
                    $WearCost = TemplateController::sanitizeInput($_POST['WearCost'] ?? '');
                    $MaintCost = TemplateController::sanitizeInput($_POST['MaintCost'] ?? '');
                    $TransRate = TemplateController::sanitizeInput($_POST['TransRate'] ?? '');
                    $Day = TemplateController::sanitizeInput($_POST['Day'] ?? '');
                    $LoadMin = TemplateController::sanitizeInput($_POST['LoadMin'] ?? '');
                    $BkkBan = TemplateController::sanitizeInput($_POST['BkkBan'] ?? '');
                    $MaxTrailer = TemplateController::sanitizeInput($_POST['MaxTrailer'] ?? '');
                    $NightCost = TemplateController::sanitizeInput($_POST['NightCost'] ?? '');
                } else if ($action === 'D') {
                    $Recordedit = TemplateController::sanitizeInput($_POST["Recordedit"] ?? '');
                    $ArrayReason = array_map('rawurldecode', explode("|", $Recordedit));
                    $TruckType = TemplateController::sanitizeInput($ArrayReason[0] ?? '');
                    $TruckTypeName = null;
                    $Capacity = null;
                    $Tolerance = null;
                    $Installment = null;
                    $DriverCost = null;
                    $HelperCost = null;
                    $FuelRate = null;
                    $WearCost = null;
                    $MaintCost = null;
                    $TransRate = null;
                    $Day = null;
                    $LoadMin = null;
                    $BkkBan = null;
                    $MaxTrailer = null;
                    $NightCost = null;
                } else {
                    throw new InvalidArgumentException('Action ไม่ถูกต้อง');
                }
                if ($TruckType === '') {
                    throw new InvalidArgumentException('กรุณาระบุ Primary Key ให้ครบ');
                }
                TemplateController::ProcessAction();
                $result = model_wnv_lg_trucktype::Action_TruckType($TruckType, $TruckTypeName, $Capacity, $Tolerance, $Installment, $DriverCost, $HelperCost, $FuelRate, $WearCost, $MaintCost, $TransRate, $Day, $LoadMin, $BkkBan, $MaxTrailer, $NightCost, $action);
                if ($result === false) {
                    controller_requested::callalert('Truck Type', 'บันทึกไม่สำเร็จ กรุณาตรวจข้อมูล สิทธิ์ และ Stored Procedure', 'N', 'wnv_lg_trucktype&s=master');
                    return;
                }
                $massage = $result['massage'] ?? 'Procedure ไม่ส่งข้อความผลการทำงานกลับมา';
                $flag = $result['flag'] ?? 'N';
                controller_requested::callalert('Truck Type', $massage, $flag, 'wnv_lg_trucktype&s=master');
            } catch (InvalidArgumentException $e) {
                controller_requested::callalert('Truck Type', $e->getMessage(), 'N', 'wnv_lg_trucktype&s=master');
            }
        }
    }
}
