<?php
class carrito_compras extends Controller
{
    public function __construct() {
        session_start(); // Inicia la sesión para manejar el carrito
        parent::__construct(); // Llama al constructor de la clase padre (Controller)
    }

    public function index()
    {
        $data['title'] = 'Carrito de Compras';
        $data['active'] = 'carrito_compras'; // Para activar la opción del menú 
        $this->views->getView("carrito_compras", $data); // Carga la vista "carrito" y pasa los datos
    }

    public function agregarProducto($idProducto)
    {
        // Lógica para agregar un producto al carrito
        if (isset($_SESSION['carrito'][$idProducto])) {
            $_SESSION['carrito'][$idProducto]['cantidad']++;
        } else {
            $producto = $this->model->getProductoById($idProducto); // Obtiene los detalles del producto
            if ($producto) {
                $_SESSION['carrito'][$idProducto] = [
                    'nombre' => $producto['nombre'],
                    'precio' => $producto['precio'],
                    'cantidad' => 1
                ];
            }
        }
        header("Location: " . base_url . "carrito"); // Redirige al carrito
    }

    public function eliminarProducto($idProducto)
    {
        // Lógica para eliminar un producto del carrito
        if (isset($_SESSION['carrito'][$idProducto])) {
            unset($_SESSION['carrito'][$idProducto]);
        }
        header("Location: " . base_url . "carrito");
    }

    public function vaciarCarrito()
    {
        // Lógica para vaciar todo el carrito
        unset($_SESSION['carrito']);
        header("Location: " . base_url . "carrito");
    }
}
