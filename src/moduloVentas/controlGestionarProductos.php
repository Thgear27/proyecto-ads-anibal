<?php
include_once('../modelo/productos.php');
include_once('./panelGestionarProductos.php');
include_once('./panelAgregarProducto.php');
include_once('../shared/screenMensajeSistema.php');

class controlGestionarProductos {
    public function listarProductos() {
        $productos = new Productos();
        $productos = $productos->getProductosBD();
        $panelGestionarProductos = new panelGestionarProductos();
        $panelGestionarProductos->panelGestionarProductosShow($productos);
    }

    public function mostrarFormAgregarProducto(){
        $panelAgregarProducto = new panelAgregarProducto();
        $panelAgregarProducto->panelAgregarProductoShow();
    }
}