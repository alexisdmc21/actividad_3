<?php
include 'templates/header.php';
?>

<h1>Gestion de categorias</h1>

<button type="button" class="btn btn-primary">Nueva categoria</button>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#categoriaModal">
    Nueva categoria
</button>

<table class="table table_striped" id="categoriasTable">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>

<div class="modal fade" id="categoriaModal" tabindex="-1" role="dialog" aria-labelledby="categoriaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoriaModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="categoriaForm">
                    <div class="form-group">
                        <label for="categoriaNombre">Nombre</label>
                        <input type="text" class="form-control" id="categoriaNombre" required>

                    </div>
                    <div class="form-group">
                        <label for="categoriaDescripcion">Descripcion</label>
                        <input type="text" class="form-control" id="categoriaDescripcion" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<?php
include 'templates/footer.php';
?>