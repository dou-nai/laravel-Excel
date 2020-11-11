<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sms_logModel;
use Excel;

class Sms_logController extends Controller
{
    //1:查询数据表数据
    public function getAllSms_logList(){

         //（1）实例化模型
         $sms = new Sms_logModel();

         //（2）调用模型方法并接收返回数据
         $data =  $sms -> getAllData();

         //（3）数据格式转换
         $cellData = $this->data_conversion($data);

         //（4）使用Excel插件将数组导出为excel表格
         $this->excelExport($cellData);

    }

    //2:数据转换函数
    public function data_conversion(object $data){

         //（1）表头设置
         $cellData = [
             ['id','phone','code','短信类型','姓名','status','状态','添加时间']
         ];

         //（2）对象数据转数组
         foreach ( $data as $student){
            $datab = [
                $student->id,
                //$student->created_at->format('Y-m-d H:i:s'),
                $student->phone,
                $student->code,
                $student->is_type,
                $student->name,
                $student->status,
                $student->is_use,
                $student->add_time
            ];

            //（3）表头压入
            array_push($cellData,$datab);
        }

        return $cellData;
    }

    //3:导出处理函数
    public function excelExport(Array $cellData){
         Excel::create('信息管理表',function($excel) use ($cellData){
             $excel->sheet('score', function($sheet) use ($cellData){
                 $sheet->rows($cellData);
             });
         })->export('xlsx');
    }

}
