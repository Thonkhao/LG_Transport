<?php
// รูปแบบเดียวกับ wnv_authgroup.model.php: รับค่าทีละช่อง ไม่รับ PDO หรือ metadata จาก Controller
class model_wnv_lg_truckdowngrade
{
    public static function GetTruckDowngrade()
    {
        try {
            $conn = DBConnection::getConnection();
            $sql = "SELECT [DeliveryZone], [DowngradeStep], [TruckType]
                    FROM [dbo].[WNV_LG_TruckDowngrade]
                    ORDER BY [DeliveryZone], [DowngradeStep], [TruckType]";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("[" . date('Y-m-d H:i:s') . "] " . $e->getMessage());
            return false;
        }
    }

    public static function Action_TruckDowngrade($DeliveryZone, $DowngradeStep, $TruckType, $action)
    {
        try {

            $conn = DBConnection::getConnection();
            $sql = "EXEC [dbo].[WNV_LG_TruckDowngradeInsUpDelSp] @DeliveryZone=:DeliveryZone, @DowngradeStep=:DowngradeStep, @TruckType=:TruckType, @action=:action";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':DeliveryZone', $DeliveryZone, $DeliveryZone === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':DowngradeStep', $DowngradeStep, $DowngradeStep === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':TruckType', $TruckType, $TruckType === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':action', $action, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("[" . date('Y-m-d H:i:s') . "] " . $e->getMessage());
            return false;
        }
    }
}
