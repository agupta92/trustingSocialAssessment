<?php
/**
 * Created by PhpStorm.
 * User: ankit
 * Date: 23/09/18
 * Time: 1:51 PM
 */

class PhoneRecords
{
    private $phoneNumber;
    private $phoneData;

    function __construct($phoneNumber, $phoneData)
    {
        $this->phoneNumber = $phoneNumber;
        $this->phoneData = $phoneData;
    }

    /**
     * DESC: Sort the phone data and calculate Actual Activation date of Current User.
     * @return array
     */
    public function getCurrentActivationDate(){
        $this->sortPhoneData();
        $phoneDataSorted = $this->phoneData;
        $phoneArraySize = count($phoneDataSorted);
        $currActivationDate = 0;
        for($i = $phoneArraySize-1; $i>=0; $i--){
            $currActivationDate = $phoneDataSorted[$i]['activationDate'];
            if($currActivationDate == $phoneDataSorted[$i-1]['deactivationDate']){
                $currActivationDate = $phoneDataSorted[$i-1]['activationDate'];
            } else {
                break;
            }
        }
        return [
            'phoneNumber' => $this->phoneNumber,
            'currActivationDate' => $currActivationDate
        ];
    }

    /**
     *DESC : Sort Phone Data on basis of Activation Date.
     */
    public function sortPhoneData(){
        usort($this->phoneData, function($a, $b) {
            return $a['activationDate'] <=> $b['activationDate'];
        });

    }
}