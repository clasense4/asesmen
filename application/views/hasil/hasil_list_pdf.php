<?php
    date_default_timezone_set('Asia/Jakarta');
    $this->fpdf->FPDF("P","cm","A4");

    $this->fpdf->SetMargins(2,2,2);
    $this->fpdf->AliasNbPages();
    $this->fpdf->AddPage();
	
	$this->fpdf->SetFont('Times','B',9);
    $this->fpdf->Cell(20,2,'LAPORAN INDIVIDU',0,0,'L');
	$this->fpdf->Ln();
    $this->fpdf->SetFont('Times','B',8);
    $this->fpdf->Cell(17,0.7,'HASIL PENILAIAN POTENSI DAN KOMPETENSI',0,0,'C');
    $this->fpdf->Ln();

    /* ————– Header Halaman selesai ————————————————*/
	
	  $no = 0; 
    foreach($hasil_list as $data)
    {
	
	$this->fpdf->SetFont('Times','B',7);
    $this->fpdf->Ln();
    $this->fpdf->Cell(1,0.7,'No',0,0,'L');
	$this->fpdf->Cell(5,0.7,': '.$data->no_asesi,0,0,'R');
	$this->fpdf->Ln();
	$this->fpdf->Cell(1,0.7,'Nama Asesi',0,0,'L');
	$this->fpdf->Cell(5,0.7,': '.$data->nama_asesi,0,0,'R');
	$this->fpdf->Ln();
	$this->fpdf->Cell(1,0.7,'Nama Jabatan Fungsional Umum',0,0,'L');
	$this->fpdf->Cell(5,0.7,': '.$data->jabatan,0,0,'R');
	$this->fpdf->Ln();
	$this->fpdf->Cell(1,0.7,'Unit Kerja',0,0,'L');
	$this->fpdf->Cell(5,0.7,': '.$data->no_asesi,0,0,'R');
	$this->fpdf->Ln();
	$this->fpdf->Cell(1,0.7,'Tanggal Penilaian',0,0,'L');
	$this->fpdf->Cell(5,0.7,': '.$data->no_asesi,0,0,'R');
	}
	
	
    /* setting header table */
    $this->fpdf->Ln(1);
	$this->fpdf->write(0,'A. Aspek Potensi');
	$this->fpdf->Ln(0.4);
    $this->fpdf->SetFont('Times','B',7);
    $this->fpdf->Cell(7 , 1, 'Aspek yang diukur' , 1, 'LR', 'C');
    $this->fpdf->Cell(8 , 0.3, 'Sekor Penilaian' , 1, 'LR', 'C');
	$this->fpdf->Ln(0.4);
	$this->fpdf->Cell(7 , 0.3, 'Rendah' , 1, 'LR', 'C');


	
    /* generate hasil query disini 
    $no = 0; 
    foreach($hasil_list as $data)
    {
        $no++;
        $this->fpdf->Ln();
        $this->fpdf->SetFont('Times','',7);
        $this->fpdf->Cell(1 , 0.7, $no , 1, 'LR', 'L');
        $this->fpdf->Cell(4 , 0.7, $data->no_asesi , 1, 'LR', 'L');
  
    }*/
    /* setting posisi footer 3 cm dari bawah */

    $this->fpdf->SetY(-3);

    /* setting font untuk footer */
    $this->fpdf->SetFont('Times','',10);

    /* setting cell untuk waktu pencetakan */
    $this->fpdf->Cell(9.5, 0.5, 'Printed on : '.date('d/m/Y H:i'),0,'LR','L');

    /* setting cell untuk page number */
    $this->fpdf->Cell(9.5, 0.5, 'Page '.$this->fpdf->PageNo().'/{nb}',0,0,'R');

    /* generate pdf jika semua konstruktor, data yang akan ditampilkan, dll sudah selesai */
    $this->fpdf->Output("Kegiatan.pdf","I");
?>