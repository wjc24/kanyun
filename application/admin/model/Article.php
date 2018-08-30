<?php

namespace app\admin\model;

use think\Model;

class Article extends Model
{
    // 表名
    protected $table = 'article';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    
    // 追加属性
    protected $append = [
        'level_text',
        'status_text'
    ];
    

    
    public function getLevelList()
    {
        return ['one' => __('One'),'two' => __('Two'),'three' => __('Three')];
    }     

    public function getStatusList()
    {
        return ['normal' => __('Normal'),'hidden' => __('Hidden')];
    }     


    public function getLevelTextAttr($value, $data)
    {        
        $value = $value ? $value : (isset($data['level']) ? $data['level'] : '');
        $list = $this->getLevelList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getStatusTextAttr($value, $data)
    {        
        $value = $value ? $value : (isset($data['status']) ? $data['status'] : '');
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }




}
