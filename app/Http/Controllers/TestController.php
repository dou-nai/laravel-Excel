<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TestExport;
use App\Imports\TestImport;

class TestController extends Controller
{
    //1:测试类导出
    public function export($id)
    {
        return Excel::download(new TestExport($id),'exporttest.xlsx');
    }

    //2:测试类导入
    public function import()
    {
        //dd(public_path('\file\test.xlsx'));
        $array = Excel::toArray(new TestImport,public_path('\file\test.xlsx'));
        dd($array);//简单的打印一下
    }


    //获取sms_log表下面的所有数据
    public function DownLoadSms_logDataList($data, $file_name = '访问统计信息表',$sheet_name='统计信息') {
        Excel::create($file_name, function ($excel) use ($data, $sheet_name) {
            $excel->sheet($sheet_name, function ($sheet) use ($data) {
                $sheet->fromModel($data)
                    ->freezeFirstRow(); #冻结第一行
            });
        })
            ->export('xlsx'); #导出格式为xlsx
    }
}
