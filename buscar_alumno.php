<?php
require_once __DIR__ . '/app/bootstrap.php';
$q=trim($_GET['buscar']??''); if($q==='')exit; $like="%{$q}%";$stmt=db()->prepare("SELECT id,nombre,apellido,dni,curso FROM matriculas WHERE dni LIKE ? OR nombre LIKE ? OR apellido LIKE ? OR CONCAT(nombre,' ',apellido) LIKE ? ORDER BY id DESC LIMIT 10");$stmt->bind_param('ssss',$like,$like,$like,$like);$stmt->execute();$r=$stmt->get_result();while($row=$r->fetch_assoc()){echo '<div class="p-3 border-bottom"><strong>'.e($row['nombre'].' '.$row['apellido']).'</strong><br><small>DNI '.e($row['dni']).' · '.e($row['curso']).'</small></div>';}
