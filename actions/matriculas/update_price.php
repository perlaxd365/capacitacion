<?php
require_once __DIR__ . '/../../admin_auth.php';
use App\Repositories\PagoRepository;
$id=(int)($_POST['id_matricula']??0);
try{(new PagoRepository(db()))->updatePrice($id,(float)($_POST['precio_total']??0));flash('success','Precio actualizado','El precio acordado fue actualizado.');}catch(Throwable $e){flash('error','No se pudo actualizar',$e->getMessage());}
redirect('/admin/matriculas/show.php?id='.$id);
