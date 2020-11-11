<?php

namespace App\Imports;

use Illuminate\Support\Collection;
//use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToArray;

class TestImport implements ToArray
{
    public function array(array $array)
    {
        //处理导入数据$array
        //...
        return $array;
    }
}
