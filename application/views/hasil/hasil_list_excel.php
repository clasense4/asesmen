<?php

header('Content-type: application/ms-excel');
header("Content-Disposition: attachment; filename=Hasil_Penilaian.xls");

$dateNow = date("d/m/Y");

$this->load->library('excel');
$objPHPExcel = new PHPExcel();
$objPHPExcel->getActiveSheet()->setTitle('Data Penilaian');

$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:F1');

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);

$objPHPExcel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A1:H3')->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('B3:H3');
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'LAPORAN INDIVIDU');
$objPHPExcel->getActiveSheet()->setCellValue('B3', 'HASIL PENILAIAN POTENSI DAN KOMPETENSI');


//$no = 0;
//$index = 12;

//$objPHPExcel->getActiveSheet()->getStyle('A3:F3')->getFill()->applyFromArray(
 //   array(
 //       'type'       => PHPExcel_Style_Fill::FILL_SOLID,
 //       'startcolor' => array('rgb' => '0e90d2'),
 //   )
//);

//if($hasil_list == TRUE) :

foreach ($hasil_list as $row) :
	
$objPHPExcel->getActiveSheet()->setCellValue('B5', 'No.');
$objPHPExcel->getActiveSheet()->setCellValue('B6', 'Nama Asesi');
$objPHPExcel->getActiveSheet()->setCellValue('B7', 'Nama Jabatan Fungsional Umum');
$objPHPExcel->getActiveSheet()->setCellValue('B8', 'Unit Kerja');
$objPHPExcel->getActiveSheet()->setCellValue('B9', 'Tanggal Penilaian');

$objPHPExcel->getActiveSheet()->setCellValue('D5', ':');
$objPHPExcel->getActiveSheet()->setCellValue('D6', ':');
$objPHPExcel->getActiveSheet()->setCellValue('D7', ':');
$objPHPExcel->getActiveSheet()->setCellValue('D8', ':');
$objPHPExcel->getActiveSheet()->setCellValue('D9', ':');
$objPHPExcel->getActiveSheet()->setCellValue('E5', $row->no_asesi);
$objPHPExcel->getActiveSheet()->setCellValue('E6', $row->nama_asesi);
$objPHPExcel->getActiveSheet()->setCellValue('E7', $row->nama);
$objPHPExcel->getActiveSheet()->setCellValue('E8', $row->nama);
$objPHPExcel->getActiveSheet()->setCellValue('E9', $dateNow);

foreach ($nilai_potensi as $dataNilaiPotensi) :
	$kecerdasan_umum = $dataNilaiPotensi->kecerdasan_umum;
	$daya_abstraksi = $dataNilaiPotensi->daya_abstraksi;
	$daya_analisis = $dataNilaiPotensi->daya_analisis;
	$kendali_emosi = $dataNilaiPotensi->kendali_emosi;
	$kepercayaan_diri = $dataNilaiPotensi->kepercayaan_diri;
	$motivasi_kerja = $dataNilaiPotensi->motivasi_kerja;
	$sistematika_kerja = $dataNilaiPotensi->sistematika_kerja;
//kecerdasan umum
if ($kecerdasan_umum < 20){
	$objPHPExcel->getActiveSheet()->setCellValue('C16', $kecerdasan_umum);
}else if ($kecerdasan_umum > 20 && $kecerdasan_umum < 40){
	$objPHPExcel->getActiveSheet()->setCellValue('E16', $kecerdasan_umum);
}else if ($kecerdasan_umum > 40 && $kecerdasan_umum < 60){
	$objPHPExcel->getActiveSheet()->setCellValue('F16', $kecerdasan_umum);
}else if ($kecerdasan_umum > 60 && $kecerdasan_umum < 80){
	$objPHPExcel->getActiveSheet()->setCellValue('G16', $kecerdasan_umum);
}else {
	$objPHPExcel->getActiveSheet()->setCellValue('H16', $kecerdasan_umum);
}
//daya_abstraksi
if ($daya_abstraksi < 20){
	$objPHPExcel->getActiveSheet()->setCellValue('C17', $daya_abstraksi);
}else if ($daya_abstraksi > 20 && $daya_abstraksi < 40){
	$objPHPExcel->getActiveSheet()->setCellValue('E17', $daya_abstraksi);
}else if ($daya_abstraksi > 40 && $daya_abstraksi < 60){
	$objPHPExcel->getActiveSheet()->setCellValue('F17', $daya_abstraksi);
}else if ($daya_abstraksi > 60 && $daya_abstraksi < 80){
	$objPHPExcel->getActiveSheet()->setCellValue('G17', $daya_abstraksi);
}else {
	$objPHPExcel->getActiveSheet()->setCellValue('H17', $daya_abstraksi);
}
//daya_analisis
if ($daya_analisis < 20){
	$objPHPExcel->getActiveSheet()->setCellValue('C18', $daya_analisis);
}else if ($daya_analisis > 20 && $daya_analisis < 40){
	$objPHPExcel->getActiveSheet()->setCellValue('E18', $daya_analisis);
}else if ($daya_analisis > 40 && $daya_analisis < 60){
	$objPHPExcel->getActiveSheet()->setCellValue('F18', $daya_analisis);
}else if ($daya_analisis > 60 && $daya_analisis < 80){
	$objPHPExcel->getActiveSheet()->setCellValue('G18', $daya_analisis);
}else {
	$objPHPExcel->getActiveSheet()->setCellValue('H18', $daya_analisis);
}
//kendali_emosi
if ($kendali_emosi < 20){
	$objPHPExcel->getActiveSheet()->setCellValue('C19', $kendali_emosi);
}else if ($kendali_emosi > 20 && $kendali_emosi < 40){
	$objPHPExcel->getActiveSheet()->setCellValue('E19', $kendali_emosi);
}else if ($kendali_emosi > 40 && $kendali_emosi < 60){
	$objPHPExcel->getActiveSheet()->setCellValue('F19', $kendali_emosi);
}else if ($kendali_emosi > 60 && $kendali_emosi < 80){
	$objPHPExcel->getActiveSheet()->setCellValue('G19', $kendali_emosi);
}else {
	$objPHPExcel->getActiveSheet()->setCellValue('H19', $kendali_emosi);
}

//kepercayaan_diri
if ($kepercayaan_diri < 20){
	$objPHPExcel->getActiveSheet()->setCellValue('C20', $kepercayaan_diri);
}else if ($kepercayaan_diri > 20 && $kepercayaan_diri < 40){
	$objPHPExcel->getActiveSheet()->setCellValue('E20', $kepercayaan_diri);
}else if ($kepercayaan_diri > 40 && $kepercayaan_diri < 60){
	$objPHPExcel->getActiveSheet()->setCellValue('F20', $kepercayaan_diri);
}else if ($kepercayaan_diri > 60 && $kepercayaan_diri < 80){
	$objPHPExcel->getActiveSheet()->setCellValue('G20', $kepercayaan_diri);
}else {
	$objPHPExcel->getActiveSheet()->setCellValue('H20', $kepercayaan_diri);
}

//motivasi_kerja
if ($motivasi_kerja < 20){
	$objPHPExcel->getActiveSheet()->setCellValue('C21', $motivasi_kerja);
}else if ($motivasi_kerja > 20 && $motivasi_kerja < 40){
	$objPHPExcel->getActiveSheet()->setCellValue('E21', $motivasi_kerja);
}else if ($motivasi_kerja > 40 && $motivasi_kerja < 60){
	$objPHPExcel->getActiveSheet()->setCellValue('F21', $motivasi_kerja);
}else if ($motivasi_kerja > 60 && $motivasi_kerja < 80){
	$objPHPExcel->getActiveSheet()->setCellValue('G21', $motivasi_kerja);
}else {
	$objPHPExcel->getActiveSheet()->setCellValue('H21', $motivasi_kerja);
}

//sistematika_kerja
if ($sistematika_kerja < 20){
	$objPHPExcel->getActiveSheet()->setCellValue('C22', $sistematika_kerja);
}else if ($sistematika_kerja > 20 && $sistematika_kerja < 40){
	$objPHPExcel->getActiveSheet()->setCellValue('E22', $sistematika_kerja);
}else if ($sistematika_kerja > 40 && $sistematika_kerja < 60){
	$objPHPExcel->getActiveSheet()->setCellValue('F22', $sistematika_kerja);
}else if ($sistematika_kerja > 60 && $sistematika_kerja < 80){
	$objPHPExcel->getActiveSheet()->setCellValue('G22', $sistematika_kerja);
}else {
	$objPHPExcel->getActiveSheet()->setCellValue('H22', $sistematika_kerja);
}
endforeach;

$objPHPExcel->getActiveSheet()->getStyle('B13:C13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('B12:H15')->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->setCellValue('B12', 'A.	Aspek Potensi');

$objPHPExcel->setActiveSheetIndex(0)->mergeCells('B13:B15');
$objPHPExcel->getActiveSheet()->setCellValue('B13', 'Aspek yang diukur');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C13:H13');
$objPHPExcel->getActiveSheet()->setCellValue('C13', 'Sekor Penilaian');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C14:D14');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C15:D15');
$objPHPExcel->getActiveSheet()->setCellValue('C14', '1-20');
$objPHPExcel->getActiveSheet()->setCellValue('C15', 'Rendah');
$objPHPExcel->getActiveSheet()->setCellValue('E14', '21-40');
$objPHPExcel->getActiveSheet()->setCellValue('E15', 'Kurang');
$objPHPExcel->getActiveSheet()->setCellValue('F14', '41-60');
$objPHPExcel->getActiveSheet()->setCellValue('F15', 'Cukup');
$objPHPExcel->getActiveSheet()->setCellValue('G14', '61-80');
$objPHPExcel->getActiveSheet()->setCellValue('G15', 'Baik');
$objPHPExcel->getActiveSheet()->setCellValue('H14', '81-100');
$objPHPExcel->getActiveSheet()->setCellValue('H15', 'Istimewa');

$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C16:D16');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C17:D17');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C18:D18');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C19:D19');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C20:D20');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C21:D21');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C22:D22');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C23:D23');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('B24:H24');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('B25:H26');

$objPHPExcel->getActiveSheet()->setCellValue('B16', '1.	kecerdasan_umum');
$objPHPExcel->getActiveSheet()->setCellValue('B17', '2.	daya_abstraksi');
$objPHPExcel->getActiveSheet()->setCellValue('B18', '3.	daya_analisis');
$objPHPExcel->getActiveSheet()->setCellValue('B19', '4.	kendali_emosi');
$objPHPExcel->getActiveSheet()->setCellValue('B20', '5.	kepercayaan_diri');
$objPHPExcel->getActiveSheet()->setCellValue('B21', '6.	motivasi_kerja');
$objPHPExcel->getActiveSheet()->setCellValue('B22', '7.	sistematika_kerja');
$objPHPExcel->getActiveSheet()->setCellValue('B23', '');
$objPHPExcel->getActiveSheet()->setCellValue('B24', 'Skor Nilai Potensi  :'.$row->total);
 $objPHPExcel->getActiveSheet()->getStyle('B25')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->setCellValue('B25', 'Uraian Potensi');
$objPHPExcel->getActiveSheet()->setCellValue('B26', $row->uraian_potensi);

        
        $styleArray = array(
        'borders' => array(
          'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
          )
        )
      );

   // $objPHPExcel->getActiveSheet()->getStyle('B13:F13')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
   // $objPHPExcel->getActiveSheet()->getStyle('B14:F14')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B13:H26')->applyFromArray($styleArray);
    endforeach;
//else :
  //  $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A13:F5');
   // $objPHPExcel->getActiveSheet()->setCellValue('A13', 'Tidak Ada Data');
    
   // $styleArray = array(
       // 'borders' => array(
        //  'allborders' => array(
        //    'style' => PHPExcel_Style_Border::BORDER_THIN,
       //   )
       // )
    //  );

   // $objPHPExcel->getActiveSheet()->getStyle('A12:F5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    //$objPHPExcel->getActiveSheet()->getStyle('A12:F5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    //$objPHPExcel->getActiveSheet()->getStyle('A12:F5')->applyFromArray($styleArray);
//endif;

unset($styleArray);
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>