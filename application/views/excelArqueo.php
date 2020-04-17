<?php

$hoja=0;
$this->excel->createSheet($hoja);
$this->excel->setActiveSheetIndex($hoja);

$this->excel->getActiveSheet()->setCellValue('A1', 'Rebuts cobraments/devolucions des de '.fechaEuropea($desde).' fins '.fechaEuropea($hasta) );

$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(14);

$this->excel->getActiveSheet()->setCellValue('A3', 'Data rebut' );
$this->excel->getActiveSheet()->setCellValue('B3', 'Núm rebut' );
$this->excel->getActiveSheet()->setCellValue('C3', 'Núm inscripció' );
$this->excel->getActiveSheet()->setCellValue('D3', 'Nom nen/nena' );
$this->excel->getActiveSheet()->setCellValue('E3', 'Primer cognom nen/nena' );
$this->excel->getActiveSheet()->setCellValue('F3', 'Segon cognom nen/nena' );
$this->excel->getActiveSheet()->setCellValue('G3', 'Import (€)' );
$this->excel->getActiveSheet()->setCellValue('H3', 'Metal·lic' );
$this->excel->getActiveSheet()->setCellValue('I3', 'Tarjeta' );
$this->excel->getActiveSheet()->setCellValue('J3', 'Transferencia' );

$this->excel->getActiveSheet()->getStyle('A3:J3')->getFont()->setBold(true);
$this->excel->getActiveSheet()->getStyle('A3:J3')->getFont()->setSize(12);

$this->excel->getActiveSheet()->getStyle('G3:J3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);


$row=4;
$total=0;
$metalico=0;
$tarjeta=0;
$transferencia=0;
foreach($result as $k=>$v){
  $this->excel->getActiveSheet()->setCellValue('A'.$row, fechaEuropea($v->fecha_recibo));
  $this->excel->getActiveSheet()->setCellValue('B'.$row, ($v->num_registro_ingreso));
  $this->excel->getActiveSheet()->getCell("C".$row)->setValueExplicit($v->id_inscripcion, PHPExcel_Cell_DataType::TYPE_STRING);
  $this->excel->getActiveSheet()->setCellValue('D'.$row, ($v->nombre_alumno));
  $this->excel->getActiveSheet()->setCellValue('E'.$row, ($v->apellido1_alumno));
  $this->excel->getActiveSheet()->setCellValue('F'.$row, ($v->apellido2_alumno));
  $this->excel->getActiveSheet()->setCellValue('G'.$row, ($v->importe_total));
  $total+=$v->importe_total;
  switch($v->tipo_ingreso){
    case 1:
      $this->excel->getActiveSheet()->setCellValue('H'.$row, ($v->importe_total));
      $metalico+=$v->importe_total;
    break;
    case 2:
      $this->excel->getActiveSheet()->setCellValue('I'.$row, ($v->importe_total));
      $tarjeta+=$v->importe_total;
    break;
    case 3:
      $this->excel->getActiveSheet()->setCellValue('J'.$row, ($v->importe_total));
      $transferencia+=$v->importe_total;
    break;
  }
 $row++;
}

// sumas
$this->excel->getActiveSheet()->setCellValue('G'.$row, $total);
$this->excel->getActiveSheet()->setCellValue('H'.$row, $metalico);
$this->excel->getActiveSheet()->setCellValue('I'.$row, $tarjeta);
$this->excel->getActiveSheet()->setCellValue('J'.$row, $transferencia);

$this->excel->getActiveSheet()->getStyle('A5:J'.$row)->getNumberFormat()->setFormatCode('0.00');
//formateo totales
$this->excel->getActiveSheet()->getStyle('A'.$row.':J'.$row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->getStyle('A'.$row.':J'.$row)->getFont()->setSize(14);



$ancho=15;
$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth($ancho);
$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth($ancho);
$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth($ancho);
$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth($ancho);


$filename='Export Arqueo '.getTituloCasalCorto().' .xls'; //save our workbook as this file name
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