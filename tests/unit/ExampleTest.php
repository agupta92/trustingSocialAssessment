<?php

use main\helper\InputOutput;
include_once __DIR__ . "/../../main/helper/InputOutput.php";
include_once __DIR__ . "/../../main/Model/PhoneRecords.php";

class ExampleTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testFileExistWithWrongFileName()
    {
        $actualResponse = InputOutput::checkFileExists('abc.csv');
        $expectResponse = false;
        $this->assertEquals($expectResponse, $actualResponse);
    }

    // tests
    public function testFileExistWithRightFileName()
    {   $filePath = __DIR__ . "/../../main/consoleDocuments/Sample1.csv";
        $actualResponse = InputOutput::checkFileExists($filePath);
        $expectResponse = true;
        $this->assertEquals($expectResponse, $actualResponse);
    }

    public function testPhoneRecordSortData(){
        $param = [
            0 =>
                [
                'activationDate' => '2016-09-01',
                'deactivationDate' => '2016-12-01'
                ],
            1 =>
                [
                    'activationDate' => '2016-03-01',
                    'deactivationDate' => '2016-05-01'
                ],
            2 =>
                [
                'activationDate' => '2016-06-01',
                'deactivationDate' => '2016-09-01'
                ]
        ];
        $phoneRecord = new PhoneRecords('123123', $param);
        $phoneRecord->sortPhoneData();
        $expectedResponse = [
            0 =>
                [
                    'activationDate' => '2016-03-01',
                    'deactivationDate' => '2016-05-01'
                ],
            1 =>
                [
                    'activationDate' => '2016-06-01',
                    'deactivationDate' => '2016-09-01'
                ],
            2 =>
                [
                    'activationDate' => '2016-09-01',
                    'deactivationDate' => '2016-12-01'
                ]
        ];
        $this->assertEquals($expectedResponse, $phoneRecord->getPhoneData());
    }

    public function testGetCurrentActivationDate(){
        $param = [
            0 =>
                [
                    'activationDate' => '2016-09-01',
                    'deactivationDate' => '2016-12-01'
                ],
            1 =>
                [
                    'activationDate' => '2016-03-01',
                    'deactivationDate' => '2016-05-01'
                ],
            2 =>
                [
                    'activationDate' => '2016-06-01',
                    'deactivationDate' => '2016-09-01'
                ]
        ];
        $phoneRecord = new PhoneRecords('123123', $param);
        $currentActivationDate = $phoneRecord->getCurrentActivationDate();
        $expectedResponse = [
            'phoneNumber'  => 123123,
            'currActivationDate' => '2016-06-01'
        ];
        $this->assertEquals($expectedResponse, $currentActivationDate);
    }
}