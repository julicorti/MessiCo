<?php

namespace App\Controllers;

use App\Models\userModel;
use App\Models\productModel;

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

        if($data['type']== 'admin'){

            $pmodel = new productModel();

            $data["products"] = $pmodel->obtenerProductos();

            return view("admin",$data);
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

    public function createNewProduct(){

        $file = $this->request->getFile('image');

        if(!$file->hasMoved() && $file->isValid()){
            $newName = $file->getRandomName();
            $file->move('uploads/', $newName);

            $_POST['image'] = $newName;
        }

        $model = new productModel();

        $model->crearProducto($_POST);

        return redirect()->to('/');
    }
    public function updateAllProducts(){

        $pModel = new productModel();

        $data = json_decode($_POST['data'], true);

        foreach ($data as $key => $value) {
            $pModel->updateProducts($value);
        }
        return redirect()->to('/');
    }
}
