<?php
  class Marker {

    private $conn;
    private $table = 'markers';

    public $accident_id;
    public $date;
    public $time;
    public $latitude;
    public $longitude;
    public $accident_severity;
    public $number_of_vehicles;
    public $number_of_casualties;
    public $speed_limit;

    public function __construct($db) {
      $this->conn = $db;
    }

    //display all markers in db
    public function read() {
      //Query
      $query = 'SELECT
            Accident_id,
            Longitude,
            Latitude,
            Date,
            Time,
            Accident_Severity,
            Number_of_Vehicles,
            Number_of_Casualties,
            Speed_limit
          FROM
          ' . $this ->table . '
      ';

      //Return Statement
      $stmt = $this->conn->prepare($query);

      $stmt->execute();

      return $stmt;
    }

    //Get data using single //
    public function single_marker() {

      $query = 'SELECT
            Accident_id,
            Longitude,
            Latitude,
            Date,
            Time,
            Accident_Severity,
            Number_of_Vehicles,
            Number_of_Casualties,
            Speed_limit
          FROM
          ' . $this ->table . '
          WHERE
            Accident_id = ?';

          //Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->accident_id);

          //Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->date = $row['Date'];
          $this->time = $row['Time'];
          $this->latitude = $row['Latitude'];
          $this->longitude = $row['Longitude'];
          $this->accident_severity = $row['Accident_Severity'];
          $this->number_of_vehicles = $row['Number_of_Vehicles'];
          $this->number_of_casualties = $row['Number_of_Casualties'];
    }

    //create markers
    public function create() {
      //Query
      $query = 'INSERT INTO ' .
          $this->table . '
        SET
          Date = :Date,
          Time = :Time,
          Latitude = :Latitude,
          Longitude = :Longitude,
          Accident_Severity = :Accident_Severity,
          Number_of_Vehicles = :Number_of_Vehicles,
          Number_of_Casualties = :Number_of_Casualties';

          //Return Statement
          $stmt = $this->conn->prepare($query);

          //Bind data
          $stmt->bindParam(':Date',$this->date);
          $stmt->bindParam(':Time',$this->time);
          $stmt->bindParam(':Latitude',$this->latitude);
          $stmt->bindParam(':Longitude',$this->longitude);
          $stmt->bindParam(':Accident_Severity',$this->accident_severity);
          $stmt->bindParam(':Number_of_Vehicles',$this->number_of_vehicles);
          $stmt->bindParam(':Number_of_Casualties',$this->number_of_casualties);

          //Execute
          if($stmt->execute()) {
            return true;
          }
          //if it doesn't work, get an error
          printf("Error: %s.\n", $stmt->error);

          return false;
    }



  //update existing marker
  public function update() {
    //Query
    $query = 'UPDATE ' .
        $this->table . '
      SET
        Date = :Date,
        Time = :Time,
        Latitude = :Latitude,
        Longitude = :Longitude,
        Accident_Severity = :Accident_Severity,
        Number_of_Vehicles = :Number_of_Vehicles,
        Number_of_Casualties = :Number_of_Casualties
        WHERE
          Accident_id = :Accident_id';

        //Return Statement
        $stmt = $this->conn->prepare($query);

        //Bind data
        $stmt->bindParam(':Date',$this->date);
        $stmt->bindParam(':Time',$this->time);
        $stmt->bindParam(':Latitude',$this->latitude);
        $stmt->bindParam(':Longitude',$this->longitude);
        $stmt->bindParam(':Accident_Severity',$this->accident_severity);
        $stmt->bindParam(':Number_of_Vehicles',$this->number_of_vehicles);
        $stmt->bindParam(':Number_of_Casualties',$this->number_of_casualties);
        $stmt->bindParam(':Accident_id',$this->accident_id);


        //Execute
        if($stmt->execute()) {
          return true;
        }
        //if it doesn't work, get an error
        printf("Error: %s.\n", $stmt->error);

        return false;
  }

  public function delete() {
    //Query
    $query = 'DELETE FROM ' . $this->table . ' WHERE Accident_id = :accident_id';

    //Prepare stmt
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(':accident_id', $this->accident_id);

    //Execute
    if($stmt->execute()) {
      return true;
    }
    //if it doesn't work, get an error
    printf("Error: %s.\n", $stmt->error);

    return false;


  }

}

 ?>
