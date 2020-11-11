<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Exports\ExportExport;
use Excel;

class ExcelController extends Controller
{
    //1:Excel文件导出函数
    public function export(){
        $cellData = [
            ['1001','A','90'],
            ['1002','B','89'],
            ['1003','C','80'],
            ['1004','D','70'],
            ['1005','E','60'],
        ];
        Excel::create('学生成绩',function($excel) use ($cellData){
            $excel->sheet('score', function($sheet) use ($cellData){
                $sheet->rows($cellData);
            });
        })->export('xlsx');
    }

    //     如果你要导出csv或者xlsx文件，只需将export方法中的参数改成csv或xlsx即可。
    // 如果还要将该Excel文件保存到服务器上，可以使用store方法：
    // Excel::create(‘学生成绩‘,function($excel) use ($cellData){
    //      $excel->sheet(‘score‘, function($sheet) use ($cellData){
    //          $sheet->rows($cellData);
    //      });
    // })->store(‘xls‘)->export(‘xls‘);
    // 文件默认保存到storage/exports目录下，如果出现文件名中文乱码，将上述代码文件名做如下修改即可：
    // iconv(‘UTF-8‘, ‘GBK‘, ‘学生成绩‘)


    //2:excel文件导入函数
    public function import(){
        $filePath = 'public\file\\'.iconv('UTF-8', 'GBK', 'test').'.xlsx';
        Excel::load($filePath, function($reader) {
            $data = $reader->all();
            dd($data);
        });
    }

}
