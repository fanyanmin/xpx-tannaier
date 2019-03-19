<?php

namespace App\Http\Resources;

use App\Models\ShopOrder as ShopOrderDB;
use App\Models\ShopProduct;
use Illuminate\Http\Resources\Json\Resource;

class ShopOrderGoods extends Resource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $product_goods_spec_item_names = '';
        if (!empty($this->goods_specifition_name_value)) {

            $shopProduct = ShopProduct::where([
                'goods_spec_item_names' => $this->goods_specifition_name_value
            ])->select('goods_specification_names')->first();
            if ($shopProduct != null) {

                $specTitle = explode('_', $shopProduct->goods_specification_names);
                $specValue = explode('_', $this->goods_specifition_name_value);
                if (!empty($specTitle)) {
                    $product_goods_spec_item_names .= '选择规格：';
                    foreach ($specTitle as $key => $value) {
                        $product_goods_spec_item_names .= $value . ':' . ($specValue[$key] ?? '') . ' ';
                    }
                }
            }
        }
        return [
            "goods_name"                   => $this->goods_name,
            "number"                       => $this->number,
            "list_pic_url"                 => (strpos($this->list_pic_url,
                    'http') === false) ? config('filesystems.disks.oss.url') . '/' . $this->list_pic_url : $this->list_pic_url,
            "actual_price"                 => $this->actual_price,
            "retail_price"                 => $this->retail_price,
//            'goods_specifition_name_value' => $this->goods_specifition_name_value,
            'goods_specifition_name_value' => $product_goods_spec_item_names,
        ];
    }

}
