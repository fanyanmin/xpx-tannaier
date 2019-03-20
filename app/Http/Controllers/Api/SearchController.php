<?php
/**
 * Created by PhpStorm.
 * User: zhangzhenwei
 * Date: 2019/3/19
 * Time: 21:47
 */

namespace App\Http\Controllers\Api;

use App\Models\SearchHistory;

class SearchController extends ApiController
{

    public function history()
    {

        $data = SearchHistory::where(['uid' => auth()->id()])->orderBy('id')->limit(10)->get();

        return $this->success($data);
    }

    public function clearhistory()
    {
        return $this->success(SearchHistory::where(['uid' => auth()->id()])->delete());
    }
}