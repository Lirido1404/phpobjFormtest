<?php
require_once 'db_config.php'; // Inclure le fichier de configuration de la base de données

class Form {
    // ATTRIBUTS
    protected $formBegin;
    protected $formFinish;
    protected $fieldSetBegin;
    protected $fieldSetFinish;

    // METHODES
    public function __construct($formBegin = "<form>", $formFinish = "</form>", $fieldSetBegin = "<fieldset>", $fieldSetFinish = "</fieldset>") {
        $this->formBegin = $formBegin;
        $this->formFinish = $formFinish;
        $this->fieldSetBegin = $fieldSetBegin;
        $this->fieldSetFinish = $fieldSetFinish;
    }

    public function setText($name) {
        return "<input type='text' name='$name' placeholder='$name'>";
    }

    public function setSubmit($value) {
        return "<input type='submit' name='$value'>";
    }

    public function getForm() {
        global $pdo; // Rendre la variable $pdo disponible à l'intérieur de cette méthode
    
        // Initialisez les variables $prenom et $nom avec des valeurs par défaut
        $prenom = isset($_POST['Prenom']) ? $_POST['Prenom'] : '';
        $nom = isset($_POST['Nom']) ? $_POST['Nom'] : '';
    
        // Construction du formulaire HTML
        $form = $this->formBegin . $this->fieldSetBegin;
        $form .= $this->setText("Prenom") . "<br>"; // Afficher la valeur de $prenom
        $form .= $this->setText("Nom") . "<br>"; // Afficher la valeur de $nom
        $form .= $this->setSubmit("Valider");
        $form .= $this->fieldSetFinish;
        $form .= $this->formFinish;
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Vérifiez si le formulaire a été soumis
            if (isset($_POST['Valider'])) {
                // Affichage des valeurs récupérées du formulaire (pour le débogage)
                echo "Prénom : " . $prenom . "<br>";
                echo "Nom : " . $nom . "<br>";
    
                // Requête d'insertion des données dans la base de données
                $sql = "INSERT INTO FormData (Prenom, Nom) VALUES (:prenom, :nom)";
                $stmt = $pdo->prepare($sql);
    
                // Liaison des valeurs
                $stmt->bindParam(':prenom', $prenom);
                $stmt->bindParam(':nom', $nom);
    
                // Exécution de la requête
                $stmt->execute();
    
                echo "Données insérées avec succès.";
            }
        }
    
        return $form;
    }
    
    

}

// Usage
$form = new Form();
echo $form->getForm();
?>
