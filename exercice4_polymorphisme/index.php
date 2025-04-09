<?php
require_once 'AttackPokemon.php';
require_once 'Pokemon.php';
require_once 'PokemonFeu.php';
require_once 'PokemonEau.php';
require_once 'PokemonPlante.php';


$attackPokemon1 = new AttackPokemon(10, 100, 2, 20); // From the first Pokémon in the image
$pokemon1 = new PokemonFeu("charizard(Feu)", "https://www.google.com/url?sa=i&url=https%3A%2F%2Fpokemondb.net%2Fpokedex%2Fcharizard&psig=AOvVaw2odQsrU7Qr0Dqe17iVW9NV&ust=1744307198018000&source=images&cd=vfe&opi=89978449&ved=0CBQQjRxqFwoTCJjKnPXAy4wDFQAAAAAdAAAAABAE", 100, $attackPokemon1);

$attackPokemon2 = new AttackPokemon(10, 30, 4, 20); // From the last Pokémon in the image
$pokemon2 = new PokemonEau("squirtle (Eau)", "https://www.google.com/url?sa=i&url=https%3A%2F%2Fpokemon.fandom.com%2Ffr%2Fwiki%2FCat%25C3%25A9gorie%3APok%25C3%25A9mon_de_type_Eau&psig=AOvVaw1OrQxnZt7GIoCS1lryIxTO&ust=1744307289446000&source=images&cd=vfe&opi=89978449&ved=0CBQQjRxqFwoTCIjbw5XBy4wDFQAAAAAdAAAAABAE", 7, $attackPokemon2);

$attackPokemon3 = new AttackPokemon(10, 50, 3, 15);
$pokemon3 = new PokemonPlante("Venusaur (Plante)", "https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.pokepedia.fr%2FFlorizarre&psig=AOvVaw2Et2-nzcFQUrKU-DodO7uo&ust=1744307357815000&source=images&cd=vfe&opi=89978449&ved=0CBQQjRxqFwoTCKD607XBy4wDFQAAAAAdAAAAABAE", 80, $attackPokemon3);

$pokemons = [$pokemon1, $pokemon2, $pokemon3];

$battleLog = [];
$battleLog[] = "<h4>Battle 1: {$pokemon1->getName()} vs {$pokemon2->getName()}</h4>";
$round = 1;
$pokemon1->setHp(100);
$pokemon2->setHp(7);   

while (!$pokemon1->isDead() && !$pokemon2->isDead()) {
    $battleLog[] = "Round $round:";
    $battleLog[] = $pokemon1->attack($pokemon2);
    $battleLog[] = "{$pokemon2->getName()} HP: {$pokemon2->getHp()}";
    
    if (!$pokemon2->isDead()) {
        $battleLog[] = $pokemon2->attack($pokemon1);
        $battleLog[] = "{$pokemon1->getName()} HP: {$pokemon1->getHp()}";
    }
    $round++;
}

$winner = $pokemon1->isDead() ? $pokemon2 : $pokemon1;
$battleLog[] = "Winner: {$winner->getName()} with {$winner->getHp()} HP remaining!";

$battleLog[] = "<h4>Battle 2: {$pokemon1->getName()} vs {$pokemon3->getName()}</h4>";
$round = 1;
$pokemon1->setHp(100); 
$pokemon3->setHp(80); 

while (!$pokemon1->isDead() && !$pokemon3->isDead()) {
    $battleLog[] = "Round $round:";
    $battleLog[] = $pokemon1->attack($pokemon3);
    $battleLog[] = "{$pokemon3->getName()} HP: {$pokemon3->getHp()}";
    
    if (!$pokemon3->isDead()) {
        $battleLog[] = $pokemon3->attack($pokemon1);
        $battleLog[] = "{$pokemon1->getName()} HP: {$pokemon1->getHp()}";
    }
    $round++;
}

$winner = $pokemon1->isDead() ? $pokemon3 : $pokemon1;
$battleLog[] = "Winner: {$winner->getName()} with {$winner->getHp()} HP remaining!";


$battleLog[] = "<h4>Battle 3: {$pokemon2->getName()} vs {$pokemon3->getName()}</h4>";
$round = 1;
$pokemon2->setHp(7);  
$pokemon3->setHp(80); 

while (!$pokemon2->isDead() && !$pokemon3->isDead()) {
    $battleLog[] = "Round $round:";
    $battleLog[] = $pokemon2->attack($pokemon3);
    $battleLog[] = "{$pokemon3->getName()} HP: {$pokemon3->getHp()}";
    
    if (!$pokemon3->isDead()) {
        $battleLog[] = $pokemon3->attack($pokemon2);
        $battleLog[] = "{$pokemon2->getName()} HP: {$pokemon2->getHp()}";
    }
    $round++;
}

$winner = $pokemon2->isDead() ? $pokemon3 : $pokemon1;
$battleLog[] = "Winner: {$winner->getName()} with {$winner->getHp()} HP remaining!";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon Battle Simulator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .pokemon-card {
            margin: 20px 0;
        }
        .battle-log {
            margin-top: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center my-4">Pokémon Battle Simulator</h1>

        <div class="row">
            <?php foreach ($pokemons as $pokemon): ?>
                <div class="col-md-4 pokemon-card">
                    <div class="card">
                        <img src="<?php echo htmlspecialchars($pokemon->getUrl()); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($pokemon->getName()); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($pokemon->getName()); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($pokemon->whoAmI()); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="battle-log">
            <h3>Battle Log</h3>
            <?php foreach ($battleLog as $log): ?>
                <p><?php echo htmlspecialchars($log); ?></p>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>