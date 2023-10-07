<?php

namespace app\index\controller;

use app\common\controller\Frontend;
use think\Session;

class Cart extends Frontend
{
    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = 'default';

    public function index()
    {
        $cart = Session::get('cart') ?: [];
        $list = [];
        foreach ($cart as $id => $count) {
            $movie = \app\index\model\Movie::with('category')->find($id);
            $movie['count'] = $count;
            $list[] = $movie;
        }
        // return json($list);
        $this->view->assign('list', $list);
        $this->view->assign('title', '购物车');
        return $this->view->fetch();
    }

    public function delete()
    {
        $id = input('id');
        $cart = Session::get('cart') ?: [];
        unset($cart[$id]);
        Session::set('cart', $cart);
        Session::flash('message', '删除成功');
        $this->redirect('/index/cart');
    }
}
