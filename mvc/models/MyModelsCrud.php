<?php 
    require_once ( __DIR__ . "/MyModels.php");
   
    class MyModelsCrud extends MyModels {

        public function getRaw( $sql ) 
        {
            $statement = $this->query( $sql );
            
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        // Read Data 
        
        public function insert( $table, $data ) 
        {

            $keyArr =  array_keys( $data );
            $fieldStr = implode(', ', $keyArr );
            $valueStr = ':'.implode(', :', $keyArr );

            $sql = 'INSERT INTO '. $table .'('.$fieldStr.') VALUES ('.$valueStr.')';
            
            return $this->query( $sql, $data );
        }
        // Add Data 

        public function update( $table, $data, $condition='' ) 
        {
            $updateStr = '';
            foreach($data as $key => $value) 
            {
                $updateStr .= $key .'=:'. $key .', ';
            }

            $updateStr = rtrim( $updateStr, ', ' );
            if(!empty( $condition )) 
            {
                $sql = 'UPDATE '.$table.' SET '.$updateStr.' WHERE '.$condition;
            } else 
            {
                $sql = 'UPDATE '.$table.' SET '.$updateStr;
            }
            return $this->query($sql, $data);
        }
        // Update Data

        public function remove( $table, $condition='' ) 
        {
            if(!empty( $condition ))
            {
                $sql = "DELETE FROM $table WHERE $condition";
            } else 
            {
                $sql = "DELETE FROM $table";
            }
            return $this->query( $sql );
        }
        // Delete Data 
    }
