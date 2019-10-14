<?php


class Currency
{
    private $denominations;
    private $dollarAmount;
    private $currencyDistribution = [];

    public function __construct($countryCode, $dollarAmount, $indexOfHighestDenomination)
    {
        $this->setDenominations($countryCode);
        $this->dollarAmount = $dollarAmount;
        $this->setLowestCurrencyCounts($indexOfHighestDenomination);
    }


    private function setDenominations($countryCode)
    {
        $countryCode = strtoupper($countryCode);

        /*

        Easily extensible for other currency types. This sets the denomination by country, but is not intended for
        determining the highest currency to be measured. Would ideally store this data in a separate JSON or database storage in practice.

        */
        switch ($countryCode) {
            case 'US' :
                $this->denominations = [
                    ['numeric' => 100, 'label' => 'hundreds'],
                    ['numeric' => 50, 'label' => 'fifties'],
                    ['numeric' => 20, 'label' => 'twenties'],
                    ['numeric' => 10, 'label' => 'tens'],
                    ['numeric' => 5, 'label' => 'fives'],
                    ['numeric' => 1, 'label' => 'ones'],
                    ['numeric' => .5, 'label' => 'halfDollars'],
                    ['numeric' => .25, 'label' => 'quarters'],
                    ['numeric' => .1, 'label' => 'dimes'],
                    ['numeric' => .05, 'label' => 'nickels'],
                    ['numeric' => .01, 'label' => 'pennies']
                ];
                break;
//            case 'GB':
//                $this->denominations = [
//                    ['numeric' => 50, 'label' => 'Fifties'],
//                    ['numeric' => 20, 'label' => 'Twenties'],
//                    ['numeric' => 10, 'label' => 'Tens'],
//                    ['numeric' => 5, 'label' => 'Fives'],
//                    ['numeric' => 2, 'label' => 'Twos'],
//                    ['numeric' => 1, 'label' => 'Ones'],
//                    ['numeric' => .50, 'label' => 'Fifty_Pence'],
//                    ['numeric' => .2, 'label' => 'Twenty_Pence'],
//                    ['numeric' => .1, 'label' => 'Ten_Pence'],
//                    ['numeric' => .05, 'label' => 'Five_Pence'],
//                    ['numeric' => .02, 'label' => 'Two_Pence'],
//                    ['numeric' => .01, 'label' => 'One_Pence']
//                ];
//                break;
            default :
                return false;
        };
    }

    /*
     * https://stackoverflow.com/questions/17210787/php-float-calculation-error-when-subtracting
     * */
    private function setLowestCurrencyCounts($denom = 0) {
        // Local copy of variable to prevent manipulation of the class variable $this->dollarAmount.
        $localValue = (float)$this->dollarAmount;
        for ($i = $denom; $i < sizeof($this->denominations); $i++) {
            if ($localValue / $this->denominations[$i]['numeric'] >= 1) {
                $units = floor($localValue / $this->denominations[$i]['numeric']);
                $this->currencyDistribution[$this->denominations[$i]['label']] = $units;
                $localValue = round($localValue - ($units * $this->denominations[$i]['numeric']), 2);
            }
        }
    }


    public function getCurrencyDistribution() {
        return $this->currencyDistribution;
    }


}


