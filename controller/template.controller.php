<?php

# Create PHP class
class TemplateController
{

    # Method ctrTemplate -> include "views/template.php"
    public static function ctrTemplate()
    {
        include __DIR__ . '/../views/template.php';
    }

    public static function validateCsrf()
    {
        $token = $_POST['csrf_token'] ?? '';
        if (!is_string($token) || !hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
            throw new InvalidArgumentException('คำขอหมดอายุ กรุณาเปิดหน้าใหม่');
        }
    }
    public static function sanitizeInput($data)
    {
        if (!is_string($data)) throw new InvalidArgumentException('รูปแบบข้อมูลไม่ถูกต้อง');
        $data = trim($data);
        $data = stripslashes($data);
        return $data; // htmlspecialchars จะทำตอน Encode Output แทน
    }

    protected static $purifier;

    public static function initPurifier()
    {
        if (!self::$purifier) {
            $config = HTMLPurifier_Config::createDefault();
            $config->set('HTML.Allowed', 'p,b[style],i,u,span[style],font[style],font[color],div,br');
            $config->set('CSS.AllowedProperties', 'color,font,font-size,text-align,background-color');
            $config->set('AutoFormat.AutoParagraph', false);
	      //  $config->set('Core.DefinitionCache', null);
            self::$purifier = new HTMLPurifier($config);
        }
    }

   public static function encodeOutput(array $data)
    {
        self::initPurifier();

        $encodedData = [];
        foreach ($data as $row) {
            $encodedRow = [];
            foreach ($row as $key => $value) {
                $value = $value ?? '';
                // Fast-path: ถ้าไม่มี '<' ก็ไม่มี tag ให้ HTMLPurifier ต้อง parse/allow
                // ใช้ htmlspecialchars() แทนได้เลย (เร็วกว่า purify() มาก) - purify() เต็มรูปแบบ
                // เฉพาะค่าที่มี tag จริงๆ (เช่น rich-text remark ที่ต้อง allow บาง tag)
                if (!is_string($value) || strpos($value, '<') === false) {
                    $encodedRow[$key] = htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
                } else {
                    $encodedRow[$key] = self::$purifier->purify($value);
                }
            }
            $encodedData[] = $encodedRow;
        }
        return $encodedData;
    }

    // public static function convertFontToSpan($html)
    // {
    //     $html = preg_replace('/<font[^>]*color=["\']([^"\']+)["\'][^>]*>/i', '<span style="color:$1;">', $html);
    //     $html = str_ireplace('</font>', '</span>', $html);
    //     return $html;
    // }
    public static function convertFontToSpan($html)
    {
        // แปลง <font color="..." style="..."> หรือ <font style="..." color="..."> เป็น <span style="color:...; ...">
        $html = preg_replace_callback('/<font([^>]*)>/i', function ($matches) {
            $attributes = $matches[1];

            // ดึง color
            preg_match('/color=["\']?([^"\']+)["\']?/i', $attributes, $colorMatch);
            $color = isset($colorMatch[1]) ? $colorMatch[1] : null;

            // ดึง style
            preg_match('/style=["\']?([^"\']+)["\']?/i', $attributes, $styleMatch);
            $style = isset($styleMatch[1]) ? trim($styleMatch[1], '; ') : '';

            // รวม style ใหม่
            $styleParts = [];
            if ($color) {
                $styleParts[] = "color:$color";
            }
            if ($style) {
                $styleParts[] = $style;
            }

            $finalStyle = implode('; ', $styleParts);

            return '<span style="' . $finalStyle . '">';
        }, $html);

        // แทนที่ </font> ด้วย </span>
        $html = str_ireplace('</font>', '</span>', $html);

        return $html;
    }


    public static function ProcessAction()
    {
        echo '<div style="color:#fff;border:1px solid #fff;position: absolute;top:0;width:100%;background-color:#fff;height:1000px;">
        <center><div class="loader" style="margin-top:20%;"></div></center>
    </div>';
        echo '<script>    // ป้องกันการ refresh
        window.addEventListener("keydown", function (e) {
            if (e.key === "F5" || (e.ctrlKey && e.key.toLowerCase() === "r")) {
                e.preventDefault();
                alert("กำลังดำเนินการ กรุณารอ...");
            }
        });

        // ป้องกันปุ่ม back
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.go(1);
            alert("ไม่สามารถย้อนกลับได้ระหว่างดำเนินการ");
                };</script>';
    }
}
# Create PHP class
class controller_requested
{
   public static function callalert($title,$msg, $stat, $to)
    {
        $_SESSION['msg'] = $msg;
        $_SESSION['stat'] = $stat;
        $_SESSION['title'] = $title;
        echo " <script>  window.location.replace('?r=$to') </script>";
        exit();
    }
}