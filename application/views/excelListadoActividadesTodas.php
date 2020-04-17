<?php

extract($datos);

$styleArrayMedium = array(
    'borders' => array(
      'allborders' => array(
        'style' => PHPExcel_Style_Border::BORDER_MEDIUM
      )
    )
  );

  $styleArrayThin = array(
    'borders' => array(
      'allborders' => array(
        'style' => PHPExcel_Style_Border::BORDER_THIN
      )
    )
  );

$hoja=0;
$this->excel->createSheet($hoja);
$this->excel->setActiveSheetIndex($hoja);

$objDrawing = new Drawing();
$objDrawing->setWorksheet($this->excel->getActiveSheet($hoja));    
$objDrawing->setName('Logo');
$objDrawing->setDescription('Logo');
$objDrawing->setPath('././img/AyuntamientoExcel.png');
$objDrawing->setCoordinates('A1');
$objDrawing->setHeight(49.6);
$objDrawing->setWidth(158.8);

$this->excel->getActiveSheet()->setCellValue('A5', "LLISTAT ALUMNES INSCRITS A TOTES LES ACTIVITATS");
$this->excel->getActiveSheet()->setCellValue('A6', "Curs: ".$textoCurso);
$this->excel->getActiveSheet()->setCellValue('A7', "Activitats: ".$actividad);

//emcabezamiento tabla
$this->excel->getActiveSheet()->setCellValue('A9', ' Activitat');
$this->excel->getActiveSheet()->setCellValue('B9', ' Horari');
$this->excel->getActiveSheet()->setCellValue('C9', ' Nen/nena');
$this->excel->getActiveSheet()->setCellValue('D9', ' Periode');
$this->excel->getActiveSheet()->setCellValue('E9', 'Import Pagat ');

$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(10);

$this->excel->getActiveSheet()->getStyle('A9:E9')->getFont()->setBold(true);
$this->excel->getActiveSheet()->getStyle('A9:E9')->getFont()->setSize(8);
$this->excel->getActiveSheet()->getRowDimension('9')->setRowHeight(20);
$this->excel->getActiveSheet()->getStyle('A9:E9')->getAlignment()->setWrapText(true);
$this->excel->getActiveSheet()->getStyle('A9:D9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$this->excel->getActiveSheet()->getStyle('E9:E9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

$this->excel->getActiveSheet()->getStyle('A9:E9')->applyFromArray($styleArrayMedium);

$this->excel->getActiveSheet()->setTitle("Activitats Pagades");
$this->excel->getActiveSheet($hoja)->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);


$row=10;
foreach($result as $k=>$v){
    $this->excel->getActiveSheet()->setCellValue('A'.$row, ' '.$v->descripcion);
    $this->excel->getActiveSheet()->setCellValue('B'.$row, ' '.substr($v->desde,0,5).'-'.substr($v->hasta,0,5));
    $this->excel->getActiveSheet()->setCellValue('C'.$row, ' '.$v->nombre_alumno.' '.$v->apellido1_alumno.' '.$v->apellido2_alumno);
    $this->excel->getActiveSheet()->setCellValue('D'.$row, ' '.$v->periodo);
    $this->excel->getActiveSheet()->setCellValue('E'.$row, $v->precio.' ');
     
    $this->excel->getActiveSheet()->getStyle('A'.$row.':E'.$row)->getFont()->setSize(8);
    $this->excel->getActiveSheet()->getStyle('A'.$row.':D'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    $this->excel->getActiveSheet()->getStyle('E'.$row.':E'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

    $this->excel->getActiveSheet()->getStyle('A'.$row.':E'.$row)->getAlignment()->setWrapText(true);
    $this->excel->getActiveSheet()->getStyle('A'.$row.':E'.$row)->applyFromArray($styleArrayThin);
    $row++;
}
$total=$resultTotal->total==""?0:$resultTotal->total;
$this->excel->getActiveSheet()->setCellValue('A'.$row, ' '.$resultTotal->num);
$this->excel->getActiveSheet()->setCellValue('D'.$row, ' '.$resultTotal);
$this->excel->getActiveSheet()->setCellValue('B'.$row, ' '.'');
$this->excel->getActiveSheet()->setCellValue('E'.$row, $total.' ');
$this->excel->getActiveSheet()->getStyle('A'.$row.':E'.$row)->getFont()->setSize(10);
$this->excel->getActiveSheet()->getStyle('A'.$row.':D'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$this->excel->getActiveSheet()->getStyle('E'.$row.':E'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$this->excel->getActiveSheet()->getStyle('A'.$row.':E'.$row)->applyFromArray($styleArrayMedium);


$this->excel->setActiveSheetIndex(1);
$sheetIndex = $this->excel->getActiveSheetIndex();
$this->excel->removeSheetByIndex($sheetIndex);



$filename='Llistat activitats '.textoCurso.' '.$actividad.' .xls'; //save our workbook as this file name
header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
            
//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
//if you want to save it as .XLSX Excel 2007 format
$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  


//force user to download the Excel file without writing it to server's HD
//
//$objWriter->save(str_replace('.php', '.xls', __FILE__));
$objWriter->save('php://output');