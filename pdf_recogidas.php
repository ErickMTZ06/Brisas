<?php 

require("fpdf.php");

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('./source/footer-img.png',25,8,33);
    // Arial bold 12
    $this->SetFont('Arial','',12);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(70,10, utf8_decode('Reporte de recogidas'),0,0,'C');
    // Salto de línea
    $this->Ln(20);

    $this -> Cell(20, 10, utf8_decode('Nombre'), 1, 0, 'C', 0);
    $this -> Cell(20, 10, utf8_decode('Apellidos'), 1, 0, 'C', 0);
    $this -> Cell(23, 10, utf8_decode('Habitación'), 1, 0, 'C', 0);
    $this -> Cell(20, 10, utf8_decode('Comanda'), 1, 0, 'C', 0);
    $this -> Cell(110, 10, utf8_decode('Comentario'), 1, 1, 'C', 0);


}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
}
}

require './BD/cn-pdf.php';
$consulta = "SELECT * FROM recogidas";
$resultado = $mysqli->query($consulta);
$pdf = new PDF();
$pdf-> AliasNbPages();
$pdf-> AddPage();
$pdf -> SetFont('Arial', '', 12);


while($row = $resultado->fetch_assoc()) {
    $pdf -> Cell(20, 10, utf8_decode($row['nombre']), 1, 0, 'C', 0);
    $pdf -> Cell(20, 10, utf8_decode( $row['apellidos']), 1, 0, 'C', 0);
    $pdf -> Cell(23, 10, $row['num_hab'], 1, 0, 'C', 0);
    $pdf -> Cell(20, 10, utf8_decode( $row['ticket']), 1, 0, 'C', 0);
    $pdf -> Cell(110, 10, $row['comentario'], 1, 1, 'C', 0);
}

$pdf -> Output();





?>