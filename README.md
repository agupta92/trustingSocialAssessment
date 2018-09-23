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
- To generate ActualActivation csv file run follow cmd:
 ``` php main/console/actualActivationDate.php <InputFileName> ```
Note: Input file must be present in ConsoleDocuments folder

- To run Test Cases:
``` php vendor/bin/codecept run unit ExampleTest ```
