<?php
if (isset($_GET["a"]) && isset($_GET["b"])) {
    $a = (float)$_GET["a"];
    $b = (float)$_GET["b"];
    $op = $_GET["op"] ?? 'somma';
    $risultato = 0;
    switch ($op) {
        case 'somma':
            $risultato = $a + $b;
            break;
        case 'differenza':
            $risultato = $a - $b;
            break;
        case 'prodotto':
            $risultato = $a * $b;
            break;
        case 'quoziente':
            $risultato = ($b != 0) ? ($a / $b) : "Impossibile dividere per zero";
            break;
    }
    if (is_numeric($risultato) && isset($_GET["options"]) && is_array($_GET["options"])) {
        foreach ($_GET["options"] as $option) {
            if ($option == "absolute") {
                $risultato = abs($risultato);
            }
            if ($option == "square") {
                $risultato = pow($risultato, 2);
            }
            if ($option == "round") {
                $risultato = round($risultato, 2);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcolatrice</title>
</head>
<body>
    <h1>Calcolatrice</h1>
    <form action="" method="GET">
        <div>
            <label for="a">a:</label>
            <input type="number" step="any" id="a" name="a" required value="<?php echo $_GET['a'] ?? ''; ?>">
        </div>
        <div>
            <label for="b">b:</label>
            <input type="number" step="any" id="b" name="b" required value="<?php echo $_GET['b'] ?? ''; ?>">
        </div>
            <div>
                <input type="radio" id="somma" name="op" value="somma" checked>
                <label for="somma">somma</label>
            </div>
            <div>
                <input type="radio" id="differenza" name="op" value="differenza">
                <label for="differenza">differenza</label>
            </div>
            <div>
                <input type="radio" id="prodotto" name="op" value="prodotto">
                <label for="prodotto">prodotto</label>
            </div>
            <div>
                <input type="radio" id="quoziente" name="op" value="quoziente">
                <label for="quoziente">quoziente</label>
            </div>
            <div>
                <input id="abs" type="checkbox" name="options[]" value="absolute" />
                <label for="abs">Valore assoluto</label>
            </div>
            <div>
                <input id="sqr" type="checkbox" name="options[]" value="square" />
                <label for="sqr">Quadrato</label>
            </div>
            <div>
                <input id="rnd" type="checkbox" name="options[]" value="round" />
                <label for="rnd">Arrotonda a 2 decimali</label>
            </div>
        <br>
        <input type="submit" value="Calcola">
    </form>
    <?php if (isset($risultato)): ?>
        <h2>Risultato: <?php echo $risultato; ?></h2>
    <?php endif; ?>
</body>
</html>