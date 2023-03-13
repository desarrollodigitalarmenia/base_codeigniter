<?php

namespace App\Controllers;
use App\Models\RegionModel;
use App\Models\CityModel;
use App\Models\CategoryModel;
use App\Models\BusinessModel;
use App\Models\AdsModel;

class Business extends BaseController
{
    public function index()
    {
        
    }

    public function list()
    {
        $db = \Config\Database::connect();

        $country = 1;
        $region = 24;
        $city = 2;
        $category = 1;
        $q = "";
        
        $builder = $db->table('business');
        $builder->select(' *,
        business.id as id,
        business.name as name,
        business.name_short as business_nameshort,
        category.id as category_id,
        category.name as category_name,
        category.name_short as category_name_short,
        region.id as region_id,
        region.name as region_name,
        region.name_short as region_name_short,
        city.id as city_id,
        city.name as city_name,
        city.name_short as city_name_short
        ');

        if($country!=0){
            $builder->where('business.country', $country);
        }
        
        if($region!=0){
            $builder->where('business.region', $region);
        }
        
        if($city!=0){
            $builder->where('business.city', $city);
        }
        
        if($category!=0){
            $builder->where('business.category', $category);
        }
        
        if($q!=""){
            $builder->like('business.name', $q);
        }
        
        $RegionModel        = new RegionModel();
        $data['regions']    = $RegionModel->orderBy('position', 'ASC')->findAll();

        $RegionModel        = new RegionModel();
        $data['region_name']= $RegionModel->orderBy('position', 'ASC')->where('id', $region)->find();

        $CityModel          = new CityModel();
        $data['cities']     = $CityModel->orderBy('position', 'ASC')->findAll();

        $CategoryModel      = new CategoryModel();
        $data['categories'] = $CategoryModel->orderBy('position', 'ASC')->where('category_father', 0)->findAll();

        $builder->join('category'   , 'category.id = business.category');
        $builder->join('region'     , 'region.id = business.region');
        $builder->join('city'       , 'city.id = business.city');
        $query = $builder->get();
        
        $data['business'] = $query->getResult();

        $session = session();
        $data['data_context'] = $session->get("userdata");
        
        $data['region_name'] = array(0 => array('name' => ""));

        if($data['region_name'] != null){
            $data['region_name'] = $data['region_name'][0];
        }
        
        echo view('frontend/header', $data);
        echo view('search', $data);
        echo view('frontend/footer');
    }
}
