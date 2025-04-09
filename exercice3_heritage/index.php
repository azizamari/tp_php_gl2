<?php
require_once 'Pokemon.php';
require_once 'AttackPokemon.php';

$attackPokemon1 = new AttackPokemon(10, 100, 2, 20);
$pokemon1 = new Pokemon("Mew", "https://www.pokemon.com/static-assets/content-assets/cms2/img/pokedex/full/151.png", 100, $attackPokemon1);

$attackPokemon2 = new AttackPokemon(10, 30, 4, 20); 
$pokemon2 = new Pokemon("Gengar", "https://www.pokemon.com/static-assets/content-assets/cms2/img/pokedex/full/094.png", 7, $attackPokemon2);

$pokemons = [$pokemon1, $pokemon2];

$battleLog = [];
$round = 1;

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon Battle</title>
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
                <div class="col-md-6 pokemon-card">
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