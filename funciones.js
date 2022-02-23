function pasaDatos(idCapa) {

  console.log("Pasando datos de capa " + idCapa + " al formulario");
  
  var miPersonaje = document.getElementById("personaje_" + idCapa).innerHTML;
  var miNombre = document.getElementById("nombre_" + idCapa).innerHTML;
  var miApellido = document.getElementById("apellido_" + idCapa).innerHTML;
  var miIdentificador = document.getElementById("id_" + idCapa).innerHTML;
  

  document.getElementById('id').value = miIdentificador;
  document.getElementById('nombre').value = miNombre;
  document.getElementById('apellido').value = miApellido;
  document.getElementById('personaje').value = miPersonaje;

}

