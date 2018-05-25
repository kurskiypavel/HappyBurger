<?php
// Autoload classes as needed
namespace Application\Autoload;

class Loader
{

// Checks if file exist before requiring
    function loadFile($file)
    {
        if (file_exists($file)) {
            require_once $file;
            echo "ok";
            return TRUE;
        }
        echo "not";
        return FALSE;
    }
}


//TESTING
$file = "Loader.php";
$load = new Loader();
echo $load->loadFile($file);
//END_TESING

?>