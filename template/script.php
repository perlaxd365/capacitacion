   <br>
   <div class="container">
       <hr>
   </div><br>
   <!-- UBICACION -->
   <section class="ubicacion text-center" id="ubicacion">

       <div class="container">

           <h3 class="fw-bold mb-3">
               Ubicación
           </h3>

           <p class="lead">
               Urb. Santa Rosa F'30<br>
               A media cuadra de Clínica Bahía – Chimbote
           </p>

           <i class="fa-solid fa-location-dot fa-2x"></i>

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