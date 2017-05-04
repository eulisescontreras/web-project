<?php include 'assets/plantillas/header.php' ?>
        <div class="mdl-grid mdl-cell mdl-cell--9-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone mdl-cell--top">
            <!-- Table-->
            <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
                <div class="panel">
                    <table id="tableUsers" class="table mdl-data-table mdl-js-data-table mdl-shadow--2dp projects-table">
                        <thead>
                            <tr>
                                <th class="mdl-data-table__cell--non-numeric">Usuario</th>
                                <th class="mdl-data-table__cell--non-numeric">Contraseña</th>
                                <th class="mdl-data-table__cell--non-numeric">Roles</th>
                                <th class="mdl-data-table__cell--non-numeric">Permisos</th>
                                <th class="mdl-data-table__cell--non-numeric">Nombre Completo</th>
                                <th class="mdl-data-table__cell--non-numeric">Fecha de registro</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <br/>
                    <div>
                        <button data-toggle="modal" data-target="#modal-add-user-data" style="float: right;" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--fab mdl-shadow--8dp mdl-button--colored ">
                            <i class="material-icons mdl-js-ripple-effect">add</i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

<?php include 'assets/plantillas/footer.php' ?>