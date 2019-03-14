<?php

use Illuminate\Database\Seeder;

class ShopOrderGoodsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('shop_order_goods')->delete();
        
        \DB::table('shop_order_goods')->insert(array (
            0 => 
            array (
                'id' => 4,
                'order_id' => 6,
                'goods_id' => 1,
                'goods_name' => '打算范德萨',
                'number' => 2,
                'market_price' => '12.00',
                'retail_price' => '213.00',
                'goods_specifition_name_value' => NULL,
                'is_real' => 1,
                'list_pic_url' => 'images/c82d319abd7a28d87f43b7af149750f3.png',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 5,
                'order_id' => 6,
                'goods_id' => 2,
                'goods_name' => '测试',
                'number' => 1,
                'market_price' => '1.00',
                'retail_price' => '11.00',
                'goods_specifition_name_value' => NULL,
                'is_real' => 1,
                'list_pic_url' => 'images/9d15c8f5dd600fe186f51ad1d51e095f.jpg',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 6,
                'order_id' => 6,
                'goods_id' => 3,
                'goods_name' => '越南进口红心火龙果 3个装 大果',
                'number' => 1,
                'market_price' => '44.00',
                'retail_price' => '44.00',
                'goods_specifition_name_value' => NULL,
                'is_real' => 1,
                'list_pic_url' => 'images/a204d50e68dea8f2797b0ea29dc0bc2d.jpg',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 7,
                'order_id' => 7,
                'goods_id' => 1,
                'goods_name' => '打算范德萨',
                'number' => 2,
                'market_price' => '12.00',
                'retail_price' => '213.00',
                'goods_specifition_name_value' => NULL,
                'is_real' => 1,
                'list_pic_url' => 'images/c82d319abd7a28d87f43b7af149750f3.png',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 8,
                'order_id' => 7,
                'goods_id' => 2,
                'goods_name' => '测试',
                'number' => 1,
                'market_price' => '1.00',
                'retail_price' => '11.00',
                'goods_specifition_name_value' => NULL,
                'is_real' => 1,
                'list_pic_url' => 'images/9d15c8f5dd600fe186f51ad1d51e095f.jpg',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 9,
                'order_id' => 7,
                'goods_id' => 3,
                'goods_name' => '越南进口红心火龙果 3个装 大果',
                'number' => 1,
                'market_price' => '44.00',
                'retail_price' => '44.00',
                'goods_specifition_name_value' => NULL,
                'is_real' => 1,
                'list_pic_url' => 'images/a204d50e68dea8f2797b0ea29dc0bc2d.jpg',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 10,
                'order_id' => 8,
                'goods_id' => 1,
                'goods_name' => '打算范德萨',
                'number' => 2,
                'market_price' => '12.00',
                'retail_price' => '213.00',
                'goods_specifition_name_value' => NULL,
                'is_real' => 1,
                'list_pic_url' => 'images/c82d319abd7a28d87f43b7af149750f3.png',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 11,
                'order_id' => 8,
                'goods_id' => 2,
                'goods_name' => '测试',
                'number' => 1,
                'market_price' => '1.00',
                'retail_price' => '11.00',
                'goods_specifition_name_value' => NULL,
                'is_real' => 1,
                'list_pic_url' => 'images/9d15c8f5dd600fe186f51ad1d51e095f.jpg',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 12,
                'order_id' => 8,
                'goods_id' => 3,
                'goods_name' => '越南进口红心火龙果 3个装 大果',
                'number' => 1,
                'market_price' => '44.00',
                'retail_price' => '44.00',
                'goods_specifition_name_value' => NULL,
                'is_real' => 1,
                'list_pic_url' => 'images/a204d50e68dea8f2797b0ea29dc0bc2d.jpg',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 13,
                'order_id' => 9,
                'goods_id' => 1,
                'goods_name' => '打算范德萨',
                'number' => 2,
                'market_price' => '12.00',
                'retail_price' => '213.00',
                'goods_specifition_name_value' => NULL,
                'is_real' => 1,
                'list_pic_url' => 'images/c82d319abd7a28d87f43b7af149750f3.png',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 14,
                'order_id' => 9,
                'goods_id' => 2,
                'goods_name' => '测试',
                'number' => 1,
                'market_price' => '1.00',
                'retail_price' => '11.00',
                'goods_specifition_name_value' => NULL,
                'is_real' => 1,
                'list_pic_url' => 'images/9d15c8f5dd600fe186f51ad1d51e095f.jpg',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 15,
                'order_id' => 9,
                'goods_id' => 3,
                'goods_name' => '越南进口红心火龙果 3个装 大果',
                'number' => 1,
                'market_price' => '44.00',
                'retail_price' => '44.00',
                'goods_specifition_name_value' => NULL,
                'is_real' => 1,
                'list_pic_url' => 'images/a204d50e68dea8f2797b0ea29dc0bc2d.jpg',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 16,
                'order_id' => 21,
                'goods_id' => 1,
                'goods_name' => '打算范德萨',
                'number' => 2,
                'market_price' => '12.00',
                'retail_price' => '213.00',
                'goods_specifition_name_value' => NULL,
                'is_real' => 1,
                'list_pic_url' => 'images/c82d319abd7a28d87f43b7af149750f3.png',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 17,
                'order_id' => 21,
                'goods_id' => 2,
                'goods_name' => '测试',
                'number' => 1,
                'market_price' => '1.00',
                'retail_price' => '11.00',
                'goods_specifition_name_value' => NULL,
                'is_real' => 1,
                'list_pic_url' => 'images/9d15c8f5dd600fe186f51ad1d51e095f.jpg',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 18,
                'order_id' => 21,
                'goods_id' => 3,
                'goods_name' => '越南进口红心火龙果 3个装 大果',
                'number' => 1,
                'market_price' => '44.00',
                'retail_price' => '44.00',
                'goods_specifition_name_value' => NULL,
                'is_real' => 1,
                'list_pic_url' => 'images/a204d50e68dea8f2797b0ea29dc0bc2d.jpg',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 19,
                'order_id' => 22,
                'goods_id' => 1,
                'goods_name' => '打算范德萨',
                'number' => 2,
                'market_price' => '12.00',
                'retail_price' => '213.00',
                'goods_specifition_name_value' => NULL,
                'is_real' => 1,
                'list_pic_url' => 'images/c82d319abd7a28d87f43b7af149750f3.png',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id' => 20,
                'order_id' => 22,
                'goods_id' => 2,
                'goods_name' => '测试',
                'number' => 1,
                'market_price' => '1.00',
                'retail_price' => '11.00',
                'goods_specifition_name_value' => NULL,
                'is_real' => 1,
                'list_pic_url' => 'images/9d15c8f5dd600fe186f51ad1d51e095f.jpg',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => 21,
                'order_id' => 22,
                'goods_id' => 3,
                'goods_name' => '越南进口红心火龙果 3个装 大果',
                'number' => 1,
                'market_price' => '44.00',
                'retail_price' => '44.00',
                'goods_specifition_name_value' => NULL,
                'is_real' => 1,
                'list_pic_url' => 'images/a204d50e68dea8f2797b0ea29dc0bc2d.jpg',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id' => 22,
                'order_id' => 23,
                'goods_id' => 1,
                'goods_name' => '打算范德萨',
                'number' => 2,
                'market_price' => '12.00',
                'retail_price' => '213.00',
                'goods_specifition_name_value' => NULL,
                'is_real' => 1,
                'list_pic_url' => 'images/c82d319abd7a28d87f43b7af149750f3.png',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id' => 23,
                'order_id' => 23,
                'goods_id' => 2,
                'goods_name' => '测试',
                'number' => 1,
                'market_price' => '1.00',
                'retail_price' => '11.00',
                'goods_specifition_name_value' => NULL,
                'is_real' => 1,
                'list_pic_url' => 'images/9d15c8f5dd600fe186f51ad1d51e095f.jpg',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id' => 24,
                'order_id' => 23,
                'goods_id' => 3,
                'goods_name' => '越南进口红心火龙果 3个装 大果',
                'number' => 1,
                'market_price' => '44.00',
                'retail_price' => '44.00',
                'goods_specifition_name_value' => NULL,
                'is_real' => 1,
                'list_pic_url' => 'images/a204d50e68dea8f2797b0ea29dc0bc2d.jpg',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id' => 25,
                'order_id' => 24,
                'goods_id' => 2,
                'goods_name' => '测试',
                'number' => 1,
                'market_price' => '1.00',
                'retail_price' => '11.00',
                'goods_specifition_name_value' => NULL,
                'is_real' => 1,
                'list_pic_url' => 'images/9d15c8f5dd600fe186f51ad1d51e095f.jpg',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'id' => 26,
                'order_id' => 24,
                'goods_id' => 3,
                'goods_name' => '越南进口红心火龙果 3个装 大果',
                'number' => 4,
                'market_price' => '44.00',
                'retail_price' => '44.00',
                'goods_specifition_name_value' => NULL,
                'is_real' => 1,
                'list_pic_url' => 'images/a204d50e68dea8f2797b0ea29dc0bc2d.jpg',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'id' => 27,
                'order_id' => 24,
                'goods_id' => 1,
                'goods_name' => '打算范德萨',
                'number' => 3,
                'market_price' => '12.00',
                'retail_price' => '213.00',
                'goods_specifition_name_value' => NULL,
                'is_real' => 1,
                'list_pic_url' => 'images/c82d319abd7a28d87f43b7af149750f3.png',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}