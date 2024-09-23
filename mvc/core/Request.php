<?php 
    require_once ( __DIR__ . "/Database.php");

    class Request extends Database {
        public static function isPost() 
        {
            // Check POST 
            return ( $_SERVER['REQUEST_METHOD'] == 'POST' );
        }
        
        public static function isGet() 
        {
            // Check GET 
            return ( $_SERVER['REQUEST_METHOD'] == 'GET' );
        }
        
        public static function getBody() 
        {
            $bodyArrray = [];

            if( Request::isPost() )
            {
                foreach( $_POST as $key => $value )
                {
                    $key = trim( $key );
                    $value = trim( $value );
                    $key = htmlspecialchars( $key, ENT_NOQUOTES, 'UTF-8' );
                    $value = htmlspecialchars( $value, ENT_NOQUOTES, 'UTF-8' );
                    $key = stripcslashes( $key );
                    $value= stripcslashes( $value );
                    $bodyArrray[$key] = $value;
                }
            }

            if( Request::isGet() )
            {
                foreach( $_GET as $key => $value )
                {
                    $key = strip_tags( $key );
                    if( is_array( $value ) )
                    {
                        $bodyArrray [ $key ] = filter_input( INPUT_GET, $key,  
                        FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY );
                        return;
                    }
                    $bodyArrray [ $key ] = filter_input( INPUT_GET, $key, 
                    FILTER_SANITIZE_SPECIAL_CHARS );
                }
            }
            return $bodyArrray;
        }

        public static function Redirect( $to ) 
        {
            header("Location: $to");
            exit();
        }
    }
