<?php

namespace App\Helpers;

use Codedge\Fpdf\Fpdf\Fpdf;

class Pdf extends Fpdf
{
    // Load data
    function LoadData($file)
    {
        if (is_array($file))
            return $file;
        // Read file lines
        $lines = file($file);
        $data = array();
        foreach($lines as $line)
            $data[] = explode(';',trim($line));
        return $data;
    }

    // Simple table
    function BasicTable($header, $data)
    {
        // Header
        foreach($header as $col)
            $this->Cell(40,7,$col,1);
        $this->Ln();
        // Data
        foreach($data as $row)
        {
            foreach($row as $col)
                $this->Cell(40,6,$col,1);
            $this->Ln();
        }
    }
}
