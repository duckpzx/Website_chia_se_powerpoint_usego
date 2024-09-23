<?php 
    require_once ( __DIR__ . "/../core/Database.php");

    class MyModels extends Database {
        private $statement;

        public function query($sql, $data = []) 
        {
            try 
            {
                $statement = $this->conn->prepare($sql);
                
                $query = $statement->execute($data);

                return $statement;

            } catch (Exception $exc) 
            {
                die($exc->getMessage());    
            }
        }
    }
?>