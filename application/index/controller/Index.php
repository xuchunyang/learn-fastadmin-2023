<?php

namespace app\index\controller;

use app\common\controller\Frontend;

class Index extends Frontend
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = 'default';

    public function index()
    {
        $this->view->assign('title', __('Home'));
        return $this->view->fetch();
    }

}
