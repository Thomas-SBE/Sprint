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
    <p><label for="agent">Les agents administratifs :</label> <select name="choisiagent">
            <?php
            echo $agentADM;
            ?>
        </select></p>
    <p><input type="date" id="date" value="2020-01-01" min="2020-01-01" max="2025-12-31"></p>
    <p><input type="submit" value="Visualiser son planning"></p>
</fieldset>






</body>
</html>