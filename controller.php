<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Not method allowed";
    exit(0);
}

$templatePlayer = <<<EOD
<tr>
    <td>
        <span class="user-subhead">%s</span>
    </td>
    <td>
        <span class="user-subhead">%s</span>
    </td>
    <td style="width: 20%%;">
        <a href="#" class="delete-player table-link danger" data-id=%d>
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

    $id = createNewPlayer($name, $lastname);
    if($id <= 0) {
        exit(0);
    }

    printf($templatePlayer, $name, $lastname, $id);
}

if($_POST["action"] === "get_players") {
    $players = getPlayers();
    foreach($players as $player){
        printf($templatePlayer, $player["juga_nomb"], $player["juga_apel"], $player["juga_iden"]);
    }
}

if($_POST["action"] === "delete_player") {
    $rowsCount = deletePlayer($_POST["juga_iden"]);
    if($rowsCount != 1) {
        exit(0);
    }
}

$templateTeam = <<<EOD
<tr>
    <td>
        <span class="user-subhead">%s</span>
    </td>
    <td style="width: 20%%;">
        <a href="#" class="delete-team table-link danger" data-id=%d>
            <span class="fa-stack">
                <i class="fa fa-square fa-stack-2x"></i>
                <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
            </span>
        </a>
    </td>
</tr>
EOD;

if($_POST["action"] === "create_team") {
    $name = $_POST["equi_nomb"];

    $id = createNewTeam($name);
    if($id <= 0) {
        exit(0);
    }

    printf($templateTeam, $name, $id);
}

if($_POST["action"] === "get_teams") {
    $teams = getTeams();
    foreach($teams as $team){
        printf($templateTeam, $team["equi_nomb"], $team["equi_codi"]);
    }
}

if($_POST["action"] === "delete_team") {
    $rowsCount = deleteTeam($_POST["equi_codi"]);
    if($rowsCount != 1) {
        exit(0);
    }
}

?>