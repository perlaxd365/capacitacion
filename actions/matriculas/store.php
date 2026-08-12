<?php
require_once __DIR__ . '/../../app/bootstrap.php';
if($_SERVER['REQUEST_METHOD']!=='POST') redirect('/');
$fields=['nombre','apellido','dni','telefono','correo','curso']; foreach($fields as $f){if(trim($_POST[$f]??'')===''){flash('error','Datos incompletos','Completa todos los campos obligatorios.');redirect('/');}}
$stmt=db()->prepare('INSERT INTO matriculas (nombre,apellido,dni,telefono,correo,curso) VALUES (?,?,?,?,?,?)');
$values=[]; foreach($fields as $f)$values[]=trim($_POST[$f]); $stmt->bind_param('ssssss',...$values); $stmt->execute(); flash('success','¡Matrícula registrada!','La matrícula fue registrada correctamente.'); redirect('/');
