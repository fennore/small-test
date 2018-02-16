<?php

namespace App\Tests\Utils;

use App\Utils\PaymentDatesCalculator;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class PaymentDatesCalculatorTest extends TestCase {
  
  public function test()
  {
      $calc = new PaymentDatesCalculator();
      // 1
      $result = $calc->getSalaryDate(2);
      $this->assertEquals('2018-2-28', $result->format('Y-n-j'));
      // 2
      $result = $calc->getSalaryDate(3);
      $this->assertEquals('2018-4-2', $result->format('Y-n-j'));
      // 3
      $result = $calc->getSalaryDate(3, 2019);
      $this->assertEquals('2019-4-1', $result->format('Y-n-j'));
      // 1
      $result = $calc->getBonusDate(12);
      $this->assertEquals('2019-1-15', $result->format('Y-n-j'));
      // 2
      $result = $calc->getBonusDate(3);
      $this->assertEquals('2018-4-18', $result->format('Y-n-j'));
      // 3
      $result = $calc->getBonusDate(3, 2019);
      $this->assertEquals('2019-4-15', $result->format('Y-n-j'));
  }
}
