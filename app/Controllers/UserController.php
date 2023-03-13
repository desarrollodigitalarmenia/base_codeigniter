<?php 
namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\Controller;
use App\Models\RolModel;
class UserController extends Controller
{
    // show dashboard
    public function dashboard(){
        $session = session();
        $data['data_context_admin'] = $session->get("userdata_admin");
        
        if($data['data_context_admin'] == null)
            return redirect()->to('/login');


        echo view('backend/header' , $data);
        echo view('admin/dashboard' , $data);
        echo view('backend/footer' , $data);
    }

    // show users list
    public function index(){
        $session = session();
        $data['data_context_admin'] = $session->get("userdata_admin");

        $userModel = new UserModel();
        $data['users'] = $userModel->orderBy('id', 'DESC')->findAll();

        echo view('backend/header', $data);
        echo view('admin/user/list_view', $data);
        echo view('backend/footer', $data);
    }
    
    // add user form
    public function create(){
        $session = session();
        $data['data_context_admin'] = $session->get("userdata_admin");

        $rolModel = new RolModel();
        $data['roles'] = $rolModel->orderBy('id', 'DESC')->findAll();

        echo view('backend/header', $data);
        echo view('admin/user/add_view', $data);
        echo view('backend/footer', $data);
    }
 
    // insert data
    public function store() {

        $userModel = new UserModel();
        $data = [
            'name'      => $this->request->getVar('name'),
            'email'     => $this->request->getVar('email'),
            'rol'       => $this->request->getVar('rol'),
            'password'  => md5($this->request->getVar('password'))
        ];
        
        $userModel->insert($data);

        $session = session();
        $data['data_context_admin'] = $session->get("userdata_admin");

        echo view('backend/header', $data);
        $this->response->redirect(site_url('admin/user/list'));
        echo view('backend/footer', $data);
    }

    // show single user
    public function singleUser($id = null){
        $session = session();
        $data['data_context_admin'] = $session->get("userdata_admin");

        $userModel = new UserModel();
        $data['user_obj'] = $userModel->where('id', $id)->first();

        $rolModel = new RolModel();
        $data['roles'] = $rolModel->orderBy('id', 'ASC')->findAll();

        echo view('backend/header', $data);
        echo view('admin/user/edit_view', $data);
        echo view('backend/footer', $data);
    }

    // update user data
    public function update(){
        $userModel  = new UserModel();
        $id         = $this->request->getVar('id');
        $password1  = $this->request->getVar('password1');
        $password2  = $this->request->getVar('password2');

        if($password1 != ""){
            if($password1 == $password2){
                $password = md5($password1);
            }else{
                $session->setFlashdata('msg', 'Passwords not match');
                return redirect()->to('/');
            }
        }else{
            $session->setFlashdata('msg', 'Email not Found');
            return redirect()->to('/');
        }
        

        $data = [
            'name'      => $this->request->getVar('name'),
            'email'     => $this->request->getVar('email'),
            'password'  => $password
        ];

        $userModel->update($id, $data);

        $session = session();
        $data['data_context_admin'] = $session->get("userdata_admin");

        echo view('backend/header', $data);
        $this->response->redirect(site_url('admin/user/list'));
        echo view('backend/footer', $data);
    }
 
    // delete user
    public function delete($id = null){
        $userModel = new UserModel();
        $data['user'] = $userModel->where('id', $id)->delete($id);

        $session = session();
        $data['data_context_admin'] = $session->get("userdata_admin");
        
        if($data['data_context_admin'] == null)
            return redirect()->to('/login');

        echo view('backend/header',$data);
        $this->response->redirect(site_url('admin/user/list'));
        echo view('backend/footer',$data);
    }

    /*
    public function login(){
        $session = session();

        $model = new UserModel();

        $email = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        
        $data = $model->where('email', $email)->first();
        
        print_r($data);
        die();

        if($data){
            $pass       = $data['password'];
            $passhash   = md5($password);
            echo 'hash pass:<br/>'.$passhash.'<br/>'.$pass;
            die();
            $verify_pass = ($passhash==$pass)?true:false;
            if($verify_pass){
                $session->set("userdata_admin", array(
                    "user_id" => $data['id'],
                    "user_name" => $data['name'],
                    "user_email" => $data['email'],
                    "user_role" => $data['role']
                  ));
                return redirect()->to('/admin');
            }else{
                $session->setFlashdata('msg', 'Wrong Password');
                return redirect()->to('/login');
            }
        }else{
            $session->setFlashdata('msg', 'Email not Found');
            return redirect()->to('/login');
        }
    }
    */
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
    

    private function hash_password($password){
        return password_hash($password, PASSWORD_BCRYPT);
    }
}