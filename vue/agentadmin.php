<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page agent administratif</title>
    <link rel="stylesheet"  href="style/master.css" />
</head>
<body>

<fieldset>
    <form action="index.php" method="post">
        <p><label for="agent">Les agents administratifs :</label> <select name="choisiagent">
                <?php
                echo $agentADM;
                ?>
            </select></p>
        <p><input type="date" id="date" name="calendate" value="<?php echo($dateToday); ?>" min="2020-01-01" max="2025-12-31"></p>
        <p><input type="submit" value="Visualiser son planning" name="visuplanning"></p>
    </form>
</fieldset>
<table>
    <tr><th>Emploi du temps <?php if(isset($call["date"])){ echo("du ".$call["date"]);} ?> de <?php if(isset($call["name"])){ echo($call["name"]);} ?> </th></tr>
    <tr><td>07:00</td><?php if(isset($call["07"])){ echo("<td class='formation'>FORMATION</td>");} ?></tr>
    <tr><td>08:00</td><?php if(isset($call["08"])){ echo("<td class='formation'>FORMATION</td>");} ?></tr>
    <tr><td>09:00</td><?php if(isset($call["09"])){ echo("<td class='formation'>FORMATION</td>");} ?></tr>
    <tr><td>10:00</td><?php if(isset($call["10"])){ echo("<td class='formation'>FORMATION</td>");} ?></tr>
    <tr><td>11:00</td><?php if(isset($call["11"])){ echo("<td class='formation'>FORMATION</td>");} ?></tr>
    <tr><td>12:00</td><?php if(isset($call["12"])){ echo("<td class='formation'>FORMATION</td>");} ?></tr>
    <tr><td>13:00</td><?php if(isset($call["13"])){ echo("<td class='formation'>FORMATION</td>");} ?></tr>
    <tr><td>14:00</td><?php if(isset($call["14"])){ echo("<td class='formation'>FORMATION</td>");} ?></tr>
    <tr><td>15:00</td><?php if(isset($call["15"])){ echo("<td class='formation'>FORMATION</td>");} ?></tr>
    <tr><td>16:00</td><?php if(isset($call["16"])){ echo("<td class='formation'>FORMATION</td>");} ?></tr>
    <tr><td>17:00</td><?php if(isset($call["17"])){ echo("<td class='formation'>FORMATION</td>");} ?></tr>
    <tr><td>18:00</td><?php if(isset($call["18"])){ echo("<td class='formation'>FORMATION</td>");} ?></tr>
    <tr><td>19:00</td><?php if(isset($call["19"])){ echo("<td class='formation'>FORMATION</td>");} ?></tr>
    <tr><td>20:00</td><?php if(isset($call["20"])){ echo("<td class='formation'>FORMATION</td>");} ?></tr>
</table>






</body>
</html>
