<?php

namespace app\index\controller;

use app\common\controller\Frontend;
use app\common\library\Token;
use app\model\Article;

class Index extends Frontend
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = '';

    public function _initialize()
    {
        parent::_initialize();
    }

    public function index()
    {
        $data_one = Article::where('level','one')->select();
        $data_two = Article::where('level','two')->select();
        $data_three =Article::where('level','three')->select();

        foreach ($data_one as $k=>&$v)
        {
            $v['two']=$data_two;
            $v['three']=$data_three;
        }
        $this->assign('data_one',$data_one);
        return $this->view->fetch();
    }

    public function content(){
        if($this->request->isPost()){
            $id = input('post.id');
            return Article::where('id',$id)->value('content');
        }
    }

}
