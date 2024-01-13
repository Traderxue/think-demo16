<?php
namespace app\controller;

use app\BaseController;
use think\Request;
use app\model\User as UserModel;
use app\util\Res;
use think\facade\View;

class User extends BaseController
{
    private $result;

    function __construct(\think\App $app)
    {
        $this->result = new Res();
    }

    function index()
    {
        return View::fetch();
    }

    function register(Request $request)
    {
        $post = $request->post();
        $user = new UserModel();

        $u = $user->getByUsername($post["username"]);
        if ($u) {
            return $this->result->error("用户已存在");
        }

        $res = $user->save([
            "username" => $post["username"],
            "password" => password_hash($post["password"], PASSWORD_DEFAULT),
            "add_time" => date("Y-m-d H:i:s"),
            "ip" => $request->ip()
        ]);

        if ($res) {
            return $this->result->success("注册成功", $res);
        }
        return $this->result->error("注册失败");
    }

    function login(Request $request)
    {
        $post = $request->post();

        $user = new UserModel();

        $u = $user->getByUsername($post["username"]);

        if (!$u) {
            return $this->result->error("用户不存在");
        }
        if (password_verify($post["password"], $u->password)) {
            return $this->result->success("登录成功", $u);
        }
        return $this->result->error("登录失败");
    }

    function page(Request $request)
    {
        $page = $request->param("page");
        $pageSize = $request->param("pageSize");
        $keyword = $request->param("kwyword");

        $list = UserModel::where("user", "like", "%{$keyword}%")->paginate([
            "page" => $page,
            "pageSize" => $pageSize
        ]);

        return $this->result->success("获取数据成功", $list);
    }

    function getById($id)
    {
        $user = UserModel::where("id", $id)->find();
        return $this->result->success("获取数据成功", $user);
    }

    function deleteById($id)
    {
        $res = UserModel::where("id", $id)->delete();

        if ($res) {
            return $this->result->success("删除数据成功", $res);
        }
        return $this->result->error("删除数据失败");
    }
}


