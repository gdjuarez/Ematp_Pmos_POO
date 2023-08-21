<?php
session_start();
if($_SESSION['logged'] == 'yes')
{
	//echo 'Usuario: '.$_SESSION['user'];

}else{

	echo '<script language=javascript>
		  alert("No te has logeado, inicia sesion")
		  self.location = "../index.html"</script>';
}
?>

<?php
require('../fpdf/fpdf.php');
// Include database connection

require_once('../conexion/config.php'); 

$miConexion = mysqli_connect(DB_HOST, DB_USUARIO, DB_PASS,DB_NOMBRE);
//------Recibo los Datos del ajax----

// recibo numero de pedido
if(isset($_POST["fechareserva"])){
    $dia = $_POST["fechareserva"];
}else{
    $dia=date('%d/%m/%Y');
}


//Obtengo datos del pedido
$reserva = mysqli_query($miConexion,"SELECT id, dispositivo_id, Dispositivo, date_format(fecha,'%d/%m/%Y') as Fecha,Turno,Hora, Curso, Profesor, usuario FROM reserva where Fecha = '$dia' order by Fecha,Turno,Hora ");
$item = 0;
while($fila = mysqli_fetch_array($reserva)){
	$item = $item+1;
    $id= $fila['id'];  
    $Dispositivo= $fila['Dispositivo']; 
    $Fecha= $fila['Fecha'];
    $Turno= $fila['Turno'];
    $Hora= $fila['Hora'];
    $Curso= $fila['Curso'];
    $Profesor= $fila['Profesor'];
   
    
}

//-----------------------------------------------------------------------------------------------
//Inicio la construccion del PDF
define('PESOS',chr(128)); // Constante con el símbolo Euro.
$pdf = new FPDF('P','mm',array(80,150)); // Tamaño tickt 80mm x 150 mm (largo aprox)
$pdf->AddPage();

// CABECERA
$pdf->SetFont('Helvetica','',12);
$pdf->Cell(60,4,'Reserva ',0,1,'C');
$pdf->SetFont('Helvetica','',8);
// $pdf->Cell(60,4,'C.I.F.: 01234567A',0,1,'C');
// $pdf->Cell(60,4,'C/ Arturo Soria, 1',0,1,'C');
// $pdf->Cell(60,4,'C.P.: 28028 Madrid (Madrid)',0,1,'C');
// $pdf->Cell(60,4,'999 888 777',0,1,'C');
// $pdf->Cell(60,4,'alfredo@lacodigoteca.com',0,1,'C');
 
// DATOS FACTURA        
$pdf->Ln(5);
$pdf->Cell(60,4,'Reserva n : '.$id.'',0,1,'');
$pdf->Cell(60,4,'Fecha:'.$Fecha.'',0,1,'');
//$pdf->Cell(60,4,'Metodo de pago: Tarjeta',0,1,'');
 
// COLUMNAS
$pdf->SetFont('Helvetica', 'B', 7);
$pdf->Cell(30, 10, 'Articulo', 0);
$pdf->Cell(3, 10, 'Ud',0,0,'R');
$pdf->Cell(12, 10, 'Precio',0,0,'R');
$pdf->Cell(15, 10, 'Total',0,0,'R');
$pdf->Ln(8);
$pdf->Cell(60,0,'','T');
$pdf->Ln(0);
/* 

// //CONSULTA Pedido
$pedidoA = mysqli_query($miConexion,"SELECT idp,comanda,articulo,descripcion,preciounidad,cantidad,importe FROM comandadetalle  WHERE comanda = $nPed");
$item = 0;
$totaluni = 0;
$totalimp = 0;
//$pdf->SetFont('times', '', 7);
while($pedidoA2 = mysqli_fetch_array($pedidoA)){
    $item = $item+1;
    
// PRODUCTOS
$pdf->SetFont('Helvetica', '', 7);
$pdf->MultiCell(30,4,$pedidoA2['descripcion'],0,'L'); 
$pdf->Cell(32, -5, $pedidoA2['cantidad'],0,0,'R');
$pdf->Cell(12, -5, number_format(round($pedidoA2['preciounidad'],2), 2, ',', ' ').'',0,0,'R');
$pdf->Cell(15, -5, number_format(round($pedidoA2['importe'],2), 2, ',', ' ').'',0,0,'R');
$pdf->Ln(2); 
}*/


// SUMATORIO DE LOS PRODUCTOS Y EL IVA
$pdf->Ln(6);
$pdf->Cell(60,0,'','T');
$pdf->Ln(2);    

$pdf->Ln(3);    
$pdf->Cell(25, 10, 'TOTAL', 0);    
$pdf->Cell(20, 10, '', 0);
//$pdf->Cell(15, 10, number_format(round($total,2), 2, ',', ' ').'',0,0,'R');
 
// PIE DE PAGINA
$pdf->Ln(10);
$pdf->Cell(60,0,'no valido como factura',0,1,'C');
$pdf->Ln(3);
$pdf->Cell(60,0,' ',0,1,'C');
 
$pdf->Output('ticket.pdf','i');
?>