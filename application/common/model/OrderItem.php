<?php

namespace app\common\model;

use app\index\model\Movie;
use think\Model;
use traits\model\SoftDelete;

class OrderItem extends Model
{
    use SoftDelete;


    // 表名
    protected $name = 'order_item';

    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'integer';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    protected $deleteTime = 'deletetime';

    public function movie()
    {
        return $this->belongsTo(Movie::class, 'movie_id');
    }

    public function theOrder()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
