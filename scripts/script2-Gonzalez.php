<?php

/**
 * Clase con la definición de un Producto y sus métodos asociados.
 *
 * @package TareaDAW05
 * @author José Eugenio González Claros
 * @version 1.1 Modificación de versión
 * @since Versión 1.0
 * @access public
 * @see https://www.juntadeandalucia.es
 * 
 */

class Producto 
{

    private $id;
    private $cod;
    private $desc;
    private $precio;
    private $stock;

    //Métodos get de acceso a los atributos.


    /**
     * Método get del atributo id
     * 
     *@return int id del producto
     */

    public function getId()
    {
        return $this->id;
    }

    /** Método get del atributo precio
     * 
     *@return float precio del producto
     */

    public function getPrecio()
    {
        return $this->precio;
    }

    /** Método get del atributo descripción
     * 
     *@return string descripción del producto
     */

    public function getDesc()
    {
        return $this->desc;
    }

    /** Método get del atributo cod
     * 
     *@return string código del producto
     */

    public function getCod()
    {
        return $this->cod;
    }

    /** Método get del atributo stock
     * 
     *@return int stock del producto
     */

    public function getStock()
    {
        return $this->stock;
    }

    /** Método set para el atributo precio que controla si el valor es nulo o mayor que 0.
     * @param float precio a definir
     * @return bool true si se ha podido fijar el precio del producto o false si el parámetro no es un valor numérico o es menor o igual a 0.
     */

    public function setPrecio($num)
    {
        if ((!is_numeric($num)) || !($num > 0)) {
            return false;
        } else {
            $this->precio = $num;
            return true;
        }
    }

    /** Método set para el atributo stock que controla si el valor es nulo o mayor que 0.
     * @param int stock a definir
     * @return bool true si se ha podido fijar el stock del producto o false si el parámetro no es un valor numérico o es menor a 1.
     */

    public function setStock($num)
    {
        if ((!is_numeric($num)) || ($num < 1)) {
            return false;
        } else {
            $this->stock = $num;
            return true;
        }
    }

    /** Método set para el atributo código que verifica el uso de letras y números en el mismo.  
     * @param string codigo a definir
     * @return bool true si se ha podido fijar el código del producto o false si el parámetro no cumplía las normas de validación
     */
    public function setCod($codigo)
    {
        $ok = preg_match('/^[A-Z]+[0-9][0-9]+/', $codigo);
        if ($ok) {
            $this->cod = $codigo;
            return true;
        } else {
            return false;
        }
    }

     /** Método set para el atributo desc que verifica que tenga más de un carácter.
     * @param string descripción a definir
     * @return bool true si se ha podido fijar el código del producto o false si el parámetro tiene menos de 2 caracteres.
     */
    public function setDesc($descripcion)
    {
        $res = strip_tags(trim($descripcion));
        if (strlen($res) < 2) {
            return false;
        } else {
            $this->desc = $descripcion;
            return true;
        }
    }

    /** Método que devuelve el número de productos existente en la base de datos.
     * @param PDO conexión a la base de datos.
     * @return int número de objetos almacenados en la base de datos.
     * @return bool false si no se ha podido consultar la base de datos o ha habido algún problema.
     */
    public static function contar(PDO $db)
    {
        try {
            $consulta = $db->prepare('SELECT * FROM productos');
            $resultado = $consulta->execute();
            if ($resultado) {
                return $consulta->rowCount();
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }
}
