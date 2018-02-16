<?php

namespace App\Data;

/**
 * Simple interface structuring data in rows and columns.
 * As a more controlled alternative to a 2-dimensional array.
 */
interface SimpleListInterface {
  public function getRows(): iterable;
}
