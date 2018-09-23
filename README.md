# trustingSocialAssessment
Assessment of Trusting Social

# Installation
- ```$ git clone https://github.com/agupta92/trustingSocialAssessment.git```
- ```$ commposer install ```

### Folder Structure


| Folder | Description |
| ------ | ------ |
| /main | It consist of the main code (Model/Console/Helper/consoleDocuments) |
| /main/Model | It consist of the PhoneRecord Model |
| /main/Helper | It consist of the Helper Classes |
| /main/Console | It consist of the Console file actualActivationDate.php which is the main file for our project |
| /main/ConsoleDocuments | Inside this directory, all the input/output csv will be creatted |
| /tests | It consist of the testCases. Framework used: Codeception |


### Run
- To generate ActualActivation csv file run follow cmd: <br>
  ``` php main/console/actualActivationDate.php <InputFileName> ```
#### Note: Input file must be present in ConsoleDocuments folder

- To run Test Casess: <br>
``` php vendor/bin/codecept run unit ExampleTest ```

## Strategy and Algorithm
- First while taking input, form a Hash Map in which PhoneNumber is a key, and all occurance of activation and deactivation data as value.
- Iterating each phone number, and sort date ranges based on activationDate.
- After sorting, start backward iteration on date range making activationDate as currentActivationDate, and check if currentActivationDate == previous date range deactivation date. If yes, then make currentActivationDate = previous date range activationDate. Continue while above condition gets false. After false, break the loop and currentActivationDate is the current owner activation date as per the requirement.
- Code Snipet of Major Two Function
```/**
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
    ```
