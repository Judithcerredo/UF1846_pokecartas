<?php


function getPokemonData()
{
    // 1) El número aleatorio
    $Numaleatorio=rand(1,151);
    

    // 2) Se lee el contenido de la api 
    
    $url = "https://pokeapi.co/api/v2/pokemon/$Numaleatorio"; 
    $json = file_get_contents($url);

    // 3) lo decodifica
    $pokemonData = json_decode($json, true);   
    // 4) Creo un objeto pokemon (me quedo sólo con los datos que necesito):
    // nombre (name)
    // imagen (sprites[front_default])
    // tipos (types[]-> dentro de cada elemento [type][name])
    
    $tipos = [];
    foreach ($pokemonData['types'] as $key => $value) {
        array_push($tipos, $value['type']['name']);
    }

    $imagen = $pokemonData['sprites']['front_default'];

    $habilidades = [];
    foreach ($pokemonData['abilities'] as $ability) {
        array_push($habilidades, $ability['ability']['name']);
    }

    $pokemon = [
    "nombre" => $pokemonData['name'],
    "imagen" => $imagen,
    "tipos" => $tipos,
    "habilidades" => $habilidades
    ];

    return $pokemon;
}

$pokemon = getPokemonData();


function renderCards($pokeArray)
{

    echo
    
    '<div class="carta">
        <div class="img-container">
            <img src="' . $pokeArray['imagen'] . '" alt="' . $pokeArray['nombre'] . '">
        </div>
        <div class="datos">
            <h3>' . $pokeArray['nombre'] . '</h3>
    
    <div class="tipos-pokemon">';
            
    // Aqui muestra los tipos de pokemon
    foreach ($pokeArray['tipos'] as $tipo) {
        echo '<span>' . $tipo . '</span>';
    }
    
    echo '</div>
            
    <ul class="habilidades">';
    
    // Aquí las habilidades
    foreach ($pokeArray['habilidades'] as $habilidad) {
        echo '<li>' . $habilidad . '</li>';
    }

    echo '</ul>
        </div>
        </div>';
}

//La función con el for para que salgan 4 Pokemon en lugar de 1.

function RepeticionPokemon()
{
    echo '<div class="baraja">';
    for ($i = 0; $i < 4; $i++) {
        $pokemon = getPokemonData();
        renderCards($pokemon);
    }
    echo '</div>';
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

    <?php RepeticionPokemon()
    ?>
</body>

</html>
