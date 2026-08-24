   <br>
   <div class="container">
       <hr>
   </div><br>
   <!-- UBICACION -->
   <!-- UBICACIÓN -->
   <!-- UBICACIÓN -->
   <section class="ubicacion" id="ubicacion">

       <div class="container">

           <h2 class="text-center text-white section-title mb-4">
               📍 Encuéntranos aquí
           </h2>

           <p class="text-center text-white mb-4">
               Visítanos en nuestra sede de Nuevo Chimbote
           </p>

           <div class="map">
               <iframe
                   src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d492.41989308876026!2d-78.5234189!3d-9.1219969!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91ab85977c0e2a6b%3A0xc037d9d1008f741a!2siep%20hosanna!5e0!3m2!1ses-419!2spe!4v1787583280179!5m2!1ses-419!2spe"
                   width="100%"
                   height="450"
                   style="border:0; border-radius:16px;"
                   allowfullscreen=""
                   loading="lazy"
                   referrerpolicy="strict-origin-when-cross-origin"
                   title="Ubicación de Capacitaciones Médicas Bahía">
               </iframe>
           </div>

       </div>

   </section>




   <!-- BOTON WHATSAPP FLOTANTE -->
   <a href="https://wa.me/51982153926?text=Hola,%20quiero%20información%20sobre%20los%20cursos" class="whatsapp-float"
       target="_blank">

       <i class="fa-brands fa-whatsapp"></i>

   </a>
   <!-- FOOTER -->
   <footer class="footer text-center">
       Capacitaciones Médicas Bahía | Chimbote
   </footer>


   <!-- JS -->



   <!-- JQuery -->
   <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

   <!-- Bootstrap -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

   <!-- AOS -->
   <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

   <!-- SweetAlert -->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.22.4/dist/sweetalert2.all.min.js"></script>
   <script>
       console.log("Swal:", Swal);
   </script>
   <script>
       AOS.init({
           duration: 1000
       });


       function abrirFormulario(curso) {

           document.getElementById("cursoSelect").value = curso;

           var modal = new bootstrap.Modal(document.getElementById('modalFormulario'));
           modal.show();

       }
   </script>

   <script>
       $("#buscarAlumno").keyup(function() {

           var buscar = $(this).val();
           $.get(
               "buscar_alumno.php", {
                   buscar: buscar
               },
               function(data) {

                   $("#resultadoBusqueda").html(data);

               });

       });

       $(document).on("click", ".resultado", function() {

           $("#id_matricula").val($(this).data("id"));

           $("#nombre").val($(this).data("nombre"));

           $("#dni").val($(this).data("dni"));

           $("#curso").val($(this).data("curso"));

           $("#resultadoBusqueda").html("");

       });

       $(document).on("click", ".eliminar", function() {

           let id = $(this).data("id");

           Swal.fire({

               title: "¿Eliminar certificado?",

               text: "Esta acción no se puede deshacer.",

               icon: "warning",

               showCancelButton: true,

               confirmButtonColor: "#dc3545",

               cancelButtonColor: "#6c757d",

               confirmButtonText: "Eliminar",

               cancelButtonText: "Cancelar"

           }).then((result) => {

               if (result.isConfirmed) {

                   window.location = "eliminar_certificado.php?id=" + id;

               }

           });

       });
   </script>