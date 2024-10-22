<?php

class core_template extends core_render
{

    public function __construct( $template, $content = null, $tags = null,
        $tagFormat = null, $search = true ) {

        $views       = "";
        $controllers = [];

// Layout - Body
        if ( $content === null ) {
            $bView       = core_template::checkFile( $template . ".tpl" );
            $bController = core_template::checkFile( $template . ".php" );

            if ( is_array( $bController ) ) {
                $controllers += $bController;
            }
        } else {
            $bView       = core_template::checkFile( $template );
            $bController = core_template::checkFile( $content );

            if ( is_array( $bController ) ) {
                $controllers += $bController;
            }
        }

        // Layout - Header
        $hView       = core_template::checkFile( "header.tpl" );
        $hController = core_template::checkFile( "header.php" );

        if ( is_array( $hController ) ) {
            $controllers += $hController;
        }

// Layout - Menu
        if ( (core_session::getSession('id') != null or core_session::getSession('id') === 0 ) and ( $template != 'changepass' or $template != 'login' ) ) {
            $mView       = core_template::checkFile( "menu.tpl" );
            $mController = core_template::checkFile( "menu.php" );

            if ( is_array( $mController ) ) {
                $controllers += $mController;
            }
        }

        // Layout - Footer
        $fView       = core_template::checkFile( "footer.tpl" );
        $fController = core_template::checkFile( "footer.php" );

        if ( is_array( $fController ) ) {
            $controllers += $fController;
        }

        // Layout - Combined View Elements
        $views .= $hView . $mView . $bView . $fView;

        // Final Layout
        parent::__construct( $views, $controllers, $tags, $tagFormat );
    }

    public function replaceArea( $key, $value )
    {
        $this->html = str_replace( $key, addslashes( $value ), $this->html );
    }

    public static function checkFile( $test )
    {
        if ( !is_string( $test ) ) {
            return $test;
        }

        if ( !preg_match( '/\.(php|tpl)$/', $test ) ) {
            return $test;
        }

// If neither file exists...
        if ( !file_exists( base_path . app_dir . "controllers/" . $test ) &&
            !file_exists( base_path . app_dir . "views/" . $test ) ) {
            return null;
        }

// Get contents of file
        if ( file_exists( base_path . app_dir . "controllers/" . $test ) ) {
            $fileContents = file_get_contents( base_path . app_dir .
                "controllers/" . $test );
        } else if ( file_exists( base_path . app_dir . "views/" . $test ) ) {
            $fileContents = file_get_contents( base_path . app_dir . "views/" .
                $test );
        } else {
            $fileContents = "";
        }

// File must contain at least a single whitespace character
        if ( !preg_match( '/\S/', $fileContents ) ) {
            return null;
        }

// Evaluate and process php file and return calculated values
        if ( preg_match( '/^(?>\s*)<\?php/', $fileContents ) ) {
            $tagPos = strpos( $fileContents, '<?php' );

            try {
                //prd($fileContents);
                $retVal = eval( substr( $fileContents, $tagPos + 5 ) );

                if ( $retVal === false ) {
                    throw new Exception( 'Parse error in checked file' );
                }
            } catch ( Exception $e ) {

                if ( file_exists( base_path . app_dir . "controllers/" . $test ) ) {
//exec("php -l '" . base_path . app_dir . "controllers/" . core_validator::makeSafe($test) . "'", $error);
                    //$retVal = "$error[1]";
                } else
                if ( file_exists( base_path . app_dir . "views/" . $test ) ) {
//exec("php -l '" . base_path . app_dir . "views/" . core_validator::makeSafe($test) . "'", $error);
                    //$retVal = "$error[1]";
                } else
                if ( core_template::checkFile( $test, 1, 0 ) ) {
                    $retVal = core_template::executeFile( $test, 1 );
                } else {
                    $retVal = core_template::executeFile( $test, 0 );
                }
            }

            return $retVal;
        }

        return $fileContents;
    }

    public static function render( $template, $content = null, $tags = null,
        $tagFormat = null, $stripTags = true, $searchForTags = true ) {
        $layout = new core_template( $template, $content, $tags, $tagFormat,
            $searchForTags );
        return ( $layout->__render( $stripTags ) );
    }
}
