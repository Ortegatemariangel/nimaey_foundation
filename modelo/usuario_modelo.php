
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
</head>
<body>

<form action="" method="POST">

    <label for="tipo_usuario">Tipo de usuario:</label>

    <select name="tipo_usuario" id="tipo_usuario">

        <option value="Admin">Administrador</option>

        <option value="Beneficiario">Beneficiario</option>

        <option value="Donante">Donante</option>

    </select>

    <br><br>

    <label for="correo">Correo:</label>
    <input type="email" name="correo" required>

    <br><br>

    <label for="contrasena">Contraseña:</label>
    <input type="password" name="contrasena" required>

    <br><br>

    <button type="submit">Enviar</button>

</form>


<?php


// ==========================================
// CONEXIÓN A LA BASE DE DATOS
// ==========================================

function conectar()
{
    $conexion = mysqli_connect(
        "localhost",
        "root",
        "",
        "Nimaey_Foundation"
    );

    if(!$conexion)
    {
        die("Error de conexión: ".mysqli_connect_error());
    }

    return $conexion;
}



// ==========================================
// VALIDAR USUARIO
// ==========================================

function validar_usuario($correo,$contrasena,$tipo_usuario)
{

    // conexión
    $conexion = conectar();

    echo "<br>Función validar_usuario ejecutándose...";


    // ==========================================
    // ADMIN
    // ==========================================

    if($tipo_usuario == "Admin")
    {

        $sql = "SELECT *
                FROM Admin
                WHERE correo_admin='$correo'
                AND contraseña_admin='$contrasena'";

    }


    // ==========================================
    // BENEFICIARIO
    // ==========================================

    elseif($tipo_usuario == "Beneficiario")
    {

        $sql = "SELECT *
                FROM Beneficiario
                WHERE correo_beneficiario='$correo'
                AND contraseña_beneficiario='$contrasena'";

    }


    // ==========================================
    // DONANTE
    // ==========================================

    elseif($tipo_usuario == "Donante")
    {

        $sql = "SELECT *
                FROM Donante
                WHERE correo_donante='$correo'
                AND contraseña_donante='$contrasena'";

    }


    // ejecutar consulta
    $consulta = mysqli_query($conexion,$sql);


    // error SQL
    if(!$consulta)
    {
        die("Error SQL: ".mysqli_error($conexion));
    }


    // obtener resultado
    $resultado = mysqli_fetch_assoc($consulta);



    // ==========================================
    // SI EXISTE
    // ==========================================

    if($resultado)
    {

        echo "<br><br>Usuario encontrado";


        // ADMIN
        if($tipo_usuario == "Admin")
        {

            echo "<br>ID: ".$resultado['id_usuario_admin'];

            echo "<br>Nombre: ".$resultado['nombre_admin'];

            echo "<br>Correo: ".$resultado['correo_admin'];

        }



        // BENEFICIARIO
        elseif($tipo_usuario == "Beneficiario")
        {

            echo "<br>ID: ".$resultado['id_usuario_beneficiario'];

            echo "<br>Nombre: ".$resultado['nombre_beneficiario'];

            echo "<br>Correo: ".$resultado['correo_beneficiario'];

        }



        // DONANTE
        elseif($tipo_usuario == "Donante")
        {

            echo "<br>ID: ".$resultado['id_usuario_donante'];

            echo "<br>Nombre: ".$resultado['nombre_donante'];

            echo "<br>Correo: ".$resultado['correo_donante'];

        }

    }

    else
    {

        echo "<br><br>Usuario o contraseña incorrectos";

    }

}



// ==========================================
// PROCESAR FORMULARIO
// ==========================================

if($_SERVER["REQUEST_METHOD"]=="POST")
{

    extract($_POST);

    echo "<br>Probando consulta...";

    echo "<br>".$correo;

    echo "<br>".$contrasena;

    echo "<br>".$tipo_usuario;


    validar_usuario(
        $correo,
        $contrasena,
        $tipo_usuario
    );

}

?>

</body>
</html>