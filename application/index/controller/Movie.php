<?php

namespace app\index\controller;

use app\common\controller\Frontend;
use think\Session;

class Movie extends Frontend
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = 'default';

    public function detail()
    {
        $movie = \app\index\model\Movie::with('category')->find(input('id'));
        // return json($movie);
        $this->view->assign('movie', $movie);
        $this->view->assign('title', $movie['title']);
        return $this->view->fetch();
    }

    public function buy()
    {
        $id = input('movie_id');
        $count = input('count');

        $cart = Session::get('cart') ?: [];

        $cart[$id] = $count;

        Session::set('cart', $cart);

        Session::flash('message', '添加成功');

        $this->redirect('/index/cart');
    }
}
