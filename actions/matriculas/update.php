<?php
require_once __DIR__ . '/../../admin_auth.php';
use App\Repositories\MatriculaRepository;
$id=(int)($_POST['id_matricula']??0);
$fields=['nombre','apellido','dni','telefono','correo','curso','fecha'];
foreach($fields as $f){if(trim($_POST[$f]??'')===''){flash('error','Datos incompletos','Completa todos los campos obligatorios.');redirect('/admin/matriculas/show.php?id='.$id);}}
$ts=strtotime(trim($_POST['fecha']));
if($ts===false){flash('error','Fecha inválida','La fecha de matrícula no es válida.');redirect('/admin/matriculas/show.php?id='.$id);}
$data=[
    'nombre'=>trim($_POST['nombre']),
    'apellido'=>trim($_POST['apellido']),
    'dni'=>trim($_POST['dni']),
    'telefono'=>trim($_POST['telefono']),
    'correo'=>trim($_POST['correo']),
    'curso'=>trim($_POST['curso']),
    'fecha'=>date('Y-m-d H:i:s',$ts),
];
try{(new MatriculaRepository(db()))->update($id,$data);flash('success','Matrícula actualizada','Los datos del estudiante fueron actualizados.');}catch(Throwable $e){flash('error','No se pudo actualizar',$e->getMessage());}
redirect('/admin/matriculas/show.php?id='.$id);