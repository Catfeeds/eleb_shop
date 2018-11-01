<?php

namespace App\Http\Controllers;

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
        //按日统计，最近一周，显示最近一周以每天显示
        $orders = DB::select("SELECT DATE_FORMAT(created_at,'%Y-%m-%d') as riqi,count(*) as count 
            FROM orders 
            WHERE shop_id = $shop_id and DATE_SUB(CURDATE(),INTERVAL 7 DAY) <= date(DATE_FORMAT(created_at,'%Y-%m-%d'))  
            GROUP BY riqi");
        $arr = [];
        foreach ($orders as $order)
        {
            $arr[] = $order->riqi;
        }
        //按月统计,最近三个月，每月订单数
        $end_yue= date('Y-m-d H:i:s',time());
        $start_yue = date('Y-m-d 00:00:00',strtotime('-2 month'));
        $yue_orders = DB::select("select DATE_FORMAT(created_at,'%Y-%m') as yuefen,count(*) as jishu 
            from orders
            where shop_id = ? and created_at >= ? and created_at <= ? 
            GROUP BY yuefen",[$shop_id,$start_yue,$end_yue]);
        return view('index.list',compact('arr'));
    }

    public function menus()
    {

        //统计每个商家 7 天内 每天 每个菜 的销量
        $shop_id = Auth::user()->shop_id;
        $start_day = date('Y-m-d 00:00:00',strtotime('-7 day'));
        $end_day = date('Y-m-d H:i:s',time());
        DB::enableQueryLog();
        $cai_day_amoutn = DB::select("select goods_id,order_details.goods_name as menu_name,date(orders.created_at) as riqi,SUM(order_details.amount)as shuliang 
            from order_details
            JOIN orders on order_details.order_id = orders.id
            WHERE orders.created_at >= ? and orders.created_at <= ? and shop_id = ?
            GROUP  BY goods_id,goods_name,orders.created_at",[$start_day,$end_day,$shop_id]);
        //var_dump(DB::getQueryLog());


        $start_month = date('Y-m-d 00:00:00',strtotime('-2 month'));
        $end_month = date('Y-m-d H:i:s',time());
        DB::enableQueryLog();
        $cai_month_amount = DB::select("select goods_id,date(orders.created_at) as riqi,sum(amount) as num,goods_name as menus_name 
            from order_details
            JOIN orders on order_details.order_id = orders.id
            WHERE  orders.created_at >= ? and orders.created_at <= ? and shop_id = ?
            GROUP BY goods_id,goods_name,orders.created_at",[$start_month,$end_month,$shop_id]);
        var_dump(DB::getQueryLog());
        var_dump($cai_month_amount);

    }
}
