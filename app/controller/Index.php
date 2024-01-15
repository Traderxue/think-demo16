<?php
namespace app\controller;

use app\BaseController;
use think\facade\View;
use app\model\Article as Atc;
use app\model\Category as Cate;

class Index extends BaseController
{
    //首页控制器
    public function index()
    {
    
        $list = Atc::where('status',1)->limit(6)->order('id desc')->select();

        return view('index',[
            "cate"=>$this->cateList(),
            "list"=>$list
        ]);
    }

    //列表页控制器
    public function list($links){
        $cate = Cate::where('links',$links)->find();

        $list = Atc::where(["categroy_id"=>$cate['id'],'status'=>1])->order('id desc')->paginate(12);

        return view('list',[
            'cate'=>$this->cateList(),
            "list"=>$list
        ]);
    }

    //内容页控制器
    public function article($id){
        $atc = Atc::where("id",$id)->find();    
        return view('artice-'.$id,[
            "cate"=>$this->cateList(),
            "atc"=>$atc
        ]);
    }
}
