<?php
require_once __DIR__ . '/../../admin_auth.php';
use App\Repositories\PagoRepository;
$id=(int)($_POST['id_matricula']??0);
try{(new PagoRepository(db()))->create($id, $_POST['fecha']??'', (float)($_POST['monto']??0), $_POST['metodo_pago']??'', trim($_POST['numero_operacion']??''), trim($_POST['observacion']??'')); flash('success','Pago registrado','El pago se agregó correctamente.');}catch(Throwable $e){flash('error','No se pudo registrar',$e->getMessage());}
redirect('/admin/matriculas/show.php?id='.$id);
