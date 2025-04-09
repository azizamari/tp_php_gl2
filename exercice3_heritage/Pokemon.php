<?php
require_once 'AttackPokemon.php';

class Pokemon {
    private $name;
    private $url;
    private $hp;
    private $attackPokemon;

    public function __construct($name, $url, $hp, AttackPokemon $attackPokemon) {
        $this->name = $name;
        $this->url = $url;
        $this->hp = $hp;
        $this->attackPokemon = $attackPokemon;
    }

    public function getName() {
        return $this->name;
    }

    public function getUrl() {
        return $this->url;
    }

    public function getHp() {
        return $this->hp;
    }

    public function getAttackPokemon() {
        return $this->attackPokemon;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function setHp($hp) {
        $this->hp = $hp;
    }

    public function setAttackPokemon(AttackPokemon $attackPokemon) {
        $this->attackPokemon = $attackPokemon;
    }


    public function isDead() {
        return $this->hp <= 0;
    }

    public function attack(Pokemon $p) {
        $attackPoints = rand($this->attackPokemon->getAttackMinimal(), $this->attackPokemon->getAttackMaximal());
        $isSpecialAttack = rand(1, 100) <= $this->attackPokemon->getProbabilitySpecialAttack();

        if ($isSpecialAttack) {
            $attackPoints *= $this->attackPokemon->getSpecialAttack();
            $message = "{$this->name} performs a special attack on {$p->getName()} for {$attackPoints} damage!";
        } else {
            $message = "{$this->name} attacks {$p->getName()} for {$attackPoints} damage!";
        }

        $p->setHp($p->getHp() - $attackPoints);
        if ($p->getHp() < 0) {
            $p->setHp(0);
        }

        return $message;
    }

    public function whoAmI() {
        return "Name: {$this->name}, HP: {$this->hp}, Attack Minimal: {$this->attackPokemon->getAttackMinimal()}, Attack Maximal: {$this->attackPokemon->getAttackMaximal()}, Special Attack: {$this->attackPokemon->getSpecialAttack()}, Probability Special Attack: {$this->attackPokemon->getProbabilitySpecialAttack()}%";
    }
}
?>