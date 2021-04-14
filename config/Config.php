<?php
    /**
     * Creación de una constante la cual nos guardará la ruta de nuestro proyecto
     */

    include_once('Funciones.php');

    if ( !defined('ROOT')){
        define("ROOT", 'http://'.$_SERVER['HTTP_HOST'].getFolderProject());
    }

?>