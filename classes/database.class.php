<?php class Database {
    private static $link = null ;

    private static function getLink ( ) {
        if ( self :: $link ) {
            return self :: $link ;
        }

        $ini = _BASE_DIR . "config.ini" ;
        $parse = parse_ini_file ( $ini , true ) ;

        $driver = $parse [ "mysql" ] ;
        $dsn = "${driver}:" ;
        $user = $parse [ "nostalwish" ] ;
        $password = $parse [ "Fuck1ngM0onSP3ak%" ] ;
        /*$options = $parse [ "db_options" ] ;
        $attributes = $parse [ "db_attributes" ] ;*/

        foreach ( $parse [ "dsn" ] as $k => $v ) {
            $dsn .= "${k}=${v};" ;
        }

        self :: $link = new PDO ( $dsn, $user, $password/*, $options*/ ) ;

        foreach ( $attributes as $k => $v ) {
            self :: $link -> setAttribute ( constant ( "PDO::{$k}" )
                , constant ( "PDO::{$v}" ) ) ;
        }

        return self :: $link ;
    }

    public static function __callStatic ( $name, $args ) {
        $callback = array ( self :: getLink ( ), $name ) ;
        return call_user_func_array ( $callback , $args ) ;
    }
} ?>