
<?php

function correcto($mandada)
{

    $todoOK = false;

    if (isset($mandada) && !empty($mandada)) {
        $todoOK = true;
    }

    return $todoOK;
}

function existeRegistro($id, $conn)
{
    $existe = false;
    if (correcto($id)) {
        $sql = "SELECT * FROM actores WHERE id='$id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $existe = true;
        }
    }
    return $existe;
}

function pintarRegistro($row)
{
    $id_db = $row['id'];
    $nombre_db = $row["Nombre"];
    $apellido_db = $row["Apellido"];
    $personaje_db = $row["Personaje"];



    echo "<tr id='elemento_" . $id_db . "' onclick='pasaDatos(" . $id_db . ")'>";


    echo "<td style='width:30px;'><span id='id_" . $id_db . "'>" . $id_db . "</td>";
    echo "<td style='width:100px;'><span id='nombre_" . $id_db . "'>" . $nombre_db . "</td>";
    echo "<td style='width:100px;'><span id='apellido_" . $id_db . "'>" . $apellido_db . "</td>";
    echo "<td style='width:100px;'><span id='personaje_" . $id_db . "'>" . $personaje_db . "</td>";
}

function pintar_tabla($result)
{

    if ($result->num_rows > 0) {

        echo '<table class="table table-striped table-hover">
            <thead>
                <tr>
                    
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Personaje</th>
                    
                </tr>
            </thead>
            <tbody>';


        // output data of each row
        while ($row = $result->fetch_assoc()) {
            pintarRegistro($row);
        }


        echo '</tbody>
            </table>';
    } else {
        //echo "0 results";
         echo "<div class='alert alert-danger' role='alert'>Ningún resultado.</div>";
    }
}

function verTodos()
{

    global $conn;

    $sql = "SELECT * FROM actores";
    $result = $conn->query($sql);
    pintar_tabla($result);
}

function insertarRegistro($nombre, $apellido, $personaje)
{
    global $conn;

    if (correcto($nombre) && correcto($apellido) && correcto($personaje)) {
        $sql = "INSERT INTO actores (Nombre, Apellido, Personaje)";
        $sql .= " VALUES ('$nombre','$apellido','$personaje')";
        if ($conn->query($sql) === TRUE) {
            //echo "Nuevo registro realizado correctamente</br>";
            echo "<div class='alert alert-success' role='alert'>Nuevo registro realizado correctamente</div>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        
        echo "<div class='alert alert-danger' role='alert'>Los campos nombre, apellido y personaje son necesarios para añadir un registro a la base de datos. </div>";
    }
}

function modificarRegistro($id, $nombre, $apellido, $personaje)
{
    global $conn;

    $contador = 0;
    
    if (correcto($id) && (correcto($nombre) || correcto($apellido) || correcto($personaje))) {
        $sql = $sql = "UPDATE actores SET ";

        if (correcto($nombre)) {
            $sql .= "Nombre='$nombre'";
            $contador++;
        }
        if (correcto($apellido)) {
            if ($contador != 0) {
                $sql .= ",";
            }
            $sql .= " Apellido='$apellido'";
            $contador++;
        }
        if (correcto($personaje)) {
            if ($contador != 0) {
                $sql .= ",";
            }
            $sql .= " Personaje='$personaje'";
            $contador++;
        }
        $sql .= " WHERE id='$id'";

        if ($conn->query($sql) === TRUE) {
            if ($conn->affected_rows > 0) {
                // echo "Registro modificado correctamente</br>";
                echo "<div class='alert alert-success' role='alert'>Registro modificado correctamente</div>";
            } else {
                //echo "No existe ningún registro con ese id asociado";
                echo "<div class='alert alert-danger' role='alert'>No existe ningún registro con ese id asociado o ya existe en la base de datos</div>";
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        //echo "Los campos id, nombre, apellido y personaje son necesarios para modificar un registro a la base de datos.";
        echo "<div class='alert alert-danger' role='alert'>Los campos id, nombre, apellido y personaje son necesarios para modificar un registro a la base de datos.</div>";
    }
}

function eliminarRegistro($id)
{
    global $conn;
    if (correcto($id)) {
        $sql = "DELETE FROM actores WHERE id='$id'";

        if ($conn->query($sql) === TRUE) {
            if ($conn->affected_rows > 0) {
                //echo "Registro eliminado correctamente</br>";
                echo "<div class='alert alert-success' role='alert'>Registro eliminado correctamente</div>";
            } else {
                //echo "No existe ningún registro con ese id asociado";
                echo "<div class='alert alert-danger' role='alert'>No existe ningún registro con ese id asociado</div>";
            }
        } else {
            //echo "Error deleting record: " . $conn->error;
            echo "<div class='alert alert-danger' role='alert'>Error borrando el registro</div>".$conn->error;
        }
    }
}

function buscarRegistro($id)
{
    global $conn;
    if (correcto($id)) {
        $sql = "SELECT * FROM actores WHERE id='$id'";
        $result = $conn->query($sql);
        pintar_tabla($result);
        
    } else {
        //echo "Para busqueda por id debes introducir el id en el campo correspondiente";
        echo "<div class='alert alert-danger' role='alert'>Para busqueda por id debes introducir el id en el campo correspondiente</div>";
    }
}

function buscarPorTexto($busqueda)
{
    global $conn;
    if (correcto($busqueda)) {
        //$sql ="SELECT * FROM actores WHERE Nombre='$busqueda' OR Apellido='$busqueda' OR Personaje='$busqueda'";
        //$sql = "SELECT * FROM actores WHERE Nombre LIKE '%".$busqueda."%' OR Apellido LIKE '%".$busqueda."%' OR Personaje LIKE '%".$busqueda."%'";
        $sql = "SELECT * FROM actores WHERE Nombre LIKE '%$busqueda%' OR Apellido LIKE '%$busqueda%' OR Personaje LIKE '%$busqueda%'";
        $result = $conn->query($sql);
        pintar_tabla($result);
    } else {
        //echo "No puedes dejar el campo de busqueda en blanco";
        echo "<div class='alert alert-danger' role='alert'>No puedes dejar el campo de busqueda en blanco</div>";
    }
}
?>