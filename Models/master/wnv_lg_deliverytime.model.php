<?php
// รูปแบบเดียวกับ wnv_authgroup.model.php: รับค่าทีละช่อง ไม่รับ PDO หรือ metadata จาก Controller
class model_wnv_lg_deliverytime
{
    public static function GetDeliveryTime()
    {
        try {
            $conn = DBConnection::getConnection();
            $sql = "SELECT [TimeType], [DurationSec]
                    FROM [dbo].[WNV_LG_DeliveryTime]
                    ORDER BY [TimeType]";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("[" . date('Y-m-d H:i:s') . "] " . $e->getMessage());
            return false;
        }
    }

    public static function Action_DeliveryTime($TimeType, $DurationSec, $action)
    {
        try {
            $DurationSec = ($DurationSec === '') ? null : $DurationSec;
            $conn = DBConnection::getConnection();
            $sql = "EXEC [dbo].[WNV_LG_DeliveryTimeInsUpDelSp] @TimeType=:TimeType, @DurationSec=:DurationSec, @action=:action";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':TimeType', $TimeType, $TimeType === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':DurationSec', $DurationSec, $DurationSec === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':action', $action, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("[" . date('Y-m-d H:i:s') . "] " . $e->getMessage());
            return false;
        }
    }
}
