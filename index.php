<?php


function getPokemonData()
{
    // 1) genera número aleatorio
    $randomId = rand(1, 151);
    // 2) lee el contenido de la api 
    $texto = file_get_contents("https://pokeapi.co/api/v2/pokemon/$randomId");
    // 3) lo decodifica
    $pokemonData = json_decode($texto, true);
    // 4) Creo un objeto pokemon (me quedo sólo con los datos que necesito):
    // nombre (name)
    // imagen (sprites[front_default])
    // tipos (types[]-> dentro de cada elemento [type][name])
    $tipos = [];
    foreach ($pokemonData['types'] as $key => $value) {
        array_push($tipos, $value['type']['name']);
    }

    $pokemon = [
        "nombre" => $pokemonData['name'],
        "tipos" => $tipos
    ];
    return $pokemon;
}

$pokemon = getPokemonData();


function renderCards($pokeArray)
{

    // recibe datos y genera el html
    var_dump($pokeArray);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokeWeb</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>PokeCartas</h1>

    <section id="pokecartas">
        <div class="carta">
            <div class="img-container">
                <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/25.png" alt="pikachu">
            </div>
            <div class="datos">
                <h3>Pikachu</h3>
                <div class="tipos-pokemon">
                    <span>eléctrico</span>
                    <span>otro más</span>
                </div>
                <ul class="habilidades">
                    <li>impactrueno</li>
                    <li>chispitas</li>
                </ul>
            </div>
        </div>

    </section>
    <?php renderCards($pokemon) ?>
</body>

</html>