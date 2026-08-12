# Capacitaciones Médicas Bahía

## Arquitectura administrativa

El sistema queda organizado alrededor de un único panel administrativo:

- `admin/index.php`: dashboard único con matrículas, cobranzas y certificados.
- `admin/matriculas/show.php`: expediente de una matrícula; muestra datos, pagos desglosados, saldo y certificado.
- `admin/matriculas/price.php`: asignación/edición del precio acordado.
- `admin/matriculas/ficha.php`: ficha PDF de matrícula.
- `admin/pagos/create.php`: registro de pagos.
- `admin/certificados/create.php`: emisión de certificados.
- `actions/`: operaciones POST.
- `app/Repositories/`: acceso a datos.
- `app/Database/Conexion.php`: conexión centralizada mediante `.env`.
- `admin/layouts/`: layout administrativo compartido.

Las páginas antiguas (`pagos.php`, `asignar_precio.php`, `registrar_pago.php`, `historial_pago.php`, etc.) se mantienen como redirecciones de compatibilidad para no romper enlaces existentes.

## Control de entrega de certificados

El control de entrega **no modifica la base de datos de producción**.

Se almacena temporalmente en:

`storage/certificados_entrega.json`

Para cada certificado se guarda:
- si fue entregado;
- fecha y hora de entrega.

El dashboard permite filtrar por pendiente/entregado y el detalle de cada matrícula permite registrar o revertir la entrega.

Los certificados existentes parten como **pendientes de entrega** hasta que el administrador los registre.

## Base de datos

El archivo SQL que se proporcionó se utilizó únicamente como referencia para conocer la estructura y los datos actuales. **Esta versión no requiere ejecutar ningún ALTER TABLE ni importar una base de datos nueva.**

## Configuración

1. Copia `.env.example` a `.env`.
2. Configura las credenciales de MySQL del entorno.
3. Mantén:

`ADMIN_USERNAME=admin`

y el hash de `.env.example`, que corresponde a:

`clinica123`

4. Si `vendor/` no se sube, ejecuta:

`composer install --no-dev`

No publiques `.env` en Git.

## Credenciales administrativas

Usuario: `admin`

Contraseña: `clinica123`

## Verificación

Antes de reemplazar producción, probar:

1. Página principal.
2. Registro de matrícula.
3. Login administrativo.
4. Dashboard y filtros.
5. Asignación de precio.
6. Registro y desglose de pagos.
7. Emisión de certificado.
8. Registro de entrega y fecha.
9. Ficha PDF.
10. Verificación del certificado.

## Producción: control de entrega de certificados

La versión actual NO requiere modificar la tabla `certificados` de la base de datos existente.
El estado de entrega y la fecha de entrega se almacenan temporalmente en `storage/certificados_entrega.json`.

Credenciales administrativas configuradas en `.env`:
- Usuario: `admin`
- Contraseña: `clinica123`

Conserva el `.env` real del servidor al desplegar. No lo sobrescribas con `.env.example`.
