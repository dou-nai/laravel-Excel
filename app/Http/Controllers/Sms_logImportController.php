<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sms_logModel;
use Excel;
use DB;
class Sms_logImportController extends Controller
{
    //1:读取数据以及调用方法写入数据库
    public function reading_data(){
        //(1)设置文件路径
        $filePath = public_path('file\\export\\').iconv('UTF-8', 'GBK', '信息管理表').'.xlsx';

        //(2)读取xlsx表格数据
        Excel::load($filePath, function($reader){
           $data = $reader->all();
             //(1)数据类型转换
             $data = $this->objToArray($data);

             //(2)数据持久化
             $res = $this->addAll($data);

             if($res!=null){
                 echo('表格插入失败！');
             }else{
                 echo('表格上传成功！');
             }


        });
    }

    //2:对象转数组
    function objToArray(object $data)
    {
        return json_decode(json_encode($data), true);
    }

    //3:数据持久化
    public function addAll(Array $data)
    {
        //dd($data);
        $arr=[];
        foreach($data as $item)
        {
        $row= [
            'phone'=>$item['phone'],
            'code'=>$item['code'],
            'is_type'=>$item['短信类型'],
            'name'=>$item['姓名'],
            'status'=>$item['status'],
            'is_use'=>$item['状态'],
            //['add_time'=>$data[6]['is_type']],
          ];
          array_push($arr,$row);
        }
        DB::table('excel_import')->insert($arr);
    }


}
