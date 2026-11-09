<?php
// รูปแบบเดียวกับ wnv_authgroup.model.php: รับค่าทีละช่อง ไม่รับ PDO หรือ metadata จาก Controller
class model_wnv_lg_transportspeed
{
    public static function GetTransportSpeed()
    {
        try {
            $conn = DBConnection::getConnection();
            $sql = "SELECT [Code], [Desc], [Speed]
                    FROM [dbo].[WNV_LG_TransportSpeed]
                    ORDER BY [Code]";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("[" . date('Y-m-d H:i:s') . "] " . $e->getMessage());
            return false;
        }
    }

    public static function Action_TransportSpeed($Code, $Desc, $Speed, $action)
    {
        try {
            $Desc = ($Desc === '') ? null : $Desc;
            $Speed = ($Speed === '') ? null : $Speed;
            $conn = DBConnection::getConnection();
            $sql = "EXEC [dbo].[WNV_LG_TransportSpeedInsUpDelSp] @Code=:Code, @Desc=:Desc, @Speed=:Speed, @action=:action";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':Code', $Code, $Code === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':Desc', $Desc, $Desc === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':Speed', $Speed, $Speed === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':action', $action, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("[" . date('Y-m-d H:i:s') . "] " . $e->getMessage());
            return false;
        }
    }
}
