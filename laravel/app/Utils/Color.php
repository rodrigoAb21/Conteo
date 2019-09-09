<?php


namespace App\Utils;


class Color
{
    public $nombre = '';
    public $valor = '';

    public function __construct($nombre, $valor)
    {
        $this->nombre = $nombre;
        $this->valor = $valor;
    }

    public static function getColores(){
        $colores = [];
        $colores[] = new Color('Rojo', '#ff0000');
        $colores[] = new Color('Amarillo', '#ffff00');
        $colores[] = new Color('Azul', '#0000ff');
        $colores[] = new Color('Verde', '#008f39');
        $colores[] = new Color('Anaranjado', '#ff8000');
        $colores[] = new Color('Morado', '#ee82ee');
        $colores[] = new Color('Negro', '#000000');
        $colores[] = new Color('Blanco', '#ffffff');

        return $colores;
    }
}