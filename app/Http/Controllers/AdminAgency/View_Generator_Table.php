<?php

namespace App\Http\Controllers\AdminAgency;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Offer;
use App\Reservation;
use Illuminate\Support\Facades\Auth;

class View_Generator_Table
{
    private $headers = array();
    private $cells = array();
    /**
     * Array of the table headers
     * @param array of strings $headers
     */
    public function __construct($headers)
    {
        $this->headers = $headers;
    }
    /**
     * Adds a cell to the table
     * @param string $cell
     */
    public function addCell($cell = "")
    {
        $this->cells[] = $cell;
    }
    /**
     * Generates and returns the table html in a  string
     * @return string
     */
    public function generate()
    {
        $re = "";
        $columns = count($this->headers);
        if($columns  > 0)
        {
            $re .= "<table border='1' class='generatedTable'><thead><tr>";
            // Adding the headers
            foreach($this->headers as $header)
            {
                $re .= "<th>".$header."</th>";
            }
            $re .= "</thead></tr>";
            $totalCells = count($this->cells);
            if($totalCells > 0)
            {
                // Adding the data cells
                $re .= "<tbody>";
                for($i=0;  $i < $totalCells; $i++)
                {
                    $currentColumn = $i % $columns;
                    if($currentColumn == 0)
                    {
                        $re .= "<tr>";
                    }
                    $re .= "<td>".$this->cells[$i]."</td>";
                    if($currentColumn == $columns - 1)
                    {
                        $re .= "</tr>";
                    }
                }
                // If there the number of the cells don't much the number of the
                // columns then we add some empty cells
                if($currentColumn !== $columns - 1)
                {
                    for($i = $currentColumn ;  $i < $columns - 1; $i++)
                    {
                        $re .= "<td></td>";
                    }
                    $re .= "</tr>";
                }
                $re .= "</tbody>";
            }
            $re .= "</table>";
        }
        return $re;
    }
}

