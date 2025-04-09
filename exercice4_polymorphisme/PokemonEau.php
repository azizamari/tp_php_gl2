<?php
require_once 'Pokemon.php';

class PokemonEau extends Pokemon {
    public function __construct($name, $url, $hp, AttackPokemon $attackPokemon) {
        parent::__construct($name, $url, $hp, $attackPokemon, "Eau");
    }

    public function attack(Pokemon $p) {
        $attackPoints = rand($this->attackPokemon->getAttackMinimal(), $this->attackPokemon->getAttackMaximal());
        $isSpecialAttack = rand(1, 100) <= $this->attackPokemon->getProbabilitySpecialAttack();

        if ($isSpecialAttack) {
            $attackPoints *= $this->attackPokemon->getSpecialAttack();
        }
        $multiplier = 1.0;
        if ($p->getType() === "Feu") {
            $multiplier = 2.0; 
        } elseif ($p->getType() === "Eau" || $p->getType() === "Plante") {
            $multiplier = 0.5; 
        }

        $attackPoints = (int)($attackPoints * $multiplier);
        $p->setHp($p->getHp() - $attackPoints);
        if ($p->getHp() < 0) {
            $p->setHp(0);
        }

        $message = $isSpecialAttack
            ? "{$this->name} (Eau) performs a special attack on {$p->getName()} ({$p->getType()}) for {$attackPoints} damage!"
            : "{$this->name} (Eau) attacks {$p->getName()} ({$p->getType()}) for {$attackPoints} damage!";
        return $message;
    }
}
?>