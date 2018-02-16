<?php

namespace App\Data;

use DateTime;
use App\Utils\PaymentDatesCalculator;

/**
 * Representation of the payment dates list for the remainder of the year.
 */
class PaymentDatesList implements SimpleListInterface {
    /**
     * @var PaymentDatesCalculator 
     */
    private $calculator;
    
    /**
     * @var DateTime 
     */
    private $currentDate;
    
    public function __construct(PaymentDatesCalculator $calculator) {
        $this->calculator = $calculator;
        $this->currentDate = new DateTime();
    }
    
    /**
     * Each row represents the months for the remainder of the year.
     */
    public function getRows(): iterable
    {
        $startMonth = $this->currentDate->format('n');
        for($i = $startMonth; $i<=12; ++$i) {
            yield $this->getColumns($i);
        }
    }
    /**
     * Contains a column for the month, a column that contains the salary payment date for that month, 
     * and a column that contains the bonus payment date.
     * 
     * @param int $month
     * @return array
     */
    public function getColumns(int $month): array
    {
        return [
            DateTime::createFromFormat('Y-n', $this->currentDate->format('Y').'-'.$month)->format('F'), // the month
            $this->calculator->getSalaryDate($month)->format('Y-n-j'), // salary payment date
            $this->calculator->getBonusDate($month)->format('Y-n-j'), // bonus payment date
        ];
    }
}
