<?php

//~ L'interface est un contrat qui qu'une classe signe et qu'elle doit respecter
//* Une interface est une liste de méthodes
//* Une classe qui implémente une interface doit définir toutes les méthodes de l'interface
interface Travailleur
{
    public function travailler();
}



//~ Les classes : organisation du code
//* Notion de classe qui permet de créer des objets et de simplifier et organiser le code
//* Les classes sont des "boites" qui contiennent des variables (propriétés) et des fonctions (méthodes)
//* Les classes sont des "modèles" qui permettent de créer des objets. Les objets sont des instances de classe.

//~ L'encapsulation : protection des données et des méthodes d'une classe (public, private, protected)
//* L'encapsulation permet de protéger les données et les méthodes d'une classe
//* Les propriétés et méthodes d'une classe peuvent être public, private ou protected
//* Les propriétés et méthodes public sont accessibles depuis l'extérieur de la classe
//* Les propriétés et méthodes private sont accessibles uniquement depuis la classe
//* Les propriétés et méthodes protected sont accessibles depuis la classe et ses classes filles
//* la Classe implemente l'interface Travailleur et doit donc définir la méthode travailler()

class Employe implements Travailleur
{
    public $nom;
    public $prenom;
    private $age; // private : je ne peux pas accéder à cette propriété depuis l'extérieur de la classe

    public function __construct($nom, $prenom, $age)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->setAge($age);  // on utilise la méthode setAge() pour modifier la propriété $age et sécuriser la donnée
    }

    // Définition de la méthode travailler() de l'interface Travailleur
    public function travailler()
    {
        return "Je suis un employé et je travaille";
    }

    //? Permet de modifier la propriété $age et de la sécuriser (encapsulation) en vérifiant qu'elle est bien un entier
    public function setAge($age)
    {
        // on vérifie que l'âge est bien un entier et qu'il est compris entre 1 et 120
        if (is_int($age) && $age >= 1 && $age < 120) {
            $this->age = $age;
        } else {
            throw new Exception("L'âge doit être un nombre entier compris entre 1 et 120 !");
        }
    }

    public function getAge()
    {
        return $this->age;
    }

    //? Permet d'afficher les informations de l'employé
    public function presentation()
    {
        var_dump("Salut, je suis $this->prenom $this->nom et j'ai $this->age ans.");
    }
}

//~Héritage : création de classes filles qui héritent des propriétés et méthodes d'une classe mère
//* L'héritage permet de créer des classes filles qui héritent des propriétés et méthodes d'une classe mère
//* Les classes filles héritent des propriétés et méthodes public et protected de la classe mère
//* Les classes filles ne peuvent pas hériter des propriétés et méthodes private de la classe mère
//* Les classes filles peuvent surcharger (redéfinir) les propriétés et méthodes héritées de la classe mère
//* Les classes filles peuvent ajouter des propriétés et méthodes propres à la classe fille

class Patron extends Employe
{
    public $voiture;

    public function __construct($nom, $prenom, $age, $voiture)
    {
        parent::__construct($nom, $prenom, $age); // on appelle le constructeur de la classe mère
        $this->voiture = $voiture;
    }

    //~ Surcharge de la méthode presentation() de la classe mère : PolyMorphisme (même nom de méthode mais comportement différent)

    public function presentation()
    {
        var_dump("Bonjour, je suis $this->prenom $this->nom et j'ai {$this->getAge()} ans et j'ai une voiture !");
        // on utilise la méthode getAge() pour récupérer la valeur de la propriété $age ou alors il faut passer la propriété en protected pour pouvoir l'utiliser dans la classe fille (mais pas en dehors de la classe)
    }

    public function travailler()
    {
        return "Je suis un patron et je gère mon entreprise";
    }


    public function rouler()
    {
        var_dump("Bonjour, je roule avec une $this->voiture de fonction.");
    }
}



$employe1 = new Employe('Trilles', 'Mika', 40);
$employe2 = new Employe('Lebrun', 'Sophie', 38);

$patron1 = new Patron('Dupont', 'Gérard', 59, 'Mercedes Class E');

$employe1->setAge(50);
$employe1->presentation();
faireTravailler($employe1);

$employe2->presentation();

$patron1->presentation();
$patron1->rouler();
faireTravailler($patron1);


//! Exemple avec une autre classe sans héritage
class Etudiant implements Travailleur
{
    public function travailler()
    {
        return "Je suis un étudiant et je travaille dur pour réussir mes études";
    }
}


$etudiant = new Etudiant();
faireTravailler($etudiant);




//~ Notion d'abstraction : on ne peut pas instancier une classe abstraite, on se fout de la façon dont c'est fait et de ce que ça fait, on veut juste faire

//~ Polymorphisme : même nom de méthode mais comportement différent (plus précisement polymorphisme ad-hoc car les classes appelées sont différentes)

//* Fonction qui prend en paramètre un objet qui implémente l'interface Travailleur et qui appelle la méthode travailler() de l'objet

function faireTravailler(Travailleur $objet)
{
    var_dump("Travail en cours : {$objet->travailler()}");
}
