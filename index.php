<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>

<body>
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    <div class="container bootstrap snippets bootdey">
        <h3>Agregar jugador</h3>
        <form id="add-player">
            <div class="form-group">
                <label for="exampleInputEmail1">Nombre jugador</label>
                <input type="text" class="form-control" id="jugador_name" name="juga_nomb" placeholder="Nombre">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Apellido jugador</label>
                <input type="text" class="form-control" id="jugador_apellido" name="juga_apel" placeholder="Apellido">
            </div>
            <button type="submit" class="btn btn-primary">Agregar jugador</button>
        </form>
        <hr>
        </br>
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box no-header clearfix">
                    <div class="main-box-body clearfix">
                        <div class="table-responsive">
                            <table class="table user-list">
                                <thead>
                                    <tr>
                                        <th><span>Nombre</span></th>
                                        <th><span>Apellido</span></th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody id="body-table">
                                    <!-- Here goes the players -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container bootstrap snippets bootdey">
        <h3>Agregar equipo</h3>
        <form id="add-team">
            <div class="form-group">
                <label for="exampleInputEmail1">Nombre equipo</label>
                <input type="text" class="form-control" name="equi_nomb" placeholder="Nombre">
            </div>
            <button type="submit" class="btn btn-primary">Agregar equipo</button>
        </form>
        <hr>
        </br>
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box no-header clearfix">
                    <div class="main-box-body clearfix">
                        <div class="table-responsive">
                            <table class="table user-list">
                                <thead>
                                    <tr>
                                        <th><span>Nombre equipo</span></th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody id="body-team">
                                    <!-- Here goes the players -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $.ajax({
        type: "POST",
        url: "./controller.php",
        data: "action=get_players",
        success: function(data) {
            $("#body-table").append(data);
        }
    });

    $("#add-player").submit(function(e) {
        e.preventDefault();
        var form = $(this);

        $.ajax({
            type: "POST",
            url: "./controller.php",
            data: form.serialize() + "&action=create_player",
            success: function(data) {
                $("#body-table").append(data);
            }
        });
    });

    $("#body-table").on("click", "tr td a.delete-player", function(event) {
        var elem = $(this);
        var id = elem.data("id");

        $.ajax({
            type: "POST",
            url: "./controller.php",
            data: "juga_iden=" + id + "&action=delete_player",
            success: function(data) {
                elem.parents("tr").remove();
            }
        });
    });


    // Handle teams
    $.ajax({
        type: "POST",
        url: "./controller.php",
        data: "action=get_teams",
        success: function(data) {
            $("#body-team").append(data);
        }
    });

    $("#add-team").submit(function(e) {
        e.preventDefault();
        var form = $(this);

        $.ajax({
            type: "POST",
            url: "./controller.php",
            data: form.serialize() + "&action=create_team",
            success: function(data) {
                $("#body-team").append(data);
            }
        });
    });

    $("#body-team").on("click", "tr td a.delete-team", function(event) {
        var elem = $(this);
        var id = elem.data("id");

        $.ajax({
            type: "POST",
            url: "./controller.php",
            data: "equi_codi=" + id + "&action=delete_team",
            success: function(data) {
                elem.parents("tr").remove();
            }
        });
    });
</script>

</html>