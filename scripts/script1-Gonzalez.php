<?php


/**
 * Script con funciones auxiliares para la gestión de productos de un pedido.
 *
 * @author José Eugenio González Claros
 * @version 1.1 Modificación de versión
 * @since Versión 1.0
 * @access public
 * 
 */





/**
 * Función de preparación del array con los datos del cliente y los pedidos del formulario.
 * 
 *@param array $datosform el listado de productos elegidos por el cliente en el formulario.
 *@return array datos unificados de los productos y el cliente.
 */

function montarDatos($datosform)
{
    $datos['NCLIENTE'] = [$datosform['numcliente']];
    $datos['CLIENTEOK'] = false;
    $datos['FECHA'] = $datosform['fecha_entrega'];
    $datos['FECHAOK'] = false;
    for ($cont = 1; $cont < 11; $cont++) {
        if (isset($datosform['linea_prod' . $cont])) {
            $datos[$cont] = array('PRODUCTO' => $datosform['linea_prod' . $cont]);
        }
    }
    return $datos;
}

/**
 * Función de validación del código de cliente introducido.
 * 
 * La función no devuelve ningún valor sino que midifica un elemento del array que se usa como testigo.
 * 
 *@param array datos del cliente.
 */


function validarCliente(&$arrayDatos)
{
    if (preg_match('/[P,I,E][0-9]{5}/i', $arrayDatos['NCLIENTE'][0]) == 1) {
        $arrayDatos['CLIENTEOK'] = true;
    }
}


/**
 * Función de validación de la fecha introducida.
 * 
 * La función no devuelve ningún valor sino que midifica un elemento del array que se usa como testigo.
 * 
 *@param array datos del cliente.
 */

function validarFecha(&$arrayDatos)
{
    
    $fecha = strtotime($arrayDatos['FECHA']);
    var_dump($fecha) . 'Fecha<br><br>';
    if ($fecha) {
        $hoy = strtotime(date('d/m/Y'));
        var_dump($hoy) . 'Hoy<br><br>';
        if ($fecha > $hoy) {
            $arrayDatos['FECHAOK'] = true;
        }
    }
}
