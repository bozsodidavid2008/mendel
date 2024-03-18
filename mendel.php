<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mendeli öröklődési minta szimuláció | Bozsodi Dávid</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            margin: 0;
        }
        h2 {
            text-align: center;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="number"],
        input[type="submit"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        @media screen and (max-width: 600px) {
            form {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <h1><b>A program nem képes meg különböztetni nagy és kis karaktereket.Tehét használjon más karaktert!</b></h1>
    <h2>Mendeli öröklődési minta szimulációja | Bozsodi Dávid</h2>
    <form method="post">
        <label for="parent1">Első szülő genotípusa (pl. 'AA' vagy 'Aa'): </label>
        <input type="text" id="parent1" name="parent1" required><br>
        <label for="parent2">Második szülő genotípusa (pl. 'AA' vagy 'Aa'): </label>
        <input type="text" id="parent2" name="parent2" required><br>
        <label for="generations">Generációk száma: </label>
        <input type="number" id="generations" name="generations" required><br>
        <input type="submit" name="submit" value="Szimuláció elindítása">
    </form>

    <?php
    // Genotípusok kombinálása
    function combineGenotypes($parent1, $parent2) {
        $allele1 = $parent1[rand(0, 1)];
        $allele2 = $parent2[rand(0, 1)];

        // Utód genotípusának létrehozása a szülőktől kapott allélokból
        return $allele1 . $allele2;
    }

    // Mendeli öröklődési minta szimulációja
    function mendelianInheritance($parent1, $parent2, $generations) {
        $table = "<table><tr><th>Generáció</th><th>Szülők</th><th>Genotípusok az utódoknál</th></tr>";

        for ($i = 1; $i <= $generations; $i++) {
            $childrenGenotypes = [];
            
            $table .= "<tr><td>$i</td><td>$parent1 x $parent2</td><td>";

            // Számítás az utódok genotípusára
            for ($j = 0; $j < 4; $j++) {
                $childGenotype = combineGenotypes($parent1, $parent2);
                $childrenGenotypes[] = $childGenotype;
                $table .= "$childGenotype, ";
            }

            $table .= "</td></tr>";
        }

        $table .= "</table>";
        echo $table;
    }

    // Űrlap adatok feldolgozása és szimuláció indítása
    if(isset($_POST['submit'])) {
        $parent1 = strtoupper($_POST['parent1']);
        $parent2 = strtoupper($_POST['parent2']);
        $generations = intval($_POST['generations']);

        mendelianInheritance($parent1, $parent2, $generations);
    }
    ?>
</body>
</html>
