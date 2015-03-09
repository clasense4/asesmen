<?php
    date_default_timezone_set('Asia/Jakarta');
    $this->fpdf->FPDF("P","cm","A4");

    $this->fpdf->SetMargins(2,2,2);
    $this->fpdf->AliasNbPages();
    
    $this->fpdf->AddPage();

    $this->fpdf->SetFont('Times','B',12);

    $this->fpdf->Cell(17,0.7,'LIST ASESI',0,0,'C');
    $this->fpdf->Ln();
    $this->fpdf->SetFont('helvetica','',10);
    //$this->fpdf->Cell(19,0.5,'Sub judul',0,0,'C');
    //$this->fpdf->Ln();
    //$this->fpdf->Cell(19,0.5,'subtitle',0,0,'C');

    //$this->fpdf->Line(1,3.5,20,3.5);
    //$this->fpdf->Line(1,3.55,20,3.55);

    /* ————– Header Halaman selesai ————————————————*/

    //$this->fpdf->Ln(1);
    //$this->fpdf->SetFont('Times','B',12);
    //$this->fpdf->Cell(17,1,'Header',0,0,'C');
    /* setting header table */
    $this->fpdf->Ln(1);
    $this->fpdf->SetFont('Times','B',11);
    $this->fpdf->Cell(1 , 1, 'No' , 1, 'LR', 'C');
    $this->fpdf->Cell(4 , 1, 'Nama' , 1, 'LR', 'C');
    $this->fpdf->Cell(3 , 1, 'NIP' , 1, 'LR', 'C');
    $this->fpdf->Cell(3 , 1, 'Pendidikan' , 1, 'LR', 'C');
    $this->fpdf->Cell(3 , 1, 'Jabatan' , 1, 'LR', 'C');
    $this->fpdf->Cell(3 , 1, 'Unit' , 1, 'LR', 'C');

    /* generate hasil query disini */
    $no = 0;
    foreach($asesi_list as $data)
    {
        $no++;
        $this->fpdf->Ln();
        $this->fpdf->SetFont('Times','',11);
        $this->fpdf->Cell(1 , 0.7, $no , 1, 'LR', 'L');
        $this->fpdf->Cell(4 , 0.7, $data->nama , 1, 'LR', 'L');
        $this->fpdf->Cell(3 , 0.7, $data->nip , 1, 'LR', 'L');
        $this->fpdf->Cell(3 , 0.7, $data->pendidikan , 1, 'LR', 'L');
        $this->fpdf->Cell(3 , 0.7, $data->jabatan , 1, 'LR', 'L');
        $this->fpdf->Cell(3 , 0.7, $data->unit , 1, 'LR', 'L');
    }
    /* setting posisi footer 3 cm dari bawah */

    $this->fpdf->SetY(-3);

    /* setting font untuk footer */
    $this->fpdf->SetFont('Times','',10);

    /* setting cell untuk waktu pencetakan */
    $this->fpdf->Cell(9.5, 0.5, 'Printed on : '.date('d/m/Y H:i'),0,'LR','L');

    /* setting cell untuk page number */
    $this->fpdf->Cell(9.5, 0.5, 'Page '.$this->fpdf->PageNo().'/{nb}',0,0,'R');

    /* generate pdf jika semua konstruktor, data yang akan ditampilkan, dll sudah selesai */
    $this->fpdf->Output("Asesi.pdf","I");
?>