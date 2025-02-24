<!-- Codigo del Modal del Historial -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Historial de Rondas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
        $rondas = $historia->obtenerHistorialDeRondas($_GET['idHistoria']);

        for ($i = 0; $i < count($rondas); $i++) {
	
          if ($i == 0) {
            echo "<div class='list-group m-2'>";
            echo "<a href='#' class='list-group-item list-group-item-action active' aria-current='true'>";
            echo "Ronda " . ($i + 1);
            echo "</a>";
          }
          if (($i > 0 && $rondas[$i]['idRonda'] != $rondas[$i - 1]['idRonda'])) {
            echo "</div>";
            echo "<div class='list-group m-2'>";
            echo "<a href='#' class='list-group-item list-group-item-action active' aria-current='true'>";
            echo "Ronda " . ($i + 1);
            echo "</a>";
          }

echo "<a href='#' class='list-group-item list-group-item-action' data-bs-toggle='modal' data-bs-target='#exampleModal2' onclick=\"setDescripcion('" . str_replace(array("\n", "\r"), "\\n", addslashes(htmlspecialchars($rondas[$i]['descripcion'], ENT_QUOTES))) . "', '" . addslashes(htmlspecialchars($rondas[$i]['valor'], ENT_QUOTES)) . "')\">" . $rondas[$i]['nombre'] . "</a>";

	
	


          if($i == count($rondas)-1){
            echo "</div>";
          }
        }
        ?>

            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Voto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Descripcion:</label>
                        <textarea class="form-control" id="message-text" disabled></textarea>
                    </div>

	<div class="mb-3">
    <label for="valor-text" class="col-form-label">Valor:</label>
    <input class="form-control" id="valor-text" name="valor" disabled>
</div>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<script>
function setDescripcion(descripcion, valor) {

    document.getElementById("message-text").value = descripcion;
document.getElementById("valor-text").value = valor
}
const exampleModal2 = document.getElementById('exampleModal')
if (exampleModal2) {
    exampleModal2.addEventListener('show.bs.modal', event => {

        const button = event.relatedTarget

        const recipient = button.getAttribute('data-bs-whatever')


        const modalBodyInput = exampleModal2.querySelector('.modal-body input')


        modalBodyInput.value = recipient
    })
}
</script>


<!-- Codigo del Modal del Historial -->