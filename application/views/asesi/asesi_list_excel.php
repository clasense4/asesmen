<?php

header('Content-type: application/ms-excel');
header("Content-Disposition: attachment; filename=Asesi.xls");

$this->load->library('excel');
$objPHPExcel = new PHPExcel();
$objPHPExcel->getActiveSheet()->setTitle('Asesi');

$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:F1');

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);

$objPHPExcel->getActiveSheet()->setCellValue('A1', 'LIST ASESI');

$objPHPExcel->getActiveSheet()->setCellValue('A3', 'No');
$objPHPExcel->getActiveSheet()->setCellValue('B3', 'Nama');
$objPHPExcel->getActiveSheet()->setCellValue('C3', 'NIP');
$objPHPExcel->getActiveSheet()->setCellValue('D3', 'Pendidikan');
$objPHPExcel->getActiveSheet()->setCellValue('E3', 'Jabatan');
$objPHPExcel->getActiveSheet()->setCellValue('F3', 'Unit Kerja');

$no = 0;
$index = 0;

$objPHPExcel->getActiveSheet()->getStyle('A3:F3')->getFill()->applyFromArray(
    array(
        'type'       => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => '0e90d2'),
    )
);

if($asesi_list == TRUE) :
    foreach ($asesi_list as $row) :
        $no++;
        $index =  3 + $no;
        
        $objPHPExcel->getActiveSheet()->setCellValue('A'. $index, $no);
        $objPHPExcel->getActiveSheet()->setCellValue('B'. $index, $row->nama);
        $objPHPExcel->getActiveSheet()->setCellValue('C'. $index, $row->nip);
        $objPHPExcel->getActiveSheet()->setCellValue('D'. $index, $row->pendidikan);
        $objPHPExcel->getActiveSheet()->setCellValue('E'. $index, $row->jabatan);
        $objPHPExcel->getActiveSheet()->setCellValue('F'. $index, $row->unit);
        
        $styleArray = array(
        'borders' => array(
          'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
          )
        )
      );

    $objPHPExcel->getActiveSheet()->getStyle('A3:F'.$index)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A3:F'.$index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A3:F'.$index)->applyFromArray($styleArray);
    endforeach;
else :
    $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A4:F5');
    $objPHPExcel->getActiveSheet()->setCellValue('A4', 'Tidak Ada Data');
    
    $styleArray = array(
        'borders' => array(
          'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
          )
        )
      );

    $objPHPExcel->getActiveSheet()->getStyle('A3:F5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A3:F5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A3:F5')->applyFromArray($styleArray);
endif;

unset($styleArray);
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>