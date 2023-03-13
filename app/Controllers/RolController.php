<?php 
namespace App\Controllers;
use App\Models\RolModel;
use CodeIgniter\Controller;

class RolController extends Controller
{
    // show users list
    public function index(){
        $session = session();
        $data['data_context_admin'] = $session->get("userdata_admin");

        $rolModel = new RolModel();
        $data['roles'] = $rolModel->orderBy('id', 'DESC')->findAll();

        echo view('backend/header', $data);
        echo view('admin/roles/list_view', $data);
        echo view('backend/footer', $data);
    }
    
    public function create(){
        $session = session();
        $data['data_context_admin'] = $session->get("userdata_admin");

        echo view('backend/header', $data);
        echo view('admin/roles/add_view', $data);
        echo view('backend/footer', $data);
    }

    public function store() {
        
        $rolModel = new RolModel();

        $data = [
            'name' => $this->request->getVar('name')
        ];
        
        $rolModel->insert($data);

        $session = session();
        $data['data_context_admin'] = $session->get("userdata_admin");

        echo view('backend/header', $data);
        $this->response->redirect(site_url('admin/rol/list'));
        echo view('backend/footer', $data);
    }

    public function detail($id = null){
        $session = session();
        $data['data_context_admin'] = $session->get("userdata_admin");

        $rolModel = new RolModel();
        $data['rol_obj'] = $rolModel->where('id', $id)->first();

        echo view('backend/header', $data);
        echo view('admin/roles/edit_view', $data);
        echo view('backend/footer', $data);
    }

    public function update(){
        $rolModel  = new RolModel();

        $id     = $this->request->getVar('id');
        $name   = $this->request->getVar('name');  

        $data = [
            'id'    => $this->request->getVar('id'),
            'name'  => $this->request->getVar('name')
        ];

        $rolModel->update($id, $data);

        $session = session();
        $data['data_context_admin'] = $session->get("userdata_admin");

        echo view('backend/header', $data);
        $this->response->redirect(site_url('admin/rol/list'));
        echo view('backend/footer', $data);
    }

    public function delete($id = null){
        $rolModel = new RolModel();
        $data['rol'] = $rolModel->where('id', $id)->delete($id);

        $session = session();
        $data['data_context_admin'] = $session->get("userdata_admin");
        
        if($data['data_context_admin'] == null)
            return redirect()->to('/login');

        echo view('backend/header', $data);
        $this->response->redirect(site_url('admin/rol/list'));
        echo view('backend/footer', $data);
    }
}