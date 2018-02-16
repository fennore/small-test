<?php

namespace App\Utils;

use League\Csv\Writer;
use App\Data\SimpleListInterface;

/**
 * Exporter for a SimpleList
 */
class ExportSimpleList {
  
    /**
     * @var SimpleListInterface
     */
    private $list;
    
    /**
     * @param SimpleListInterface $list The SimpleList to export.
     */
    public function __construct(SimpleListInterface $list) {
        $this->list = $list;
    }
    
    /**
     * Export the SimpleList as Csv.
     * 
     * @param string $filename Filename.
     */
    public function exportAsCsv(string $filename)
    {
        $writer = Writer::createFromPath('var/'.$filename.'.csv', 'w');
        $writer->insertAll($this->list->getRows());
    }
}
