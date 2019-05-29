<?php

namespace app\admin\model;

use think\Model;
use think\facade\Cache;

class ArticleModel extends Model
{   
    protected $pk = 'article_id';
    public function select(){
        $list = parent::select();
        
        foreach($list as $key => $val){
            $val['add_time'] = date("Y年m月d日", $val['add_time']);
        }
        return $list;
    }

    public static function paginates($num){
        $res = parent::where('is_show',1)->order('add_time','desc')->paginate($num);
        foreach ($res as $val){
            $val['add_time'] = date("Y年m月d日", $val['add_time']);
        }
        return $res;
    }

    public function find($id){
        $student = parent::get($id);
 
        $student['add_time'] = date("Y-m-d", $student['add_time']);
        return $student;
    }

    public function handleData($data){
        $data['img']  =  "https://".$_SERVER['SERVER_NAME']."/upload/".$data['img'];
        $data['add_time'] = time();
        $data['list_order'] = (int)$data['list_order'];
        $str = '';
        foreach ($data['tags_ids'] as $k=>$v){
            $str .= $k.',';
        }
        $data['tags_id'] = rtrim($str,',');
        return $data;
    }
}
