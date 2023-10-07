<?php

namespace app\index\controller;

use app\common\controller\Frontend;

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

}
