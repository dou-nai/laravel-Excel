<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Admin\ContentTypes\File;
use App\Models\Win1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Routing\Controller;
use Symfony\Component\CssSelector\Parser\Reader;




class TestExport implements FromArray
{
    public function index(Excel $excel){
        //将数据库中的信息转化为excel文件内容
       $data=Win1::with('hasManyWindow')->get();
      foreach ($data as $key){
        $export[]=array(
            'id'=>$key['id'],
            'window'=>$key['window'],
   //         数据表中的两个字段
        );
      }
      $table_name='窗口名称';

   $excel::create($table_name,function ($excel)use($export){
       $excel->sheet('Sheet1',function ($sheet)use($export){
          $sheet->fromArray($export);
       });
   })->store('xlsx')->export('xlsx');


       }


}

