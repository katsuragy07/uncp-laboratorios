<?php
namespace App\Models;

//use Codedge\Fpdf\Fpdf\Fpdf;
use Fpdf;
class Headergeneral_fpdf extends Fpdf
{
    public function __construct()
        {
          //  parent::__construct();
        }

    public function Header()
    {
      //  $this->Image(storage_path() . '/logo.jpg',10,6,30);
        $this->SetFont('Arial','B',15);
        $this->Cell(80);
        $this->Cell(30,10,'Title',1,0,'C');
        $this->Ln(20);
    }

    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}
