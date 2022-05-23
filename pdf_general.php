<?php 

require("fpdf.php");

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('./source/footer-img.png',25,8,33);
    // Arial bold 15
    $this->SetFont('Arial','',12);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(70,10, utf8_decode('Reporte de servicios'),0,0,'C');
    // Salto de línea
    $this->Ln(20);

    $this -> Cell(25, 10, utf8_decode('Servicio no.'), 1, 0, 'C', 0);
    $this -> Cell(20, 10, utf8_decode('Comanda'), 1, 0, 'C', 0);
    $this -> Cell(20, 10, utf8_decode('Nombre'), 1, 0, 'C', 0);
    
    
    
    $this -> Cell(20, 10, utf8_decode('Servicio'), 1, 1, 'C', 0);


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
$consulta = "SELECT * FROM datos WHERE estado_servicio = 'OK'";
$resultado = $mysqli->query($consulta);
$pdf = new PDF();
$pdf-> AliasNbPages();
$pdf-> AddPage();
$pdf -> SetFont('Arial', '', 12);


while($row = $resultado->fetch_assoc()) {
    $pdf -> Cell(25, 10, $row['num_serv'], 1, 0, 'C', 0);
    $pdf -> Cell(20, 10, $row['ticket'], 1, 0, 'C', 0);
    $pdf -> Cell(20, 10, utf8_decode($row['nombre']), 1, 0, 'C', 0);
    
    
    
    $pdf -> Cell(20, 10, $row['estado_servicio'], 1, 1, 'C', 0);
}

$pdf -> Output();





?>