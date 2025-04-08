<?php

class Etudiant
{
    private string $nom;
    private array $notes;

    public function __construct(string $nom, ...$notes)
    {
        $this->nom = $nom;
        $this->notes = $notes;
    }

    public function __toString(): string
    {
        $notes="";
        foreach ($this->notes as $note) {
            $notes = implode(",", $this->notes);
        }
        return "Nom: $this->nom, Notes: $notes";
    }

    public function calcule_moyenne(): float
    {
        $somme = 0;
        foreach ($this->notes as $note) {
            $somme += $note;
        }
        return $somme / count($this->notes);
    }

    public function admis_ou_pas(): string
    {
        return $this->calcule_moyenne() >= 10 ? "Admis" : "Non admis";
    }

    public function display_etudiant_tableau()
    {
        $background_color="";
        echo "<div style='display: flex; gap: 20px;'>";
        echo "<ul style='list-style-type: none; padding-left: 0;'>";
        echo "<h2>{$this->nom}</h2>";
        foreach ($this->notes as $note) {
            if ($note > 10) {
                $background_color = "green";
            } 

            elseif ($note == 10) {
                $background_color = "orange";
            } 
            else {
                $background_color = "red";
            }
            echo "<li style='background-color: $background_color;padding: 5px;'>$note</li>";
        }
        echo"<li style='background-color: blue;padding: 5px;'>votre moyenne est: {$this->calcule_moyenne()}</li>";
        echo"</ul>";
        echo "</div>";
    }

}

$AYMEN = new Etudiant("Aymen", 11, 13, 18,7,10,13,2,5,1);
$SKANDER = new Etudiant("Skander", 15, 9, 8, 16);
$RAEF = new Etudiant("Raef", 12, 14, 9, 8, 7, 6, 5, 4, 3);

$SKANDER->display_etudiant_tableau();
$AYMEN->display_etudiant_tableau();
$RAEF->display_etudiant_tableau();
?>
