<?php
class MySQL
{

 private $login;
 private $host = "localhost";
 private $passwd;
 private $db;
 private $query		= NULL;
 private $res		= NULL;
 private $error;
 private $con		= NULL;
 
 // ----------------------------
 // Déclaration du constructeur.
 // ----------------------------
  
 /** 
  * @param host nom du serveur hôte
  * @param login 
  * @param passwd
  * @param db nom de la base de données
  */
 function __construct($host=null, $login=null, $passwd=null, $db=null){
 	if (is_null($host)) {
		require 'mysql.php';
	}
	$this->host   = $host;
	$this->login  = $login;
	$this->passwd = $passwd;
	$this->db     = $db;
 }
 
 // --------------------------
 // Déclaration des fonctions.
 // --------------------------
  
 //Traitements.
 //Connecte à base de données, si erreur la fonction renvoie false, et on stock l'erreur.
 public function connection(){
	$this->con = mysql_connect($this->host, $this->login, $this->passwd);
	//On test si la connexion à réussie, sinon on stock l'erreur.
	if(!$this->con){
		$this->error = mysql_error();
		$GLOBALS['sql'] = $this->con;
		return false;
	}
	//On selectionne la db, si cela échoue, on sotck l'erreur.	
	if(isset($this->db)){
		$test = mysql_select_db($this->db);
		if(!$test) {
			$this->error = mysql_error();
			return false;
		} 
	}
	// On définit l'encodage des requêtes
	$res = mysql_query("SET NAMES 'utf8'");
	if (!$res) {
		$this->error = mysql_error();
		return false;
	}
	return true;
 }
 //Retourne vrai si la connection a bien été fermée.
 public function close(){
	$res = false;
	//Si la connexion existe ou n'à pas déjà été fermé
	//on la ferme est on détruit la variable con et on la passe àULL.
	if($this->con != NULL){
		$res = mysql_close($this->con);
		unset($this->con);
		$this->con = NULL;
	}
	return $res;
 }
 //Retourn vrai si l'execution de la requête c'est bien passésinon false + on stock l'erreur.
 public function execute($query){
	$res = false;
	if(is_string($query) && !empty($query)){
		$this->query = mysql_query($query, $this->con);
		//On teste le parsing à réussie, sinon on stock l'erreur.
		if(!$this->query)
			$this->error = mysql_error();
		else
			$res = $this->query;
	}
	return $res;
 }
 //Retourne un objet contenant les résultats de la requête.
 public function getObjectResult(){
	if(isset($this->query)){
		$row = mysql_fetch_object($this->query);
		if(!$row)
			$this->error = mysql_error();
		else
			return $row;
	}
 }
 //Retourne ligne par ligne les résultats de la requête sous forme de tableau associatif.
 public function getRowResult(){
	if(isset($this->query)){
		$row = mysql_fetch_array($this->query, MYSQL_ASSOC);
		if(!$row)
			$this->error = mysql_error();
		else
			return $row;
	}
 }
 //Retourne le nombre de lignes concernées ou NULL si erreur.
 public function getNumRows(){
	$nbRows = "abba";
	if(isset($this->query)){
		$nbRows = mysql_num_rows($this->query);
		if(!$row)
			$this->error = mysql_error();
	}
	return $nbRows;
 }
 //Retourne le nombre de colonnes concernées, ou NULL si erreur.
 public function getNumFields(){
	$nbFields = NULL;
	if(isset($this->query)){
		$nbFields = mysql_num_fields($this->query);
		if(!$nbFields)
			$this->error = mysql_error();
	}
	return $nbFields;
 }
 //Retourne le nom du numéro de la colonne passé en param, ou NULL si erreur.
 //@params: $num -> numéro de la colonne.
 public function getFieldName($num){
	$fieldName = NULL;
	if(isset($this->query) && is_numeric($num)){
		$fieldName = mysql_num_fields($this->query, $num);
		if(!$fields)
			$this->error = mysql_error();
	}
	return $fieldName;
 }
 //Retourne le type du champ de la colonne passé en param, ou NULL si erreur.
 //@params: $num -> numéro de la colonne.
 public function getFieldType($num){
	$fieldType = NULL;
	if(isset($this->query) && is_numeric($num)){
		$fieldType = mysql_field_type($this->query, $num);
		if(!$fieldType)
			$this->error = mysql_error();
	}
	return $fieldType;
 }
 //Retourne vrai si les ressources allouées ont été libérée.
 public function free(){
	$res = false;
	if(isset($this->query)){
		$res = mysql_free_result($this->query);
		if(!$res)
			$this->error = mysql_error();
	}
	return $res;
 }
 //----Fin des fonctions de traitement.
 
 //Accesseurs.
 public function getHost(){
	return $this->host;
 }
 public function getDb(){
	return $this->db;
 }
 public function getError(){
	return $this->error;
 }
  public function getQuery(){
	return $this->query;
 }
 //Mutateurs.
 public function setDb($db){
	if(isset($db) && is_string($db)){
		$this->db = $db;
	}
	$test = mysql_select_db($this->db, $this->con);
	if(!$test) $this->error = mysql_error();	
 }
 
public function getConvar(){
	$this->con;	
}

 public static function getResult($con, $query){
	if(isset($query)){
		$row = mysql_fetch_object($query, $con);
		if(!$row)
			echo mysql_error();
		else
			return $row;
	}
 }
}

