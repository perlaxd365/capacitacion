<?php
require_once __DIR__ . '/../../admin_auth.php';
use App\Repositories\MatriculaRepository;
$id=(int)($_GET['id']??0);$m=(new MatriculaRepository(db()))->find($id);if(!$m){http_response_code(404);exit('Matrícula no encontrada.');}
$pageTitle='Precio acordado';include __DIR__.'/../layouts/header.php';include __DIR__.'/../layouts/nav.php';
?>
<main class="container pb-5"><div class="card p-4 mx-auto" style="max-width:650px"><div class="d-flex justify-content-between align-items-center mb-4"><div><h3 class="fw-bold mb-1">Precio acordado</h3><p class="text-muted mb-0"><?=e($m['nombre'].' '.$m['apellido'])?> · <?=e($m['curso'])?></p></div><a class="btn btn-outline-secondary" href="<?=e(app_url('/admin/matriculas/show.php'))?>?id=<?=$id?>">Cancelar</a></div><form method="post" action="<?=e(app_url('/actions/matriculas/update_price.php'))?>"><input type="hidden" name="id_matricula" value="<?=$id?>"><label class="form-label">Precio total (S/)</label><input class="form-control form-control-lg mb-2" name="precio_total" type="number" step="0.01" min="0.01" value="<?=e(number_format((float)$m['precio_total'],2,'.',''))?>" required><div class="form-text mb-4">No se permite establecer un precio menor al total que ya fue pagado.</div><button class="btn btn-primary btn-lg">Guardar precio</button></form></div></main><?php include __DIR__.'/../layouts/footer.php'; ?>
