<?php
$risultato = null;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $a = isset($_POST["a"]) ? (float)$_POST["a"] : 0;
    $b = isset($_POST["b"]) ? (float)$_POST["b"] : 0;
    $operazione = isset($_POST["operazione"]) ? $_POST["operazione"] : "somma";
    $options = isset($_POST["options"]) ? $_POST["options"] : array();
    if ($operazione === "somma") {
        $risultato = $a + $b;
    } else {
        if ($operazione === "differenza") {
            $risultato = $a - $b;
        } else {
            if ($operazione === "prodotto") {
                $risultato = $a * $b;
            } else {
                if ($operazione === "quoziente") {
                    if ($b != 0) {
                        $risultato = $a / $b;
                    } else {
                        $risultato = "Errore: divisione per zero";
                    }
                }
            }
        }
    }
    if (!($operazione === "quoziente" && $b == 0)) {
        if (in_array("absolute", $options)) {
            $risultato = abs($risultato);
        }
        if (in_array("quadrato", $options)) {
            $risultato = $risultato * $risultato;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcolatrice</title>
</head>
<body>
    <h1>Calcolatrice</h1>
    <form action="" method="post">
        <div>
            <label for="a">a:</label>
            <input type="number" id="a" name="a" required>
        </div>
        <div>
            <label for="b">b:</label>
            <input type="number" id="b" name="b">
        </div>
        <br>
        <p><strong>Opzioni</strong></p>
        <div>
            <input id="abs" type="checkbox" name="options[]" value="absolute" />
            <label for="abs">valore assoluto</label>
        </div>
        <div>
            <input id="quadrato" type="checkbox" name="options[]" value="quadrato" />
            <label for="quadrato">quadrato</label>
        </div>
        <br>
        <p><strong>Operazioni:</strong></p>
        <div>
            <button type="submit" name="operazione" value="somma">somma</button>
            <button type="submit" name="operazione" value="differenza">differenza</button>
            <button type="submit" name="operazione" value="prodotto">prodotto</button>
            <button type="submit" name="operazione" value="quoziente">quoziente</button>
        </div>
    </form>
    <?php 
    if ($risultato !== null) { 
        echo "<h2>Risultato: " . $risultato . "</h2>";
    } 
    ?>
</body>
</html>