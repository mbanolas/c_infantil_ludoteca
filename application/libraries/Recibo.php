<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    // Incluimos el archivo fpdf
    require_once APPPATH."third_party/fpdf/fpdf.php";
    
    //Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
    class Recibo extends FPDF {
        
        
        public function __construct() {
            $subTitulo="";
            $titulo="";
            parent::__construct();
        }
        
        public function setTitulo($texto){
            $this->titulo=$texto;
        }

        public function setSubTitulo($texto){
            $this->subTitulo=$texto;
        }

        // El encabezado del PDF
        public function Header(){
           $this->Image('images/logo_horta_guinardo.png',10,10,50);
           $this->Image('img/CI_LOGO.jpg',20,22,20);

            $this->SetFont('Arial','B',13);
            // $this->Cell(30);
            // $this->Cell(0,10,iconv('UTF-8', 'CP1252',$_SESSION['tituloCasal']),0,0,'C');
           
            // $this->SetFont('Arial','B',11);
            $this->SetTextColor(0,0,0);
           $this->Cell(50);
            $this->Cell(100,10,$this->titulo,0,1,'C');
            $this->Cell(50);
            $this->Cell(100,0,$this->subTitulo,0,0,'C');
            if($this->PageNo()==1){
                // $this->Ln();
                // $this->Cell(50);
                // $this->setXY(160,10);
                // $this->Cell(40,40,'Foto',1,0,"C");
            }else{
                $this->Ln(20);
            }
            $this->setXY(10,20);
            $this->SetFont('Arial','B',10);
            // $this->Cell(10,6,getNombreCasal(),0,0,"L");
            // $this->setXY(10,40);
            $this->Cell(10,60,getNombreCasal(),0,0,"L");
            $this->setXY(10,54);
       }
       // El pie del pdf
       public function Footer(){
           $this->SetY(-15);
           $this->SetTextColor(0,0,0);

           $this->SetFont('Arial','I',8);
        //    $this->Cell(0,10,utf8_decode('Pàgina ').$this->PageNo().'/{nb}',0,0,'C');
      }
    }