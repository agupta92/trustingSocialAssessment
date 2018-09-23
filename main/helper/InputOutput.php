<?php
/**
 * Created by PhpStorm.
 * User: ankit
 * Date: 22/09/18
 * Time: 10:44 PM
 */
namespace main\helper;

include_once (__DIR__."/../../vendor/autoload.php");
use Bcremer\LineReader\LineReader;

class InputOutput
{
    /**
     * @param $filePath
     * @return array Mapping of PhoneNumber with all the activation/de-activation records within it.
     */
    public static function readFileAndFilterData($filePath){
        if(!self::checkFileExists($filePath)){
            return false;
        }
        $phoneMapping = [];
        foreach (LineReader::readLines($filePath) as $line) {
            $lineArray = explode(',', $line);
            $phoneMapping[$lineArray[0]][] = [
                'activationDate' => $lineArray[1],
                'deactivationDate' => $lineArray[2]
            ];
        }
        return $phoneMapping;
    }

    /**
     * @param $filePath
     * @param $data array
     */
    public static function writeFile($filePath, $data){
        $file = fopen($filePath, 'a');
        fputcsv($file, $data);
        fclose($file);
    }

    public static function checkFileExists($filePath){
        return file_exists($filePath);
    }
}