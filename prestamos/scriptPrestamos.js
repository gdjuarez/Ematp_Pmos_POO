$(document).on("ready", function () {

  $('#tablaPmo tr').click(function(event) {
    
    if (event.target.type !== 'checkbox') {
        $(':checkbox', this).trigger('click');
        $(this).css('background-color','#009999');       
    }


});

 // alert('si');

 $(document).on('change', '#check', function () {
    if (this.checked) {
      $(this).val('1');     
    } else {
      $(this).val('0');     
    }
  });
 
  
 //--------------------------------------------------------------------- 
  $('#prestando').on('click', function (e) {
    e.preventDefault();

     //alert('actualizar');
     var apellido = $("#ape").val();

    if (apellido !='') {
     
      var curso = $("#cur").val();
      var usuario= $("#usuario").val();

      //   alert(apellido +''+ curso);

           //  RECORRO DETALLE
      valores = new Array();
      $('#tablaPmo tr').each(function () {

        var checkeado = $(this).find("#check").val();
        var id= $(this).find("td").eq(0).html();
        var dispositivo = $(this).find("td").eq(1).html();
        var n_serial = $(this).find("td").eq(2).html();
        var numero = $(this).find("td").eq(3).html();
        var estado =  $(this).find("#estado").val();       

        //------ Cargo el arreglo VALORES
        valor = new Array(checkeado, id, dispositivo,n_serial,numero,estado,apellido,curso,usuario);
        valores.push(valor);

      // alert(valores);

      })          


    }else{
      
      //sweet alert**************************************************);  
    Swal.fire({
      title:'Atención',
      text:'Apellido, es obligatorio',
      icon:'info',
      timer:'1000',
      timerProgressBar:true
    }).then(function(){ 
      location.reload();
      }

    ); 
   //--------------------------------------------------------------
    }



    // ENVIO LOS DATOS Y EL ARRAY valores POR $_POST[''] A J A X--
    $.ajax({
      type: 'POST',
      url: 'update_pmo.php',
      data: {
        valores: valores
      }, //asi paso el array a php
      success: function (data) {
        $('#respuesta_update').empty();
        $('#respuesta_update').append(data);
      }

    });


    //alert("Procesado. . .\n click para continuar");   

     // asi funciona OK 
    Swal.fire({
      title:'Procesando ...',
      icon:'success',
      timer:'2000',
      timerProgressBar:true
    }).then(function(){ 
      location.reload();
      }

    ); 

  })
  
  //----------------------------------------------------------------------
  $('#recibiendo').on('click', function (e) {
    e.preventDefault();

     //alert('actualizar');    

    if (1==1) {

      var apellido = $("#ape").val();
      var curso = $("#cur").val();
      var usuario= $("#usuario").val();

      //   alert(apellido +''+ curso);

           //  RECORRO DETALLE
      valores = new Array();
      $('#tablaPmo tr').each(function () {

        var checkeado = $(this).find("#check").val();
        var id= $(this).find("td").eq(0).html();
        var dispositivo = $(this).find("td").eq(1).html();
        var n_serial = $(this).find("td").eq(2).html();
        var numero = $(this).find("td").eq(3).html();
        var estado =  $(this).find("#estado").val();       

        //------ Cargo el arreglo VALORES
        valor = new Array(checkeado, id, dispositivo,n_serial,numero,estado,apellido,curso,usuario);
        valores.push(valor);

      // alert(valores);

      })          


    }else{

    // ----


    }


    // ENVIO LOS DATOS Y EL ARRAY valores POR $_POST[''] A J A X--
    $.ajax({
      type: 'POST',
      url: 'update_pmo_recibir.php',
      data: {
        valores: valores
      }, //asi paso el array a php
      success: function (data) {
        $('#respuesta_update').empty();
        $('#respuesta_update').append(data);
      }

    });

    //alert("Procesado. . .\n click para continuar");   

     // asi funciona OK 
    Swal.fire({
      title:'Recibida',
      icon:'success',
      timer:'1000',
      timerProgressBar:true
    }).then(function(){ 
      location.reload();
      }

    ); 
   //--------------------------------------------------------------
  



  })


});