<?php

namespace app\index\controller;

use app\common\controller\Frontend;
use think\Session;

class Order extends Frontend
{
    protected $noNeedLogin = [];
    protected $noNeedRight = '*';
    protected $layout = 'default';

    public function index()
    {
        $user = $this->auth->getUser();
        $list = \app\common\model\Order::with(['user', 'orderItems.movie'])->where('user_id', $user['id'])->select();
        // return json($list);
        $this->view->assign('list', $list);
        $this->view->assign('title', '订单列表');
        return $this->view->fetch();
    }
}
