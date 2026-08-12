# Implementación del módulo de pagos

El esquema del archivo `clinicabahia (2).sql` ya contiene `matriculas.precio_total` y la tabla `pagos`; por ello no se debe ejecutar la migración sobre esa base restaurada. `database/pagos_migration.sql` es solo para instalaciones antiguas.

## Flujo administrativo

1. Ingresar al panel en `admin/login.php`.
2. Abrir `pagos.php` y asignar el precio acordado a cada matrícula.
3. Registrar uno o más pagos. El servidor bloquea importes que superen el saldo, incluso si se altera el formulario.
4. Consultar el historial desde el ícono del reloj.

La protección de certificados requiere agregar `require_once 'admin_auth.php';` al inicio de `matricula.php` y `guardar_certificado.php`, y antes de crear el certificado validar que `precio_total > 0` y `SUM(pagos.monto) >= precio_total`.

## Entrega de certificados sin migración

El control de entrega del certificado no modifica MySQL. Se almacena en `storage/certificados_entrega.json` mediante `CertificadoEntregaStore`.
