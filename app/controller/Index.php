<?php
namespace app\controller;

use app\BaseController;
use think\facade\View;
use app\model\Article as Atc;

class Index extends BaseController
{
    public function index()
    {
    
        $list = Atc::where('status',1)->limit(6)->order('id desc')->select();

        return view('index',[
            "cate"=>$this->cateList(),
            "list"=>$list
        ]);
    }

    public function list(){
        return View::fetch();
    }

    public function article($id){
        return View::fetch();
    }
}
