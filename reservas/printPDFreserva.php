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
$pdf->Cell(60,4,'Reserva de Dispositivo Tecnologico ',0,1,'C');
$pdf->SetFont('Helvetica','',8);
 
// DATOS FACTURA        
$pdf->Ln(5);
$pdf->Cell(60,4,'Reserva n : '.$id.'',0,1,'');
$pdf->Cell(60,4,'Fecha: '.$Fecha.'',0,1,'');
//$pdf->Cell(60,4,'Metodo de pago: Tarjeta',0,1,'');
 
// COLUMNAS
$pdf->SetFont('Helvetica', 'B', 7);
$pdf->Cell(30, 10,$Dispositivo, 0);
$pdf->Cell(3, 10, 'Turno: '.$Turno.'',0,0,'R');
$pdf->Cell(12, 10,'Hora: '.$Hora.'',0,0,'R');
$pdf->Cell(15, 10,'Curso: '.$Curso.'',0,0,'R');
$pdf->Ln(8);
$pdf->Cell(60,0,'','T');
$pdf->Ln(0);
$pdf->Cell(25, 10, 'Prof: '.$Profesor.'', 0);   
// linea
$pdf->Ln(8);
$pdf->Cell(60,0,'','T');
$pdf->Ln(2);    
 
// PIE DE PAGINA
$pdf->Ln(10);
$pdf->Cell(60,0,'Ematp Informatica EES N1',0,1,'C');
$pdf->Ln(3);
$pdf->Cell(60,0,'GDJUAREZ ',0,1,'C');
 
$pdf->Output('ticket.pdf','i');
?>