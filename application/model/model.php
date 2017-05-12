<?php

class Model {

	public $dbHandler;

	public function __construct() {

		try {
			
			$this->dbHandler = new PDO(
				'sqlite:./db/Museum.db',
				'user',
				'password',
				array(
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
					PDO::ATTR_EMULATE_PREPARES => false
					)
				);

		}catch (PDOEXception $e){
			print new Exception($e->getMessage());
		}
	}

	public function dbCreateTable(){

		try {

			$this->dbHandler->exec("CREATE TABLE Museum
				(Id INTEGER PRIMARY KEY,
					Name TEXT,
					Origin TEXT,
					Year TEXT,
					Author TEXT,
					Materials TEXT,
					Location TEXT,
					Description TEXT,
					ImgPath TEXT,
					x3dPath TEXT,
					Texture TEXT)");

			return "The table Museum was created successfully";

		}catch(PDOEXception $e){
			print new Exception($e->getMessage());
		}

		$this->dbHandler = NULL;

	}

	public function dbInsertDataForm($data){

		try{

			$sql = "INSERT INTO Museum ( Name, Origin, Year, Author, Materials, Location, Description, ImgPath, x3dPath, Texture) 
			VALUES (:name, :origin, :year, :author, :materials, :location, :description, :imgPath, :x3dPath, :texture)";
			
			$stmt = $this->dbHandler->prepare($sql);

			$stmt->bindParam(':name', $data[0], PDO::PARAM_STR);
			$stmt->bindParam(':origin', $data[1], PDO::PARAM_STR);
			$stmt->bindParam(':year', $data[2], PDO::PARAM_STR);
			$stmt->bindParam(':author', $data[3], PDO::PARAM_STR);
			$stmt->bindParam(':materials', $data[4], PDO::PARAM_STR);
			$stmt->bindParam(':location', $data[5], PDO::PARAM_STR);
			$stmt->bindParam(':description', $data[6], PDO::PARAM_STR);
			$stmt->bindParam(':imgPath', $data[7], PDO::PARAM_STR);
			$stmt->bindParam(':x3dPath', $data[8], PDO::PARAM_STR);
			$stmt->bindParam(':texture', $data[9], PDO::PARAM_STR);

			$stmt->execute();		

			return "The data were inserted successfully";

		}catch(PDOEXception $e){
			print new Exception($e->getMessage());
		}

		$this->dbHandler = NULL;

	}

	public function dbGetJsonData($order){

		$order = str_replace("id=", "", $order);

		try{

			$sql = "SELECT * FROM Museum ORDER BY $order ASC";
			$stmt = $this->dbHandler->query($sql);

			$result = null;

			$i = 0;

			while($data = $stmt->fetch()){
				$result[$i]['Id'] = $data['Id'];
				$result[$i]['Name'] = $data['Name'];
				$result[$i]['Origin'] = $data['Origin'];
				$result[$i]['Year'] = $data['Year'];
				$result[$i]['Author'] = $data['Author'];
				$result[$i]['Materials'] = $data['Materials'];
				$result[$i]['Location'] = $data['Location'];
				$result[$i]['Description'] = $data['Description'];
				$result[$i]['ImgPath'] = $data['ImgPath'];
				$result[$i]['x3dPath'] = $data['x3dPath'];
				$result[$i]['Texture'] = $data['Texture'];

				$i++;
			}


		}catch(PDOEXception $e){
			print new Exception($e->getMessage());
		}

		$this->dbHandler = NULL;

		return json_encode($result);

	}

	public function dbGetImgPath(){

		try{

			$sql = "SELECT DISTINCT ImgPath FROM Museum";
			$stmt = $this->dbHandler->query($sql);

			$result = null;
			$i = 0;

			while($data = $stmt->fetch()){
				$result[$i] = $data['ImgPath'];
				$i++;
			}

		}catch(PDOEXception $e){
			print new Exception($e->getMessage());
		}

		$this->dbHandler = NULL;

		return $result;
	}

}

?>