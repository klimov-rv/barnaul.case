<?php
namespace Site\Main;

use Bitrix\Main\Context;

class Css
{
    protected static $defaultPath = SITE_TEMPLATE_PATH . '/css';

    public static function getFileContent($name) {
        $filePath = $_SERVER['DOCUMENT_ROOT'] . self::$defaultPath . '/' . $name;
        if (file_exists($filePath) && is_file($filePath)) {
            $fileContent = file_get_contents($filePath);
            return '<style>' . $fileContent . '</style>';
        }
    }

    public static $arFiles = array();

    public static function showInlineCss()
    {
        if(count(self::$arFiles)){
            echo "<style type=\"text/css\">";
            foreach (self::$arFiles as $arFile) {
                echo file_get_contents($_SERVER["DOCUMENT_ROOT"] . $arFile);
            }
            echo "</style>";
        }
    }

    public static function showInlineCssBlock($files)
    {
        if(count($files)){
            echo "<style type='text/css'>";
            foreach ($files as $arFile) {
                //$fileMin = str_replace(".css", ".min.css", $arFile);
                //echo file_get_contents($_SERVER["DOCUMENT_ROOT"] . $fileMin);
                echo file_get_contents($_SERVER["DOCUMENT_ROOT"] . $arFile);
            }
            echo "</style>";
        }
    }

    public static function addCss($path)
    {
        if(!array_search($path, self::$arFiles)){
            self::$arFiles[] = $path;
        }
    }

}