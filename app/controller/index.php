<?php
namespace app\controller;

use think\facade\Db;

class Index
{
    public function one()
    {
        echo "我是第一个页面";
    }
    public function two()
    {
        $arr = [
            [
                'id' => 1,
                'name' => '小赵'
            ],
            [
                'id' => 2,
                'name' => '小李'
            ]
        ];
        print_r($arr);
        echo'<br>';
        var_dump($arr);
    }
    public function three()
    {
        $arr = Db::table('table1')->find(1);
        print_r($arr);
    }
    public function four()
    {
        echo '输出小李信息:';

        echo '<br>';

        $arr = Db::table('table1')->where('name','小李')->find();
        print_r($arr);

        echo '<br>';

        echo '输出id大于1的信息:';

        echo '<br>';

        $arr1 = Db::table('table1')->where('id','>','0')->select()->toArray();
        print_r($arr1);

        echo '<br>';

        echo "输出小李信息:";

        echo '<br>';

        $arr1 = Db::table('table1')->where('id','>','2')->whereOr('name','小李')->select()->toArray();
        print_r($arr1);
    }
    public function five()
    {
        echo '筛选出字段name:';

        echo '<br>';

        $arr = Db::table('table1')->field('name')->where('id','>','1')->select()->toArray();
        print_r($arr);

        echo '<br>';

        echo '修改字段name:';

        echo '<br>';

        $arr1 = Db::table('table1')->field('name as nickname')->where('id','>','1')->select()->toArray();
        print_r($arr1);
        echo '<br>';

        echo '修改字段name:';

        echo '<br>';

        echo '返回唯一字段:';

        echo '<br>';

        $arr2 = Db::table('table1')->where('id','>','0')->column('name');
        print_r($arr2);
        echo '<br>';

        echo '返回唯一字段值:';

        echo '<br>';

        $arr3 = Db::table('table1')->where('id','=','1')->value('name');
        print_r($arr3);
    }
    public function six()
    {
        $data = [
            'id' => 3,
            'name' => '小张'
        ];
        $add = Db::table('table1')->insert($data);
        print_r($add);
    }
    public function seven()
    {
        $data = [
            'id' => 4,
            'name' => '小刘'
        ];
        $add = Db::table('table1')->insertGetId($data);
        print_r($add);

        if(empty($add)){
            echo '添加失败';
        }else{
            echo '添加成功';
        }
    }
    public function eight()
    {
        $data = [
            'id' => 3,
            'name' => '小周'
        ];
        $updata = Db::table('table1')->where('id',3)->update($data);
        print_r($updata);
    }
    public function nine()
    {
        $delete = Db::table('table1')->where('id',4)->delete();
        print_r($delete);
    }
    public function ten()
    {
        $delete = Db::table('table1')->where('id',3)->useSoftDelete('status',1)->delete();
        print_r($delete);
    }
    public function eleven()
    {
        $user = Db::table('table1')->select()->toArray();
        foreach($user as $user_v){
            Db::table('table1')->where('id',$user_v['id'])->update([
                'copy' => $user_v['name'],
            ]);
        }
        print_r($user);
    }
    public function twelve()
    {
        $user = Db::table('table1')->select();
        $user->shift();
        print_r($user->toArray());
    }
    public function thirteen()
    {
        $user = Db::table('table1')->where('id',100)->select()->toArray();
        var_dump(empty($user));
        //bool(true)
        
        $user = Db::table('table1')->where('id',100)->select();
        var_dump(empty($user));
        //bool(false)

        $user = Db::table('table1')->where('id',100)->select();
        var_dump($user->isEmpty());
        //bool(true)
    }
    public function fourteen()
    {
        $user = Db::table('table1')->where('name','like','张%')->select();
        $user = Db::table('table1')->where('name','like','%琳%')->select();
    }

    public function fifteen()
    {
        // asc表示正序 desc表示倒序
        $user = Db::table('table1')->order('id desc, sort asc')->select()->toArray();
        print_r($user);
    }

    public function sixteen()
    {
        // field参数为数组时,对输出的数据集进行选择,以及修改键名
        $user = Db::table('table1')->field([
            'id',
            'name'=>'nickname'
        ])->select()->toArray();
        print_r($user);
    }

    public function seventeen()
    {
        // 使用 limit函数 1个参数决定每页获取多少条
        // 使用 limit函数 2个参数决定从第几条获取到第几条

        // 获取第1到第6条
        $user = Db::table('table1')->limit(0,5)->select()->toArray();
        print_r($user);

        // 获取第7到第12条
        $user = Db::table('table1')->limit(6,11)->select()->toArray();
        print_r($user);

        // page函数的第一个参数表示当前页数,第二个参数表示获取多少条

        //第一页获取五条
        $user = Db::table('table1')->page(0,5)->select()->toArray();
        print_r($user);
    }

    public function eighteen()
    {
        // page函数
    }
}

