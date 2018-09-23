<?php
/**
 * Created by PhpStorm.
 * User: ankit <agupta.92@gmail.com>
 * Date: 23/09/18
 * Time: 11:06 AM
 */
include_once (__DIR__."/../helper/InputOutput.php");
include_once (__DIR__. "/../Model/PhoneRecords.php");

//Take File name as argument
$inputFileName = $argv[1];
$inputFilePath = __DIR__. '/../consoleDocuments/'. $inputFileName;


$phoneMappingArray = InputOutput::readFileAndFilterData($inputFilePath);
//Write header of Output CSV
InputOutput::writeFile($inputFilePath.'-Output', ['PHONE_NUMBER','REAL_ACTIVATION_DATE']);

foreach ($phoneMappingArray as $phoneNumber => $phoneData){
    $phoneRecord = new PhoneRecords($phoneNumber, $phoneData);
    $currActivationDate = $phoneRecord->getCurrentActivatioNDate();
    InputOutput::writeFile($inputFilePath.'-Output', $currActivationDate);
}

