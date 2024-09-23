<?php 
class Session {
    public static function setSession( $key, $value ) 
    {
        if ( !empty( session_id() ) ) 
        {
            $_SESSION[$key] = $value;
        }
    }

    public static function getSession( $key = '' )
    {
        return ( empty( $key ) ) ? $_SESSION : ( $_SESSION [ $key ] ?? null );
    }

    public static function removeSession( $key = '' )
    {
        if( empty( $key ) )
        {
            session_destroy();
            return true;
        }
        else if( isset( $_SESSION [ $key ] ) )
        {
            unset ( $_SESSION [ $key ]);
            return true;
        }
        return false;
    }

    /* Settings Session fast  */

    // Delete session fast 
    public static function removeFastSession( $key = '' )
    {
        if (empty( $key ))
        {  
            session_destroy();
            return true;
        } else
        {
            if ( isset( $_SESSION [ $key ] ) )
            {
                unset( $_SESSION [ $key ] );
                return true;
            }
        }
        return false;
    }
    
    // Insert fast session data 
    public static function setFastData( $key, $value )
    {
        $key = 'session_' . $key;
        return Session::setSession( $key, $value );
    }

    // Read fast session data 
    public static function getFastData( $key )
    {
        $keyOn = 'session_' . $key;
        $data = Session::getSession( $keyOn );
        Session::removeFastSession( $keyOn );
        return $data;
    }
}
