Swal.fire({
	title:'Cerrando sesion ...',
	icon:'info',
	timer:'2000',
	timerProgressBar:true
  }).then(function(){ 
	window.location.href = "index.php";
	}

  );