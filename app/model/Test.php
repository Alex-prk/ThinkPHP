<?php
//设置命名空间
namespace app\model;
//引用方法(必须先继承模型方可使用功能)
use think\Model;

class Test extends Model{
    //模型设置 成员属性
    //使用模型返回的数据集会默认添加该条数据的id
    //这个id是默认的,即使第一主键是uid,添加的也是id
    //使用$pk可以修改此默认值
    //必须设置此变量,否则可能select()会报错
    protected $pk = 'id';

    //切换表(必须用表的全名,设置了前缀也不行)
    // protected $table = 'phptp_user';

    //提前设置数据类型
    // protected $schema = [
    //     'oid' => 'int',
    //     'ooid' => 'string',
    //     'uid' => 'int',
    //     'price' => 'int',
    // ];

    //转换类型(用的很少)
    // protected $type = [
    //     'oid' => 'string'
    // ];

    //对于不需要的字段可以屏蔽,就不再查询出来了
    //也就替代了field的功能
    protected $disuse = [
        'settle',
        'cancel_time',
        'pay_time',
        'pay_type',
    ];

    public function getOrder(){
        //在model里不适用Db::
        echo 'test表:';
        echo '<br>';
        $order = Test::select()->toArray();
        // print_r($order);

        //model一般是把值返回给controller
        return $order;
    }
    
    public function AddOrder($data){
        if(empty($data)){
            return null;
        }
        //注意,model里的添加方法是create,不是insert
        $order = Test::create($data)->toArray();
        //返回插入的信息
        return $order;
    }

    //获取器 get + 字段名 + Attr
    //获取器会自动在返回数据的时候,找到这个字段
    //把这个字段的值进行处理
    public function getStatusAttr($v){
        // if($v == 1){
        //     return '在职';
        // }else if($v == 99){
        //     return '离职';
        // }

        //也可以直接使用对象或数组的方式修改status
        $s = array(
            1 => '在职',
            99 => '离职'
        );
        return $s[$v];

        // $s = [
        //     1 => '在职',
        //     99 => '离职'
        // ];
        // return $s[$v];
    }
}