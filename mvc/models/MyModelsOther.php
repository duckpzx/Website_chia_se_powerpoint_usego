<?php 
    require_once ( __DIR__ . "/MyModels.php");
    
    class MyModelsOther extends MyModels {

        public function getRows($sql) 
        {
            $statement = $this->query($sql);

            if(!empty($statement))
            {
                return $statement->rowCount();
            }
            return 0; 
        }
        
        public function firstRaw($sql) 
        {
            $statement = $this->query($sql);
            
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
    }