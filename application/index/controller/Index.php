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

        foreach ($data_one as $key=>$value){
            $value->icon = 0;
            foreach ($data_two as $k=>$v){
                if($v->pid == $value->id){
                    $value->icon = 1;
                    continue;
                }
            }
        }
        foreach ($data_two as $a=>$b){
            $b->icon = 0;
            foreach ($data_three as $k=>$v){
                if($b->id == $v->pid){
                    $b->icon = 1;
                    continue;
                }
            }

        }
        foreach ($data_one as $k=>&$v)
        {
            $v['two']=$data_two;
            $v['three']=$data_three;
        }
        $this->assign('data_one',$data_one);
        return $this->view->fetch();
    }

    /**
     * 返回搜索的title及第一个内容
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function select(){
        if ($this->request->isPost()){
            $key = input('post.key');
            $items = Article::where('content','like',"%".$key."%")->select();
            $items[0]['content'] = str_replace($key,"<apan style='background-color: #d6e9c6'>".$key."</apan>",$items[0]['content']);
            return $items;
        }
    }

    /**
     * 返回搜索后的点击内容
     * @return array|false|\PDOStatement|string|\think\Model
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public  function select1(){
        if ($this->request->isPost()){
            $key = input('post.key');
            $id = input('post.id');
            $item = Article::where('id',$id)->find();
            $item['content'] = str_replace($key,"<apan style='background-color: #d6e9c6'>".$key."</apan>",$item['content']);
            return $item;
        }
    }

//    点击导航栏跳转
    public function content(){
        if($this->request->isPost()){
            $id = input('post.id');
            $data['id'] = $id;
            $data['title_previous'] = Article::where('id',($id-1))->value('title');
            $data['title_next'] =  Article::where('id',($id+1))->value('title');
            $data['content'] = Article::where('id',$id)->value('content');
            return $data ;
        }
    }

//    上一篇跳转
    public function previous(){
        if($this->request->isPost()){
            $id = input('post.id');
            $data['id'] = $id-1;
            $data['title_previous'] = Article::where('id',($id-2))->value('title');
            $data['title_next'] =  Article::where('id',$id)->value('title');
            $data['content'] = Article::where('id',($id-1))->value('content');
            return $data ;
        }
    }

//    下一篇跳转
    public function next(){
        if($this->request->isPost()){
            $id = input('post.id');
            $data['id'] = $id+1;
            $data['title_previous'] = Article::where('id',$id)->value('title');
            $data['title_next'] =  Article::where('id',($id+2))->value('title');
            $data['content'] = Article::where('id',($id+1))->value('content');
            return $data ;
        }
    }
}
