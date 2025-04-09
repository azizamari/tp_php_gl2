<?php
class AttackPokemon {
    private $attackMinimal;
    private $attackMaximal;
    private $specialAttack;
    private $probabilitySpecialAttack;

    public function __construct($attackMinimal, $attackMaximal, $specialAttack, $probabilitySpecialAttack) {
        $this->attackMinimal = $attackMinimal;
        $this->attackMaximal = $attackMaximal;
        $this->specialAttack = $specialAttack;
        $this->probabilitySpecialAttack = $probabilitySpecialAttack;
    }

    public function getAttackMinimal() {
        return $this->attackMinimal;
    }

    public function getAttackMaximal() {
        return $this->attackMaximal;
    }

    public function getSpecialAttack() {
        return $this->specialAttack;
    }

    public function getProbabilitySpecialAttack() {
        return $this->probabilitySpecialAttack;
    }

    public function setAttackMinimal($attackMinimal) {
        $this->attackMinimal = $attackMinimal;
    }

    public function setAttackMaximal($attackMaximal) {
        $this->attackMaximal = $attackMaximal;
    }

    public function setSpecialAttack($specialAttack) {
        $this->specialAttack = $specialAttack;
    }

    public function setProbabilitySpecialAttack($probabilitySpecialAttack) {
        $this->probabilitySpecialAttack = $probabilitySpecialAttack;
    }
}
?>