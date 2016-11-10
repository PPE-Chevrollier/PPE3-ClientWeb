<?php
require_once '../class/connexion.class.php';

class jeuxVideosModele {

	private $idcJV = null;

	public function __construct() {
		// creation de la connexion afin d'executer les requetes
		try {
			$ConnexionJV = new Connexion();
			$this->idcJV = $ConnexionJV->IDconnexion;
		} catch ( PDOException $e ) {
			echo "<h1>probleme access BDD</h1>";
		}
	}
	public function add($nomjv,$anneesortie,$classification,$editeur,$description) {
		// ajoute ce jeux videos dans la BDD
		$nb = 0;
		if ($this->idcJV) {
			$req = "INSERT INTO jeuxvideos(`nomjv`, `anneesortie`, `classification`, `editeur`,`description`) VALUES  ('" . $nomjv . "','" . $anneesortie . "','" . $classification . "');";
			$nb = $this->idcJV->exec($req);
		}
		return $nb; // si nb =1 alors l'insertion s est bien passee
	}
	public function getID($nomjv,$anneesortie) {
		// recupere l'id du jeux videos correspondant ?  au nom et ? l'ann?e de sortie
		if ($this->idcJV) {
			$req= "SELECT idjv from jeuxvideos where nomjv=" . $nomjv . " and anneesortie=". $anneesortie . ";" ;
			$resultID = $this->idcJV->query($req);
			return $resultID;
		}
	}
        
	public function getJeuxVideoS() {
		// recupere TOUS LES jeux vid?os de la BDD
		if ($this->idcJV) {
                    
                    $req ="SELECT DISTINCT je.IDJV,
                    NOMJV,
                    ANNEESORTIE,
                    EDITEUR,
                    (SELECT GROUP_CONCAT(LIBELLE SEPARATOR ', ')
                    FROM correspondre c 
                    INNER JOIN genre g ON c.IDGENRE = g.IDGENRE
                    INNER JOIN jeuxvideos j ON c.IDJV = j.IDJV
                    WHERE j.IDJV = je.IDJV
                    GROUP BY j.IDJV) AS \"GENRE\"
                    FROM jeuxvideos je;";
                
                    $resultJV = $this->idcJV->query($req);
                    return $resultJV;
		}
	}
        
        public function getJeuxVideoTrie($idGenres, $colone, $sens, $anneeSortie, $editeur) {
            $trieGenre = false;
            $trieAnnee = false;
            if ($this->idcJV) {
                
                $req ="
                SELECT DISTINCT je.IDJV,
                NOMJV,
                ANNEESORTIE,
                EDITEUR,
                (SELECT GROUP_CONCAT(LIBELLE SEPARATOR ', ')
                FROM correspondre c 
                INNER JOIN genre g ON c.IDGENRE = g.IDGENRE
                INNER JOIN jeuxvideos j ON c.IDJV = j.IDJV
                WHERE j.IDJV = je.IDJV
                GROUP BY j.IDJV) AS \"GENRE\",
                (SELECT ROUND(AVG(NOTE), 1)
                FROM commentaire c
                INNER JOIN jeuxvideos j ON c.IDJV = j.IDJV
                WHERE j.IDJV = je.IDJV AND c.validation = 1
                GROUP BY j.IDJV) AS \"NOTE\"
                FROM jeuxvideos je
                LEFT JOIN correspondre ce ON je.IDJV = ce.IDJV";

                if ($idGenres != -1 || $anneeSortie != -1 || $editeur != -1)
                {
                    $req .= ' WHERE';
                }
                    
                
                if ($idGenres != -1){
                    $trieGenre = true;
                    $nb = count($idGenres);
                    $nbt = 0;

                    $req .= ' (';

                    foreach ($idGenres as $genre){
                        $nbt++;
                        $req .= ' ce.IDGENRE LIKE '.$genre;
                        if (($nb-1) == $nbt) $req.= ' OR';
                    }
                    
                    $req .= ')';
                }
                
                if ($anneeSortie != -1){
                    if ($trieGenre) $req .= ' AND';
                    
                    $req .= ' je.ANNEESORTIE LIKE '.$anneeSortie;
                    $trieAnnee = true;
                }
                
                if ($editeur != -1){
                    if ($trieAnnee || $trieGenre) $req .= ' AND';
                    $req .= ' je.EDITEUR LIKE "'.$editeur.'"';
                }
                
                $req .= ' ORDER BY UPPER('.$colone.') '.$sens;
                
                $resultJV = $this->idcJV->query($req);
                return $resultJV;
            }
        
        }
        
        public function getAnnee() {
        // recupere l'id du jeux videos correspondant ?  au nom et ? l'ann?e de sortie
            if ($this->idcJV) {
                return $this->idcJV->query('SELECT DISTINCT ANNEESORTIE FROM jeuxvideos ORDER BY ANNEESORTIE');
            }	
        }

        public function getEditeur() {
        // recupere l'id du jeux videos correspondant ?  au nom et ? l'ann?e de sortie
            if ($this->idcJV) {
                return $this->idcJV->query('SELECT DISTINCT EDITEUR FROM jeuxvideos ORDER BY UPPER(EDITEUR)');
            }

        }
}