<?php
include_once('../modelo/productos.php');
include_once('./panelGestionarProductos.php');
include_once('../shared/screenMensajeSistema.php');

class controlGestionarProductos {
    public function listarProductos() {
        $productos = new Productos();
        $productos = $productos->getProductos();
        $panelGestionarProductos = new panelGestionarProductos();
        $panelGestionarProductos->panelGestionarProductosShow($productos);
    }
}