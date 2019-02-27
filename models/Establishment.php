<?php
class Establishment extends Model
{
    public $establishmentId = 0;
    public $establishmentName = "";
    public $shortName = "";
    public $departments = [];
  
  
    function __construct($establishmentID = 0) 
    {
        if ($establishmentID>0) {
            $sql = "SELECT * FROM establishments "
                    . "WHERE establishment_id=?";
            $stmt = DB::$connection->prepare($sql);
            $stmt->execute([(int)$establishmentID]);
            $this->initObjectFromArray($stmt->fetch());
            $this->getDepartments();
        }
    }
    
    public function update() 
    {
        $sql = "UPDATE establishments SET establishment_name=?, short_name=? "
                . "WHERE establishment_id=?;";
        $stmt = DB::$connection->prepare($sql);
        $result = $stmt->execute([
            $this->establishmentName,
            $this->shortName,
            (int)$this->establishmentId,
        ]);
        return $result;
    }
    
    public function create() 
    {
        $sql = "INSERT INTO establishments"
                . "(establishment_name, short_name) "
                . "VALUES  (?, ?)";
        $stmt = DB::$connection->prepare($sql);
        $result = $stmt->execute([
            $this->establishmentName,
            $this->shortName
        ]);
        $this->establishmentId = DB::$connection->lastInsertId();
        return $result;
    }
    
    public static function getEstablishments()
    {
      $sql = "SELECT * FROM establishments";
      $stmt = DB::$connection->prepare($sql);
      $result = $stmt->execute();
      return $stmt->fetchAll();
    }
    
    private function getDepartments()
    {
      $sql = "SELECT * FROM departments WHERE establishment_id=?";
      $stmt = DB::$connection->prepare($sql);
      $result = $stmt->execute([$this->establishmentId]);
      $this->departments = $stmt->fetchAll();
    }
    
}