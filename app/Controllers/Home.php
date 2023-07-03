<?php

namespace App\Controllers;

use App\Models\cierreCajaModel;
use App\Models\userModel;
use App\Models\productModel;
use App\Models\ventaModel;
use DateTime;
use DateTimeZone;

class Home extends BaseController
{
    public function index()
    {



        $data = [
            'type' => session("type"),
            'fullname' => session('fullname'),
            'error' => session('error')
        ];
        if (!isset($data['fullname'])) {
            return redirect()->to('/ingresar');
        }

        if ($data['type'] == 'admin') {

            $pmodel = new productModel();

            $data["products"] = $pmodel->obtenerProductos();

            return view("admin", $data);

        }
        $carrito = session("carrito");
        $ventas = session("ventas");
        if (!isset($carrito)) {
            session()->set("carrito", []);
        }
        if (!isset($ventas)) {
            session()->set("ventas", []);
        }


        return view('index', $data);
    }
    public function ingresar()
    {
        $data = [
            "error" => session('error')
        ];

        return view('login_register', $data);
    }
    public function register()
    {

        $model = new userModel();

        $_POST['type'] = "empleado";

        $model->crearUsuario($_POST);

        $ss = session();

        $ss->set("fullname", $_POST['fullname']);
        $ss->set("type", $_POST['type']);

        return redirect()->to('/');
    }
    public function login()
    {
        $model = new userModel();

        try {
            $users = $model->obtUsuario(['email' => $_POST['email'], 'password' => $_POST['password']]);


            session()->set('fullname', $users[0]["fullname"]);
            session()->set('type', $users[0]["type"]);
            session()->set('id_user', $users[0]["id_user"]);

            return redirect()->to('/');
        } catch (\Throwable $th) {
            return redirect()->to('/ingresar')->with('error', 'Error al iniciar sesion');
        }
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/ingresar');
    }

    public function createNewProduct()
    {

        $file = $this->request->getFile('image');

        if (!$file->hasMoved() && $file->isValid()) {
            $newName = $file->getRandomName();
            $file->move('uploads/', $newName);

            $_POST['image'] = $newName;
        }

        $model = new productModel();

        $model->crearProducto($_POST);

        return redirect()->to('/');
    }
    public function updateAllProducts()
    {

        $pModel = new productModel();

        $data = json_decode($_POST['data'], true);

        foreach ($data as $key => $value) {
            $pModel->updateProducts($value);
        }
        return redirect()->to('/');
    }
    public function ingreso_productos()
    {
        $data = [
            "msg" => session("msg"),
            "fullname" => session("fullname")
        ];
        return view("ingresar_productos", $data);
    }
    public function ingresoCodigo()
    {
        $model = new productModel();
        $codigo = $_POST["codigoDeBarra"];
        $result = $model->obtenerCodigoDeBarras($codigo);
        if (count($result) > 0) {
            $producto = $result[0];
            if ($producto["stock"] > 0) {
                $model->updateProducts([
                    "id_product" => $producto["id_product"],
                    "stock" => $producto["stock"] - 1,

                ]);
                $carrito = session("carrito");
                array_push($carrito, $producto);
                session()->set("carrito", $carrito);

                return redirect()->to("/ingresar_productos")->with("msg", "Se agrego al carrito con exito");
            }
            return redirect()->to("/ingresar_productos")->with("msg", "No hay stock");
        }

        return redirect()->to("/ingresar_productos")->with("msg", "No se encontro el producto");

    }
    public function carrito()
    {
        $data = [
            "carrito" => session("carrito"),
            "alert" => session("alert"),
            "fullname" => session("fullname")
        ];
        return view("carrito", $data);
    }

    
    public function eliminarDeCarrito($codigo){
        $carrito = session('carrito');

        foreach ($carrito as $index => $product) {
            if($product['codigoDeBarra'] == $codigo){
                unset($carrito[$index]);
                break;                
            }
        }
        session()->set('carrito', $carrito);
        return redirect()->to('/carrito');
        
    }

    public function cobrar($total){
        $carrito = session('carrito');
        $ventaModel = new ventaModel();
        $idUser = session('id_user');
        $arrayProducts = [];
        foreach ($carrito as $index => $product) {
            array_push($arrayProducts, $product);
        }
        $venta =  [
            'id_user'=>$idUser,
            'products'=>json_encode($arrayProducts),
            'total'=>$total
        ];
        $idVenta = $ventaModel->createVenta($venta);
        session()->set('carrito', []);
        $ventas = session('ventas');
        array_push($ventas, $venta);
        session()->set('ventas', $ventas);
        
        return redirect()->to('/ticket/'.$idVenta);
        // return redirect()->to('/carrito')->with('alert', "Venta agregada con exito");
    }

    public function ticket($id){
        $ventamodel = new ventaModel();
        $venta = $ventamodel->getVentaById($id)[0];
        $venta["fullname"]=session("fullname");
        // return print_r($venta);
        return view('ticket', $venta);

    }
    public function caja(){
        $data = [
            "fullname"=> session('fullname'),
            "ventas" => session('ventas'),
            "alert" => session('alert')
        ];
        return view("caja", $data);
    }
    public function cerrarCaja(){
        $totalVentas = $_POST['totalVentas'];

        $now = new DateTime("now", new DateTimeZone('America/Argentina/Buenos_Aires'));
        $now = $now->format('d/m/Y');
        $user = session('id_user');

        $cierreCajaModel = new cierreCajaModel();

        $cierreCajaModel->createCierre([
            'id_user'=> $user,
            'fecha' => $now,
            'totalVentas' => $totalVentas
        ]);
        session()->set('ventas', []);
        
        $data = [
            "fullname"=> session('fullname'),
            "ventas" => session('ventas'),
        ];

        return redirect()->to('/caja')->with('alert', 'Caja cerrada con exito');
    }
    public function facturacion(){
        $type = session('type');
        if ($type != 'admin'){
            return redirect()->to('/');
        }

        $cierreCajaModel = new cierreCajaModel();
        $userModel = new userModel();
        $cierres = $cierreCajaModel->getCierres();

        foreach ($cierres as $index => $cierre) {
            $cierres[$index]['fullname'] = $userModel-> obtUsuario(['id_user'=>$cierre['id_user']])[0]['fullname'];
            
        }
        $data = [
            'fullname' => session('fullname'),
            'cierres' => $cierres
        ];

        return view('facturacion', $data);
    }
}