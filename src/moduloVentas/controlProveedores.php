<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/modelo/Eproveedor.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/shared/screenMensajeSistema.php');

class controlProveedores
{
    public function actualizarProveedor($id, $numeroRUC, $razonSocial, $telefono, $email, $direccion)
    {
        $modeloProveedor = new Eproveedor();

        // Verificar si el proveedor ya existe con el mismo RUC
        if ($modeloProveedor->verificarProveedorPorRUC($numeroRUC, $id)) {
            $viewMessage = new screenMensajeSistema();
            $viewMessage->screenMensajeSistemaShow('error', 'Error', 'El número RUC ya está registrado.');
            return;
        }

        // Actualizar proveedor
        $resultado = $modeloProveedor->actualizarProveedor($id, $numeroRUC, $razonSocial, $telefono, $email, $direccion);

        if ($resultado) {
            $viewMessage = new screenMensajeSistema();
            $viewMessage->screenMensajeSistemaShow(
                'Éxito',
                'Proveedor actualizado correctamente.',
                "<a href='/moduloVentas/indexProveedores.php' style='color: blue;'>Regresar al panel principal</a>"
            );
        } else {
            $viewMessage = new screenMensajeSistema();
            $viewMessage->screenMensajeSistemaShow(
                'Error',
                'No se pudo actualizar el proveedor. Inténtelo nuevamente.',
                "<a href='/moduloVentas/indexEditarProveedores.php?id=$id&numeroRUC=$numeroRUC&razonSocial=$razonSocial&telefono=$telefono&email=$email&direccion=$direccion' style='color: blue;'>Volver a editar proveedor</a>"
            );
        }
        
    }

    // Nuevo método para verificar si el RUC existe
    public function verificarProveedorPorRUC($numeroRUC, $idProveedor = null)
    {
        $modeloProveedor = new Eproveedor();
        return $modeloProveedor->verificarProveedorPorRUC($numeroRUC, $idProveedor);
    }
}
