<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <title>EJERCICIO DE SUSANA Y NACHO</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">

    <!-- A partir de aqui copiado de https://www.tutorialrepublic.com/codelab.php?topic=bootstrap&file=crud-data-table-for-database-with-modal-form -->


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <!-- Link a mis funciones javascript -->
    <script src="funciones.js"></script>
    <!-- Hoja de estilos css -->
    <link rel="stylesheet" href="miestilo.css">
    <!-- libreria SweetAlert para alert -->
    <script src="lib/sweet-alert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="lib/sweet-alert.css">

</head>

<body>
    <?php
    // He hecho la conexión en otro archivo php y lo incluyo con el include
    // conexión con BBDD y comprobación de conexión

    include 'conexionBaseDatos.php';

    include 'funciones.php';

    ?>

    <div class="col-11 container">
        </br>
        <div class="row bg-dark text-white mb-3">

            <div class="col-12">
                </br>
                <h1 style="text-align: center;">STAR WARS - MAY THE FORCE BE WITH YOU</h1>
                </br>
                <!-- <p>Ejemplo de uso de js para pasar datos que existan en una capa a un formulario</p>
                <p>* NOTA I: Ejemplo con divs, pero podrían estar en una tabla (lo importante son los ids)</p>
                <p>* NOTA II: Es un ejemplo de js. Ni se cargan datos dinámicamente ni el envío del formulario funciona.</p>
                <p>* NOTA III: No es obligatorio su uso ni va a ser calificado. Simplemente se incluye como "extra" para
                    que el ejercicio final pueda estar más completo y "vistoso"</p> -->
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-7 border">
                <h2><b>STAR WARS</b></h2>
                <div class="row p-1">
                    <div class="container-xl">
                        <div class="table-responsive">
                            <div class="table-wrapper">
                                <div class="table-title">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h2>TABLA ACTORES</h2>
                                        </div>
                                        <div class="col-sm-6">
                                        </div>
                                    </div>
                                </div>
                                        <?php                                      
                                        if (isset($_POST['boton']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['personaje'])) {

                                            $boton = $_POST["boton"];
                                            $nombre = $_POST["nombre"];
                                            $apellido = $_POST["apellido"];
                                            $personaje = $_POST["personaje"];
                                            $id = $_POST["id"];
                                            $busqueda = $_POST["busqueda"];

                                            switch ($boton) {
                                                case "Insertar Registro":
                                                    insertarRegistro($nombre, $apellido, $personaje);
                                                    verTodos();
                                                    break;
                                                case "Modificar Registro":
                                                    modificarRegistro($id,$nombre,$apellido,$personaje);                                                 
                                                    verTodos();
                                                    break;
                                                case "Eliminar Registro":
                                                    eliminarRegistro($id);
                                                    verTodos();
                                                    break;
                                                case "Buscar Registro":
                                                    buscarRegistro($id);
                                                    break;
                                                case "Ver Todos":
                                                    verTodos();
                                                    break;
                                                case "Buscar por Texto":
                                                    buscarPorTexto($busqueda);
                                                    break;
                                                default:
                                            }
                                            $conn->close(); // cierre de conexión con la BBDD
                                        } else {
                                            if (isset($_POST["boton"])) {
                                                
                                                echo "<div class='alert alert-danger' role='alert'> Debes rellenar todos los campos del formulario</div>";
                                            }else{
                                                verTodos();
                                            }
                                        }
                                        ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-5 border">

                <h2>FORMULARIO</h2>
                <form action="formulario3.php" method="post">
                    <form action="#">
                        <div class="mb-3 mt-3">
                            <label for="id">ID:</label>
                            <input type="number" class="form-control" id="id" placeholder="Enter id (only update, delete or search)" name="id">
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Introduce nombre" name="nombre">
                        </div>
                        <div class="mb-3">
                            <label for="apellido">Apellido:</label>
                            <input type="text" class="form-control" id="apellido" placeholder="Introduce apellido" name="apellido">
                        </div>
                        <div class="mb-3">
                            <label for="personaje">Personaje:</label>
                            <input type="text" class="form-control" id="personaje" placeholder="Introduce personaje" name="personaje">
                        </div>
                        <div class="mb-3">
                            <label for="busqueda">Busqueda por Texto:</label>
                            <input type="text" class="form-control" id="busqueda" placeholder="Texto a buscar" name="busqueda">
                        </div>
                        <div class="mb-3">
                            <input type="submit" class="btn btn-primary" value="Insertar Registro" name="boton"  />
                            <input type="submit" class="btn btn-primary" value="Modificar Registro" name="boton" />
                            <input type="submit" class="btn btn-primary" value="Eliminar Registro" name="boton" /></br></br>
                            <input type="submit" class="btn btn-primary" value="Buscar Registro" name="boton" />
                            <input type="submit" class="btn btn-primary" value="Buscar por Texto" name="boton" /></br></br>
                            <input type="submit" class="btn btn-primary" value="Ver Todos" name="boton" />
                            <input type="reset" class="btn btn-primary" value="Limpiar campos" name="boton" />
                        </div>
                    </form>
                </form>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript; -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>