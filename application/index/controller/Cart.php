<?php

namespace app\index\controller;

use app\common\controller\Frontend;
use think\Session;

class Cart extends Frontend
{
    protected $noNeedLogin = ['index', 'delete'];
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

    public function settle()
    {
        $cart = Session::get('cart') ?: [];

        $order = new \app\common\model\Order;
        $user = $this->auth->getUser();
        $order->user_id = $user->id;
        $order->save();

        foreach ($cart as $id => $count) {
            $movie = \app\index\model\Movie::find($id);
            $orderItem = new \app\common\model\OrderItem;
            $orderItem->order_id = $order->id;
            $orderItem->movie_id = $movie->id;
            $orderItem->count = $count;
            $orderItem->save();
        }

        Session::delete('cart');

        $this->redirect('/index/order');
    }
}
