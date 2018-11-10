<?php

namespace App\Http\Controllers;

use App\Model\Menu;
use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    /*
        -订单量统计[按日统计,按月统计,累计]（每日、每月、总计）
        - 菜品销量统计[按日统计,按月统计,累计]（每日、每月、总计）
     */
    public function orders()
    {
        $shop_id = Auth::user()->shop_id;
        //var_dump($shop_id);exit;
        //按日统计，最近一周，显示最近一周以每天显示
        //数组中的每一个结果都是 PHP  stdClass 对象
        $orders = DB::select("SELECT DATE_FORMAT(created_at,'%Y-%m-%d') as riqi,count(*) as count 
            FROM orders 
            WHERE shop_id = $shop_id and DATE_SUB(CURDATE(),INTERVAL 6 DAY) <= date(DATE_FORMAT(created_at,'%Y-%m-%d'))  
            GROUP BY riqi");

        //构建7天格式，防止有的数据没有，前台显示出错
        $result = [];
        for ($i=0;$i<7;++$i)
        {
            $result[date('Y-m-d',strtotime("-{$i} day"))] = 0;
        }

        foreach ($orders as $order)
        {
            $result[$order->riqi] = $order->count;
        }


        //按月统计,最近三个月，每月订单数
        $end_yue= date('Y-m-d H:i:s',time());
        $start_yue = date('Y-m-d 00:00:00',strtotime('-2 month'));
        $yue_orders = DB::select("select DATE_FORMAT(created_at,'%Y-%m') as yuefen,count(*) as jishu 
            from orders
            where shop_id = ? and created_at >= ? and created_at <= ? 
            GROUP BY yuefen",[$shop_id,$start_yue,$end_yue]);

        //var_dump($yue_orders);exit;
        $yue_or = [];
        for ($i=0;$i<3;++$i)
        {
            $yue_or[date('Y-m',strtotime("-{$i} month"))] = 0;
        }

        foreach ($yue_orders as $yue_order)
        {
            $yue_or[$yue_order->yuefen] = $yue_order->jishu;
        }


        return view('index.list',compact('result','yue_or'));
    }

    public function menus()
    {

        //统计每个商家 7 天内 每天 每个菜 的销量
        $shop_id = Auth::user()->shop_id;
        $start_day = date('Y-m-d 00:00:00',strtotime('-6 day'));
        $end_day = date('Y-m-d H:i:s',time());
        //DB::enableQueryLog();
        $cai_day_amoutn = DB::select("select goods_id,order_details.goods_name as menu_name,date(orders.created_at) as riqi,SUM(order_details.amount)as shuliang 
            from order_details
            JOIN orders on order_details.order_id = orders.id
            WHERE orders.created_at >= ? and orders.created_at <= ? and shop_id = ?
            GROUP  BY goods_id,goods_name,orders.created_at",[$start_day,$end_day,$shop_id]);
        //var_dump(DB::getQueryLog());
        //构造7天格式，防止那一天不存在订单而造成前端显示错误
        $result = [];
        //获取菜品ID 与 名称
        $menus = DB::table('menus')->where('shop_id',$shop_id)->select('id','goods_name')->get();
        //$menus = Menu::where('shop_id',$shop_id)->get();
        //集合方法 mapWithKeys 方法对集合进行迭代并传递每个值到给定回调，该回调会返回包含键值对的关联数组：
        /*$yiwei = $menus->mapWithKeys(function ($item) {
            return [$item['id']=>$item['goods_id']];
        });*/
        //var_dump($menus);exit;
        $keyed = $menus->mapWithKeys(function ($item) {
            return [$item->id =>$item->goods_name];
        });

        /*$keyeds = $menus->mapWithKeys(function ($item){
           return [$item->id => 0];
        });*/
        //all 方法简单返回集合表示的底层数组：
        $menus = $keyed->all();
        $week = [];
        for ($i=0;$i<7;++$i)
        {
            $week[] = date('Y-m-d',strtotime("-{$i} day"));
        }
        foreach ($menus as $id=>$menu)
        {
            foreach ($week as $day)
            {
                $result[$id][$day] = 0;
            }
        }

        foreach ($cai_day_amoutn as $cai)
        {
            $result[$cai->goods_id][$cai->riqi] = $cai->shuliang;
        }
        $service = [];
        foreach ($result as $id=>$r)
        {
            $ss = [
                'name'=>$menus[$id],
                'type'=>'line',
                'stack'=> '销量',
                'data'=>array_values($r)
            ];
            $service[] = $ss;
        }
        /* [
              {
                  name:'回锅肉',
                  type:'line',
                  stack: '总量',
                  data:[120, 132, 101, 134, 90, 230, 210]
              },
              {
                  name:'联盟广告',
                  type:'line',
                  stack: '总量',
                  data:[220, 182, 191, 234, 290, 330, 310]
              },
              {
                  name:'视频广告',
                  type:'line',
                  stack: '总量',
                  data:[150, 232, 201, 154, 190, 330, 410]
              },
              {
                  name:'直接访问',
                  type:'line',
                  stack: '总量',
                  data:[320, 332, 301, 334, 390, 330, 320]
              },
              {
                  name:'搜索引擎',
                  type:'line',
                  stack: '总量',
                  data:[820, 932, 901, 934, 1290, 1330, 1320]
              }
          ]*/
        //var_dump($result);exit;
        return view('index.menus',compact('result','menus','week','service'));

    }

    public function menusYue()
    {
        $shop_id = Auth::user()->shop_id;
        $start_month = date('Y-m-d 00:00:00',strtotime('-2 month'));
        $end_month = date('Y-m-d H:i:s',time());
        //DB::enableQueryLog();
        $cai_month_amount = DB::select("select goods_id,date(orders.created_at) as riqi,sum(amount) as num,goods_name as menus_name 
            from order_details
            JOIN orders on order_details.order_id = orders.id
            WHERE  orders.created_at >= ? and orders.created_at <= ? and shop_id = ?
            GROUP BY goods_id,goods_name,orders.created_at",[$start_month,$end_month,$shop_id]);
        //var_dump(DB::getQueryLog());
        var_dump($cai_month_amount);exit;
        return view('index.menus',compact());
    }
}
