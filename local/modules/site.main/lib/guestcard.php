<?php
namespace Site\Main;

class Guestcard
{
    const QR_CODE_SIZE = 125;
    const QR_CODE_DIR = "/upload/qrcode/";
    const QR_CODE_FILE_NAME = "qr.png";
    const QR_CODE_RESIZE_FILE_NAME = "qr_resize.png";
    const QR_CODE_BG_FILE_NAME = "card.png";
    const QR_CODE_CARD_FILE_NAME = "merge.png";

    public static function createQrCode($url, $hash) {
        $PNG_TEMP_DIR = $_SERVER['DOCUMENT_ROOT'].self::QR_CODE_DIR;
        $filename = $PNG_TEMP_DIR.$hash."-".self::QR_CODE_FILE_NAME;

        if (!file_exists($PNG_TEMP_DIR))
            mkdir($PNG_TEMP_DIR);

        // Генерация qr-кода
        \QRcode::png($url, $filename);

        // Ресайз qr-кода
        list($width, $height, $type) = getimagesize($filename);
        $newwidth = self::QR_CODE_SIZE;
        $newheight = self::QR_CODE_SIZE;
        $thumb = imagecreatetruecolor($newwidth, $newheight);
        $source = imagecreatefrompng($filename);
        imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        imagepng($thumb, $PNG_TEMP_DIR.$hash."-".self::QR_CODE_RESIZE_FILE_NAME);
        return self::createCard($hash);
    }

    public static function createCard($hash) {
        $PNG_TEMP_DIR = $_SERVER['DOCUMENT_ROOT'].self::QR_CODE_DIR;
        $cardBg = imagecreatefrompng($PNG_TEMP_DIR.self::QR_CODE_BG_FILE_NAME);
        $cardQrCode = imagecreatefrompng($PNG_TEMP_DIR.$hash."-".self::QR_CODE_RESIZE_FILE_NAME);

        // настройка прозрачности и фильтров
        imagealphablending($cardBg, false);
        imagesavealpha($cardBg, true);
        // объединение изображений
        imagecopymerge($cardBg, $cardQrCode, 350, 170, 0, 0, self::QR_CODE_SIZE, self::QR_CODE_SIZE, 100);
        // сохраняем изображение
        imagepng($cardBg, $PNG_TEMP_DIR.$hash."-".self::QR_CODE_CARD_FILE_NAME);

        unlink($PNG_TEMP_DIR.$hash."-".self::QR_CODE_FILE_NAME);
        unlink($PNG_TEMP_DIR.$hash."-".self::QR_CODE_RESIZE_FILE_NAME);
        imagedestroy($cardBg);
        imagedestroy($cardQrCode);

        return $PNG_TEMP_DIR.$hash."-".self::QR_CODE_CARD_FILE_NAME;
    }

}