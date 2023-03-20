$(document).on("ready", function () {

 //alert('si');

 $(document).on('change', '#check', function () {
    if (this.checked) {
      $(this).val('1');
    } else {
      $(this).val('0');
    }
  });
  //--------------------------------------------------------------------- 

 // $("#selectall").on("click", function() {
 //   $(".case").prop("checked", this.checked);
 //   $(".case").val('1');
 // });
  
 //--------------------------------------------------------------------- 
  $('#reservar').on('click', function (e) {
    e.preventDefault();

    // alert('reservar');

    if (1 == 1) {


      var fecha =$("#fecha").val();
      var turno= $("#turno").val();
      var hora= $("#hora").val();
      var curso = $("#curso").val();
      var apellido = $("#apellido").val();     
      var usuario= $("#usuario").val();


        //alert(fecha+''+turno+''+curso+''+apellido +''+ usuario);

           //  RECORRO DETALLE
      valores = new Array();
      $('#tablaPmo tr').each(function () {

        var checkeado = $(this).find("#check").val();
        var id= $(this).find("td").eq(0).html();
        var dispositivo = $(this).find("td").eq(1).html();
        var numero = $(this).find("td").eq(2).html();

        //------ Cargo el arreglo VALORES
        valor = new Array(checkeado, id, dispositivo,numero,fecha,turno,hora,curso,apellido,usuario);
        valores.push(valor);

        //alert(valores);

      })           


    }


    // ENVIO LOS DATOS Y EL ARRAY valores POR $_POST[''] A J A X--
    $.ajax({
      type: 'POST',
      url: 'update_reserva.php',
      data: {
        valores: valores
      }, //asi paso el array a php
      success: function (data) {
        $('#respuesta_update').empty();
        $('#respuesta_update').append(data);
      }

    });

   //alert("Procesado. . .\n click para continuar")
   // location.reload();
    
     // asi funciona OK 
     Swal.fire({
      title:'Reservando...',
      icon:'success',
      timer:'1000',
      timerProgressBar:true
    }).then(function(){ 
      location.reload();
      }

    );


  })
  //----------------------------------------------------------------------


});