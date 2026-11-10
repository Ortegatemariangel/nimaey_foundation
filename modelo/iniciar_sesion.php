<?php
require_once __DIR__ . '/../config/conexion.php';
if (session_status() === PHP_SESSION_NONE) session_start();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: ../index.php'); exit(); }
$roles=['Admin'=>['tabla'=>'Admin','correo'=>'correo_admin','clave'=>'contraseña_admin'],'Donante'=>['tabla'=>'Donante','correo'=>'correo_donante','clave'=>'contraseña_donante'],'Beneficiario'=>['tabla'=>'Beneficiario','correo'=>'correo_beneficiario','clave'=>'contraseña_beneficiario']];
$tipo=$_POST['tipo_usuario']??''; $correo=trim($_POST['correo']??''); $clave=$_POST['contrasena']??'';
if(!isset($roles[$tipo])||!filter_var($correo,FILTER_VALIDATE_EMAIL)||$clave===''){header('Location: ../index.php?error=datos');exit();}
$c=$roles[$tipo];$conexion=conectar();$sql="SELECT {$c['correo']} FROM {$c['tabla']} WHERE {$c['correo']}=? AND {$c['clave']}=? LIMIT 1";$stmt=mysqli_prepare($conexion,$sql);
if(!$stmt){mysqli_close($conexion);error_log('Error preparando autenticación Nimaey.');header('Location: ../index.php?error=general');exit();}
mysqli_stmt_bind_param($stmt,'ss',$correo,$clave);mysqli_stmt_execute($stmt);$resultado=mysqli_stmt_get_result($stmt);$usuario=mysqli_fetch_assoc($resultado);mysqli_stmt_close($stmt);mysqli_close($conexion);
if($usuario){session_regenerate_id(true);$_SESSION['username']=$correo;$_SESSION['tipo_usuario']=$tipo;header('Location: ../pagina_usuario.php');exit();}
header('Location: ../index.php?error=credenciales');exit();
