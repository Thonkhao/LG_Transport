<?php
// รูปแบบเดียวกับ wnv_authgroup.model.php: รับค่าทีละช่อง ไม่รับ PDO หรือ metadata จาก Controller
class model_wnv_lg_trailerrate
{
    public static function GetTrailerRate()
    {
        try {
            $conn = DBConnection::getConnection();
            $sql = "SELECT [TruckType], [TrailerNo], [TrailerCost]
                    FROM [dbo].[WNV_LG_TrailerRate]
                    ORDER BY [TruckType], [TrailerNo]";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("[" . date('Y-m-d H:i:s') . "] " . $e->getMessage());
            return false;
        }
    }

    public static function Action_TrailerRate($TruckType, $TrailerNo, $TrailerCost, $action)
    {
        try {
            $TrailerCost = ($TrailerCost === '') ? null : $TrailerCost;
            $conn = DBConnection::getConnection();
            $sql = "EXEC [dbo].[WNV_LG_TrailerRateInsUpDelSp] @TruckType=:TruckType, @TrailerNo=:TrailerNo, @TrailerCost=:TrailerCost, @action=:action";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':TruckType', $TruckType, $TruckType === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':TrailerNo', $TrailerNo, $TrailerNo === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':TrailerCost', $TrailerCost, $TrailerCost === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':action', $action, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("[" . date('Y-m-d H:i:s') . "] " . $e->getMessage());
            return false;
        }
    }
}
