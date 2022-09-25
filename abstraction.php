<?php

//~ Classe Abstraite : un contrat encore plus richement défini
//* Plus besoin de l'interface Travailleur
//* Une classe abstraite est une classe qui ne peut pas être instanciée car c'est abstrait
//* On s'assure de 2 choses : 1) personne ne pourra créer un humain, 2) les classes qui etendent la classe Humain doivent définir la méthode travailler()
//* on a un controle du code plus poussé
abstract class Humain
{
    public $nom;
    public $prenom;
    private $age;

    public function __construct($nom, $prenom, $age)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->setAge($age);
    }

    abstract public function travailler();

    public function setAge($age)
    {
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
}

class Employe extends Humain
{
    public function travailler() //! Obligation de définir la méthode travailler() car la classe Employe est une classe fille de la classe abstraite Humain.
    {
        return "Je suis un employé et je travaille";
    }

    //? Permet d'afficher les informations de l'employé
    public function presentation()
    {
        var_dump("Salut, je suis $this->prenom $this->nom et j'ai {$this->getAge()} ans.");
    }
}

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


//! la classe Etudiant hérite de la classe Humain
class Etudiant extends Humain
{
    public function travailler()
    {
        return "Je suis un étudiant et je travaille dur pour réussir mes études";
    }
}

//~ Notion de Polymorphisme : même nom de méthode mais comportement différent
function faireTravailler(Humain $objet)
{
    var_dump("Travail en cours : {$objet->travailler()}");
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

$etudiant = new Etudiant('Dupont', 'Jean', 20);
faireTravailler($etudiant);
