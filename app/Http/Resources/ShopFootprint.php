<?php

namespace App\Http\Resources;

use App\Models\ShopCategory as ShopCategoryDB;
use Illuminate\Http\Resources\Json\Resource;

class ShopFootprint extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        if (strpos($this->shop_goods->primary_pic_url, '/bao/uploaded/', true)) {

            $imgSrc = $this->shop_goods->primary_pic_url;
        } else {
            $imgSrc = config('filesystems.disks.oss.url').'/'.$this->shop_goods->primary_pic_url;
        }
        return [
            "id"=>$this->id,
            "goods_id"=> $this->shop_goods->id,
            "goods_name"=> $this->shop_goods->goods_name,
            "primary_pic_url"=> $imgSrc,
            "goods_brief"=> $this->shop_goods->goods_brief,
            "retail_price"=> $this->shop_goods->retail_price,
            "add_time"=> $this->add_time,
        ];
    }

}
