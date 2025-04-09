<?php
require_once 'AttackPokemon.php';

abstract class Pokemon {
    protected $name;
    protected $url;
    protected $hp;
    protected $attackPokemon;
    protected $type;

    public function __construct($name, $url, $hp, AttackPokemon $attackPokemon, $type = "Normal") {
        $this->name = $name;
        $this->url = $url;
        $this->hp = $hp;
        $this->attackPokemon = $attackPokemon;
        $this->type = $type;
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

    public function getType() {
        return $this->type;
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

    abstract public function attack(Pokemon $p);

    public function whoAmI() {
        return "Name: {$this->name}, Type: {$this->type}, HP: {$this->hp}, Attack Minimal: {$this->attackPokemon->getAttackMinimal()}, Attack Maximal: {$this->attackPokemon->getAttackMaximal()}, Special Attack: {$this->attackPokemon->getSpecialAttack()}, Probability Special Attack: {$this->attackPokemon->getProbabilitySpecialAttack()}%";
    }
}
?>