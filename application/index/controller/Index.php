<?php

namespace app\index\controller;

use app\common\controller\Frontend;
use app\index\model\Movie;

class Index extends Frontend
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = 'default';

    public function index()
    {
        $movies = Movie::with('category')->select();
        // return json($movies);
        $this->view->assign('movies', $movies);
        $this->view->assign('title', __('Home'));
        return $this->view->fetch();
    }

}
