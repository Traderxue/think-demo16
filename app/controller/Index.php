<?php
namespace app\controller;

use app\BaseController;
use think\facade\View;

class Index extends BaseController
{
    public function index()
    {
        return View::fetch();
    }

    public function list(){
        return View::fetch();
    }

    public function article(){
        return View::fetch();
    }
}
