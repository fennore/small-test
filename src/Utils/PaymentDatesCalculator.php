<?php

namespace App\Utils;

use DateTime;
use Exception;

/**
 * Calculator for payment dates.
 */
class PaymentDatesCalculator {

    /**
     * The current month.
     * @var int
     */
    private $currentMonth;
    
    /**
     * The year now.
     * @var int
     */
    private $currentYear;
    
    public function __construct()
    {
        $date = new DateTime();
        $this->currentYear = (int) $date->format('Y');
        $this->currentMonth = (int) $date->format('n');
    }
    
    /**
     * The base salaries are paid on the last day of the month unless that day is a Saturday or a Sunday.
     * @param int $month The number of the month in format n from 1 - 12.
     * @param int|null $year The year in format Y like 2001.
     * @return DateTime
     */
    public function getSalaryDate(int $month, ?int $year = null)
    {
        $this->checkDate($month, $year);
        $date = new DateTime(($year ?? $this->currentYear).'-'.$month);
        $date->modify('+'.($date->format('t') - 1).' days');
        $checkDay = $date->format('N');
        if($checkDay > 5) {
          $diff = 8 - $checkDay; // 8 = days in a week + mon as 1st day of the week => 7 + 1
          $date->modify('+'.$diff.' days');
        }
        return $date;
    }

    /**
     * On the 15th of every month bonuses are paid for the previous month, unless that day is a weekend.
     * In that case, they are paid the first Wednesday after the 15th.
     * @param int $month The number of the month in format n from 1 - 12.
     * @param int|null $year The year in format Y like 2001.
     * @return DateTime
     */
    public function getBonusDate(int $month, ?int $year = null) 
    {
        $this->checkDate($month, $year);
        $date = new DateTime(($year ?? $this->currentYear).'-'.$month);
        $date->modify('+'.($date->format('t') + 14).' days'); // 14 = 15 - 1
        $checkDay = $date->format('N');
        if($checkDay > 5) {
          $diff = 10 - $checkDay; // 10 = days in a week + wed as 3rd day of the week => 7 + 3
          $date->modify('+'.$diff.' days');
        }
        return $date;
    }
    
    protected function checkDate(int $month, ?int $year)
    {
        
        if($month < 1 || $month > 12)
        {
            throw new Exception(sprintf('There are only 12 months and we start counting them from 1. %s requested.', $month));
        }
        
        if(!is_null($year) && $year < $this->currentYear || ($year === $this->currentYear || is_null($year)) && $month < $this->currentMonth)
        {
            throw new Exception(\sprintf('%s is in the past. You should already have paid.', ($year ?? $this->currentYear).'-'.$month));
        }
    }
}
