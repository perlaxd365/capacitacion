<?php require_once __DIR__ . '/app/bootstrap.php'; $id=(int)($_GET['id']??0); header('Location: ' . app_url('/admin/matriculas/show.php?id='.$id)); exit;
