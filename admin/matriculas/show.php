<?php
require_once __DIR__ . '/../../admin_auth.php';

use App\Repositories\MatriculaRepository;
use App\Repositories\CertificadoRepository;
use App\Support\CertificadoEntregaStore;

$id = (int)($_GET['id'] ?? 0);
$db = db();

$matRepo = new MatriculaRepository($db);
$mat = $matRepo->find($id);

if (!$mat) {
    http_response_code(404);
    exit('Matrícula no encontrada.');
}

$payments = $matRepo->payments($id);
$cert = (new CertificadoRepository($db))->findByMatricula($id);
if ($cert) {
    $delivery = (new CertificadoEntregaStore())->find((int) $cert['id']);
    $cert['entregado'] = $delivery['entregado'] ? 1 : 0;
    $cert['fecha_entrega'] = $delivery['fecha_entrega'];
}
$ps = payment_status((float)$mat['precio_total'], (float)$mat['pagado']);
$saldo = max(0, (float)$mat['precio_total'] - (float)$mat['pagado']);

$pageTitle = 'Detalle de matrícula';
include __DIR__ . '/../layouts/header.php';
include __DIR__ . '/../layouts/nav.php';
?>

<main class="container-fluid px-4 pb-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <div class="small text-muted mb-1">Matrícula MAT-<?=str_pad($id, 6, '0', STR_PAD_LEFT)?></div>
            <h2 class="fw-bold mb-1"><?=e($mat['nombre'].' '.$mat['apellido'])?></h2>
            <div class="text-muted"><?=e($mat['curso'])?></div>
        </div>
        <a href="<?=e(app_url('/admin/index.php'))?>" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Volver
        </a>
    </div>

    <div class="row g-4">

        <div class="col-xl-4">

            <div class="card p-4 mb-4">
                <h5 class="fw-bold mb-3">Datos del estudiante</h5>
                <dl class="row mb-0">
                    <dt class="col-5">DNI</dt>
                    <dd class="col-7"><?=e($mat['dni'])?></dd>
                    <dt class="col-5">Teléfono</dt>
                    <dd class="col-7"><?=e($mat['telefono'])?></dd>
                    <dt class="col-5">Correo</dt>
                    <dd class="col-7 text-break"><?=e($mat['correo'])?></dd>
                    <dt class="col-5">Matrícula</dt>
                    <dd class="col-7"><?=e(date('d/m/Y', strtotime($mat['fecha'])))?></dd>
                </dl>

                <div class="d-grid mt-4">
                    <a class="btn btn-danger" target="_blank"
                       href="<?=e(app_url('/admin/matriculas/ficha.php'))?>?id=<?=$id?>">
                        <i class="fa-solid fa-file-pdf me-1"></i> Ficha de matrícula
                    </a>
                </div>
            </div>

            <div class="card p-4">
                <h5 class="fw-bold mb-3">Estado de pago</h5>
                <div class="d-flex justify-content-between mb-2">
                    <span>Estado</span>
                    <span class="badge bg-<?=$ps['class']?>"><?=$ps['label']?></span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Precio acordado</span>
                    <strong><?=money($mat['precio_total'])?></strong>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Total pagado</span>
                    <strong class="text-success"><?=money($mat['pagado'])?></strong>
                </div>
                <div class="d-flex justify-content-between border-top pt-2">
                    <span class="fw-semibold">Saldo pendiente</span>
                    <strong class="text-danger"><?=money($saldo)?></strong>
                </div>
            </div>

        </div>

        <div class="col-xl-8">

            <div class="card p-4 mb-4">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h5 class="fw-bold mb-1">Pagos desglosados</h5>
                        <div class="small-muted"><?=count($payments)?> pago(s) registrado(s)</div>
                    </div>

                    <?php if ((float)$mat['precio_total'] <= 0): ?>
                        <a class="btn btn-outline-warning btn-sm"
                           href="<?=e(app_url('/admin/matriculas/price.php'))?>?id=<?=$id?>">
                            <i class="fa-solid fa-tag me-1"></i> Asignar precio
                        </a>
                    <?php elseif ($saldo > 0): ?>
                        <a class="btn btn-success btn-sm"
                           href="<?=e(app_url('/admin/pagos/create.php'))?>?id=<?=$id?>">
                            <i class="fa-solid fa-plus me-1"></i> Registrar pago
                        </a>
                    <?php endif; ?>
                </div>

                <?php if (!$payments): ?>
                    <div class="border rounded p-4 text-center text-muted">
                        <i class="fa-solid fa-receipt fa-2x mb-2"></i>
                        <div>No hay pagos registrados para esta matrícula.</div>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Fecha</th>
                                    <th>Método</th>
                                    <th>Operación</th>
                                    <th>Observación</th>
                                    <th class="text-end">Monto</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($payments as $p): ?>
                                <tr>
                                    <td><?=e(date('d/m/Y', strtotime($p['fecha'])))?></td>
                                    <td><span class="badge text-bg-light"><?=e($p['metodo_pago'])?></span></td>
                                    <td><?=e($p['numero_operacion'] ?: '—')?></td>
                                    <td><?=e($p['observacion'] ?: '—')?></td>
                                    <td class="text-end fw-bold text-success"><?=money($p['monto'])?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <th colspan="4" class="text-end">Total pagado</th>
                                    <th class="text-end text-success"><?=money($mat['pagado'])?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                <?php endif; ?>

            </div>

            <div class="card p-4">

                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="fw-bold mb-1">Certificado</h5>
                        <?php if ($cert): ?>
                            <div class="text-muted">Código <?=e($cert['codigo_verificacion'])?></div>
                        <?php else: ?>
                            <div class="text-muted">Todavía no se ha emitido un certificado.</div>
                        <?php endif; ?>
                    </div>

                    <div class="d-flex gap-2">
                        <?php if ($cert): ?>
                            <a class="btn btn-outline-danger btn-sm" target="_blank"
                               href="<?=e(app_url('/certificado.php'))?>?codigo=<?=urlencode($cert['codigo_verificacion'])?>">
                                <i class="fa-solid fa-file-pdf me-1"></i> PDF
                            </a>
                        <?php elseif ($ps['key'] === 'pagado'): ?>
                            <a class="btn btn-warning btn-sm"
                               href="<?=e(app_url('/admin/certificados/create.php'))?>?id=<?=$id?>">
                                <i class="fa-solid fa-certificate me-1"></i> Emitir
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if ($cert): ?>

                    <div class="row g-3 mt-3">

                        <div class="col-md-3">
                            <div class="small-muted">Estado</div>
                            <span class="badge <?=$cert['estado']==='ANULADO'?'bg-danger':'bg-success'?>">
                                <?=e($cert['estado'])?>
                            </span>
                        </div>

                        <div class="col-md-3">
                            <div class="small-muted">Fecha de emisión</div>
                            <div><?=e(date('d/m/Y', strtotime($cert['fecha_emision'])))?></div>
                        </div>

                        <div class="col-md-3">
                            <div class="small-muted">Entrega</div>
                            <?php if ($cert['estado'] === 'EMITIDO' && (int)$cert['entregado'] === 1): ?>
                                <span class="badge bg-success">Entregado</span>
                            <?php elseif ($cert['estado'] === 'EMITIDO'): ?>
                                <span class="badge bg-warning text-dark">Pendiente</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">No aplica</span>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-3">
                            <div class="small-muted">Fecha de entrega</div>
                            <div>
                                <?= $cert['fecha_entrega']
                                    ? e(date('d/m/Y H:i', strtotime($cert['fecha_entrega'])))
                                    : '—' ?>
                            </div>
                        </div>

                    </div>

                    <?php if ($cert['estado'] === 'EMITIDO'): ?>
                        <hr class="my-4">

                        <form method="post" action="<?=e(app_url('/actions/certificados/entrega.php'))?>">
                            <input type="hidden" name="id_certificado" value="<?=e($cert['id'])?>">
                            <input type="hidden" name="id_matricula" value="<?=$id?>">

                            <div class="row g-3 align-items-end">

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Fecha de entrega</label>
                                    <input
                                        type="datetime-local"
                                        name="fecha_entrega"
                                        class="form-control"
                                        value="<?=$cert['fecha_entrega'] ? date('Y-m-d\TH:i', strtotime($cert['fecha_entrega'])) : date('Y-m-d\TH:i')?>"
                                    >
                                </div>

                                <div class="col-md-4">
                                    <input type="hidden" name="entregado" value="0">
                                    <div class="form-check form-switch mt-2">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            role="switch"
                                            id="entregado"
                                            name="entregado"
                                            value="1"
                                            <?=$cert['entregado'] ? 'checked' : ''?>
                                        >
                                        <label class="form-check-label fw-semibold" for="entregado">
                                            Certificado entregado
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-4 text-md-end">
                                    <button class="btn btn-primary">
                                        <i class="fa-solid fa-floppy-disk me-1"></i>
                                        Guardar entrega
                                    </button>
                                </div>

                            </div>
                        </form>
                    <?php endif; ?>

                <?php endif; ?>

            </div>

        </div>

    </div>

</main>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
