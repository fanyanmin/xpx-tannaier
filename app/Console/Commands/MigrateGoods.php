<?php

namespace App\Console\Commands;

use App\Models\ShopCategory;
use App\Models\ShopGoods;
use App\Models\ShopProduct;
use App\Models\ShopSpecification;
use App\Models\ShopSpecItem;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class MigrateGoods extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:goods';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '迁移商品数据';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $filePath = 'storage/test.xlsx';
        Excel::load($filePath, function ($value) {

            foreach ($value->all()->toArray() as $key => $value) {

                $category = ShopCategory::updateOrCreate([
                    'name' => $value['category'] ?: '',
                    'keywords' => $value['category'] ?: '',
                    'front_desc' => $value['category'] ?: '',
                    'parent_id' => 0,
                    'sort_order' => 255,
                    'show_index' => 0,
                    'is_show' => 1,
                    'banner_url' => 'images/a5e0fdd9a7dccf454c46685b3a243fe3.jpg',
                    'icon_url' => 'images/615a6058f1517e33d1229b48daf2932a.jpg',
                    'img_url' => 'images/bb206738535aab02226b0f9139ff0446.jpg',
                    'wap_banner_url' => '',
                    'level' => 0,
                    'type' => 0,
                    'front_name' => $value['category'] ?: '',
                ]);
                $color = explode(' ', $value['color']);
                $size = explode(' ', $value['size']);
                $img = array_filter(explode(';', $value['picture']));
                foreach ($img as $k => &$v) {
                    $v = explode('|', $v)[1];
                }
                $firstImg = $img[0];
                $create   = ShopGoods::insertGetId([
                    'category_id'         => $category->id,
                    'goods_sn'            => $value['outer_id'] ?: '',
                    'goods_name'          => $value['title'],
                    'brand_id'            => 6,
                    'goods_number'        => $value['num'],
                    'keywords'            => $value['title'],
                    'goods_brief'         => $value['title'],
                    'goods_desc'          => $value['description'],
                    'is_on_sale'          => 1,
                    'sort_order'          => 255,
                    'is_delete'           => 0,
                    'attribute_category'  => 0,
                    'counter_price'       => $value['price'],
                    'extra_price'         => 0.00,
                    'freight_price'       => $value['freight_payer'],
                    'is_new'              => 1,
                    'goods_unit'          => '件',
                    'primary_pic_url'     => $firstImg, //'images/05e4accdefd8a436aa4f5155604f6db4.jpg',
                    'list_pic_url'        => json_encode($img),//'["images\/f45e9b9991b022a401132f7fb0a06ce8.jpg"]'
                    'retail_price'        => $value['price'],
                    'sell_volume'         => 0,
                    'primary_product_id'  => 0,
                    'unit_price'          => $value['price'],
                    'promotion_desc'      => $value['title'],
                    'promotion_tag'       => $value['title'],
                    'vip_exclusive_price' => 0.00,
                    'is_vip_exclusive'    => 0,
                    'is_limited'          => 0,
                    'is_hot'              => 0,
                    'created_at'          => date('Y-m-d H:i:s'),
                    'updated_at'          => date('Y-m-d H:i:s'),
                ]);

                $colorRuleCategory = ShopSpecification::updateOrCreate([
                    'name'       => '颜色',
                    'sort_order' => 255,
                ]);

                $sizeRuleCategory = ShopSpecification::updateOrCreate([
                    'name'       => '尺码',
                    'sort_order' => 255,
                ]);
                foreach ($color as $k => $v) {

                    $colorItem = ShopSpecItem::updateOrCreate([
                        'spec_id' => $colorRuleCategory->id,
                        'item'    => $v,
                    ]);
                    foreach ($size as $s => $z) {
                        $sizeItem = ShopSpecItem::updateOrCreate([
                            'spec_id' => $sizeRuleCategory->id,
                            'item'    => $z,
                        ]);

                        ShopProduct::create([
                            'goods_id'                  => $create,
                            'goods_specification_ids'   => $colorRuleCategory->id . '_' . $sizeRuleCategory->id,// $colorRuleCategory->id . '_' . $sizeRuleCategory->id
                            'goods_sn'                  => $value['outer_id'] ?: 'goods_sn',
                            'goods_number'              => $value['num'],
                            'retail_price'              => $value['price'],
                            'goods_specification_names' => $colorRuleCategory->name . '_' . $sizeRuleCategory->name,// $colorRuleCategory->name . '_' . $sizeRuleCategory->name
                            'goods_spec_item_ids'       => $colorItem->id . '_' . $sizeItem->id,// $colorItem->id . '_' . $sizeItem->id,
                            'goods_spec_item_name'      => $colorItem->name . '_' . $sizeItem->name,// $colorItem->name . '_' . $sizeItem->name,
                        ]);
                    }
                }

            }
        });
    }
}
