<?php
require_once __DIR__ . '/../../admin_auth.php';
use App\Repositories\CertificadoRepository;
$id=(int)($_GET['id']??0); try{(new CertificadoRepository(db()))->delete($id);flash('success','Certificado eliminado','El registro fue eliminado.');}catch(Throwable $e){flash('error','Error',$e->getMessage());} redirect('/admin/index.php');
