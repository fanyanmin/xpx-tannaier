<?php
/**
 * User: sqc
 * Date: 18-6-28
 * Time: 下午5:12
 */

namespace App\Logic;

use App\Models\ShopGoods;
use App\Models\ShopProduct;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Models\ShopOrder;
use App\Http\Resources\ShopOrder as ShopOrderResource;

class OrderLogic
{

    public function getStatusDisplayMap()
    {

        return [
            '0'                            => '全部',
            ShopOrder::STATUS_WAIT_PAY     => ShopOrder::STATUS_WAIT_PAY_STRING,
            ShopOrder::STATUS_ALREADY_PAID => ShopOrder::STATUS_ALREADY_PAID_STRING,
            ShopOrder::STATUS_COMPLETED    => ShopOrder::STATUS_COMPLETED_STRING,
        ];
    }

    public function getOrderList($where)
    {

        $list = ShopOrder::getOrderAndOrderGoodsList($where);
        return ShopOrderResource::collection($list);
    }

    public function getOrderDetail($where)
    {

        $info = ShopOrder::with('orderGoods')->where($where)->first();
        return new ShopOrderResource($info);
    }

    public function orderCancel($where)
    {

        return ShopOrder::where($where)->update(['order_status' => ShopOrder::STATUS_INVALID]);
    }

    public function completeOrder($orderID)
    {
    }

    /**
     * 回滚库存
     *
     * @param $goodsId
     * @param $num
     * @return bool
     * @author 张镇炜 <772979140@qq.com>
     */
    public function rollbackNumber($goodsId, $num)
    {

        $goods = ShopGoods::lockForUpdate()->find($goodsId);
        if (empty($goods)) {
            return false;
        }
        $sellVolume          = $goods->sell_volume - $num;
        $goods->sell_volume  = ($sellVolume < 0) ? 0 : $sellVolume;
        $goods->goods_number = $goods->goods_number + $num;
        return $goods->save();
    }

    /**
     * 回滚规格
     *
     * @param $productId
     * @param $num
     * @return bool
     * @author 张镇炜 <772979140@qq.com>
     */
    public function rollbackProductNumber($productId, $num)
    {

        $product = ShopProduct::lockForUpdate()->find($productId);
        if (empty($product)) {
            return false;
        }
        $product->goods_number = $product->goods_number + $num;
        return $product->save();
    }

    /**
     * 批量取消订单
     *
     * @return bool
     * @author 张镇炜 <772979140@qq.com>
     */
    public function batchCancelOrder()
    {

        $timeoutOrder = ShopOrder::where([
            ['add_time', '<', date('Y-m-d H:i:s', strtotime("-1 hour"))],
            'order_status' => ShopOrder::STATUS_WAIT_PAY
        ])->limit(10)->get();
        if ($timeoutOrder->isNotEmpty()) {
            $timeoutOrder->each(function ($order) {

                // TODO 此处可能需要加锁处理
                $this->rollbackOnlyOrder($order);
            });
        }
        return true;
    }

    /**
     * 处理单个订单状态和数量回滚
     *
     * @param      $order
     * @param bool $isId
     * @return bool
     * @author 张镇炜 <772979140@qq.com>
     */
    public function rollbackOnlyOrder($order, $isId = false)
    {

        // 如果传入是id，则查询
        if ($isId && is_int($order)) {

            $order = ShopOrder::find($order);
        }
        if ($order->orderGoods->isNotEmpty()) {
            app('db')->beginTransaction();
            // 订单状态修改
            $cancelOrder = $this->orderCancel([
                'uid' => $order->uid,
                'id'  => $order->id,
            ]);
            if ($cancelOrder) {
                $flag = true;
                $order->orderGoods->each(function ($orderGoods) use (&$flag) {

                    $orderGoodsRollback   = $this->rollbackNumber($orderGoods->goods_id, $orderGoods->number);
                    $orderProductRollback = $this->rollbackProductNumber($orderGoods->product_id, $orderGoods->number);
                    if (!$orderGoodsRollback || !$orderProductRollback) {
                        $flag = false;
                    }
                });
                if ($flag) {
                    app('db')->commit();
                    return true;
                }
            }
            app('db')->rollBack();
        }
        return false;
    }


}