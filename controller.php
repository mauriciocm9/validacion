<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Not method allowed";
    exit(0);
}

$template1 = <<<EOD
<tr>
    <td>
        <span class="user-subhead">%s</span>
    </td>
    <td>
        <span class="user-subhead">%s</span>
    </td>
    <td style="width: 20%%;">
        <a href="#" class="table-link">
            <span class="fa-stack">
                <i class="fa fa-square fa-stack-2x"></i>
                <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
            </span>
        </a>
        <a href="#" class="table-link">
            <span class="fa-stack">
                <i class="fa fa-square fa-stack-2x"></i>
                <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
            </span>
        </a>
        <a href="#" class="table-link danger">
            <span class="fa-stack">
                <i class="fa fa-square fa-stack-2x"></i>
                <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
            </span>
        </a>
    </td>
</tr>
EOD;

include './model.php';

if($_POST["action"] === "create_player") {
    $name = $_POST["juga_nomb"];
    $lastname = $_POST["juga_apel"];

    $rowsCount = createNewPlayer($name, $lastname);
    if($rowsCount != 1) {
        exit(0);
    }

    printf($template1, $name, $lastname);
}

if($_POST["action"] === "get_players") {
    $players = getPlayers();
    foreach($players as $player){
        printf($template1, $player["juga_nomb"], $player["juga_apel"]);
    }
}

if($_POST["action"] === "delete_player") {
    $rowsCount = deletePlayer($_POST["juga_iden"]);
    if($rowsCount != 1) {
        exit(0);
    }
}
?>