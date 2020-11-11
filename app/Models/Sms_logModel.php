<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sms_logModel extends Model
{

    //1:指定表名
    protected $table = 'sms_log';

    //2:指定主键
    protected $primaryKey = 'id';

    //3:是否开启时间戳
    public $timestamps = false;

    //4:设置时间戳格式为Unix
    protected $dateFormat = 'U';

    //5:过滤字段，只有包含的字段才能被更新
    protected $fillable = ['phone','name',];


    //以下为数据库操作函数
    //1:添加一条记录的函数
    public function add($data){
    	return self::create($data);
    }

    //2:查询所有记录的函数
    public function getAllData(){
        return self::all();
    }

    //3:删除一条记录的函数
    public function del($id){
        return self::find($id)->delete();
    }

    //4:查询一条记录的函数
    public function fi($id){
        //return $student=DB::table("users")->where('id','=',$id)->get();
        return self::find($id);

    }

    //5:修改一条记录的函数
    public function up($id,$data){
         return self::find($id)->update($data);
    }

}
