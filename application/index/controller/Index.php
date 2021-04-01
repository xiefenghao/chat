<?php
namespace app\index\controller;
use think\Db;
use think\Request;
use think\Controller;

class Index extends Controller
{

  public function as(){
    $fromid = input("fromid");
    $toid =  input('toid');
    $message= Db::name('message')->
    where('(fromid=:fromid and toid =:toid)||(fromid=:toid1 and toid =:fromid1)',['fromid'=>$fromid,'toid'=>$toid,'toid1'=>$toid,'fromid1'=>$fromid])->limit(0,10)->order('id','desc')->select();
    $message=array_reverse($message);
    var_dump($message);
  }
  //刷新加载上十条聊天记录，$n当前页数
  public function aa(){
   $redis = new \Redis();  
   $redis->connect('127.0.0.1', 6379);
   $length =  $redis->llen('mylist2');
   $n=1;
   $i=($n-1)*10;
   $j=$n*10-1;
   var_dump($length);
   var_dump($i);
   if ($i<$length) {
      // array_reverse($a);
     $data =  $redis->lrange('mylist2',$i,$j);
     $data=array_reverse($data); 
     var_dump($data);
   }
   

 }
  //把聊天记录未读改为已读
 public function changeIsread(){
  if (Request::instance()->isAjax()) {
        $fromid=input('fromid');//自己的id聊天记录中的toid
        $toid=input('toid');

        Db::name('message')->where(['fromid'=>$toid,'toid'=>$fromid])->update(['isread'=>1]); 
       // return $id;
      }
    }
    public  function a(){
      return 11;
    }
    public function common(){
      $fromid = input("fromid");
      $toid =  input('toid');
      $this->assign('fromid',$fromid);
      $this->assign('toid',$toid);
      return $this->fetch();
    }
      public function commons(){
      $fromid = input("fromid");
      $toid =  input('toid');
      $this->assign('fromid',$fromid);
      $this->assign('toid',$toid);
      return $this->fetch();
    }
  //页面加载
    public function index()
    {
      $fromid = input("fromid");
      $toid =  input('toid');
      $this->assign('fromid',$fromid);
      $this->assign('toid',$toid);
      return $this->fetch();

    }
     public function indexx()
    {
      $fromid = input("fromid");
      $toid =  input('toid');
      $this->assign('fromid',$fromid);
      $this->assign('toid',$toid);
      return $this->fetch();

    }
    //发送文本信息保存到数据库
    public function save_message(){
    	if(Request::instance()->isAjax()){
        $message =input('post.');

        $data['fromid']=$message['fromid'];
        $data['toid']=$message['toid'];
        $data['content']=$message['data'];
        $data['type']=$message['type'];
        $data['time']=$message['time'];

        $data['isread']=0;
        $data['shopid']=0;
        $name = $this->mergename($data['fromid'], $data['toid']);
        $ret=  Db::name('message')->insert($data);
        $data['type']=0;
        $toid=$data['toid'];
        $fromid=$data['fromid'];
        
        $data = json_encode($data);
        $redis = new \Redis();  
$redis->connect('127.0.0.1', 6379);//serverip port
$redis->LPush($name, $data);//左进左出用array_reverse
 $redis->zincrby($toid,1,$fromid);//zset自增
  $redis->zincrby($fromid,0,$toid);
return $ret;
}
}
    //
public function mergename($fromid,$toid){
  if ($fromid>$toid) {
    $name = $fromid. '_' .$toid;
  }else{
   $name =$toid. '_' .$fromid;
 }
 return $name;
}
    //获取聊天列表用户名，图片
public function get_all($fromid){
  $name = Db::name('user')->field('name,img_url')->where('id',$fromid)->find();
  return $name;

}
    //获取聊天对象名
public function get_name(){
 if(Request::instance()->isAjax()){

   $toid =input('toid');

   $toinfo = Db::name('user')->field('name,img_url')->where('id',$toid)->find();
   return [
     'to'=>$toinfo
   ];
 }
}
    //获取聊天双方头像
public function get_img(){
  if(Request::instance()->isAjax()){
   $fromid =input('fromid');
   $toid =input('toid');
   $frominfo = Db::name('user')->field('img_url')->where('id',$fromid)->find();
   $toinfo = Db::name('user')->field('img_url')->where('id',$toid)->find();
   return [
     'from'=>$frominfo,
     'to'=>$toinfo
   ];
 }
}
    //获取聊天对象，未读信息
public function get_list(){
  if (request()->isAjax()) {
    $fromid = input('id');
    //接收的信息
    $toinfo = Db::name('message')->where('toid',$fromid)
    ->group('fromid')->select();
    //发送的消息
    $frominfo=Db::name('message')->where('fromid',$fromid)  
    ->group('toid')->select();
    //接收的最后一条消息
    $info = array_map(function($res){
    return [
      'name' =>$this->get_all($res['fromid']),
      'countNoread' =>$this->get_unread($res['fromid'],$res['toid']),
      'last'=>$this->get_lastmessage($res['fromid'],$res['toid']),
      'chat_page'=>"http://localhost/chat/public/?fromid={$res['toid']}&toid={$res['fromid']}"
    ];
          //toid是自己    
  },$toinfo);
    //发送的最后一条消息
    $info1 = array_map(function($res){
    return [
      'name' =>$this->get_all($res['toid']),
      'countNoread' =>$this->get_unread($res['toid'],$res['fromid']),
      'last'=>$this->get_lastmessage($res['toid'],$res['fromid']),
      'chat_page'=>"http://localhost/chat/public/?fromid={$res['fromid']}&toid={$res['toid']}"
    ];
          //froid是自己     
  },$frominfo);
  
     foreach ($info as $key=>$v1) {
    foreach($info1 as $key2=>$v2){
      if($v1==$v2){
      unset($info[$key]);//删除接收数组中相同值元素  
      }
    }
  }
     $info=array_merge($info, $info1);//合并数组
          //toid是自己
array_multisort(array_column($info,'last'),SORT_DESC,$info);//根据时间排序，越近越在上面
   return $info;
 }
}
//redis 聊天列表
public function get_list1(){
    $toid = input('id');

 
   // var_dump($toid);
     $redis =new \Redis();
      $redis->connect('127.0.0.1', 6379);
  
     $toinfo =  $redis->zrange ($toid, 0, -1);
      // return $toinfo; 
        // var_dump($toinfo);
       // return $toinfo;
foreach ($toinfo as $key => $value) {
   $info[]= [
      'name' =>$this->get_all($value),
      
      'last'=>$this->get_lastmessage1($value,$toid),
      'chat_page'=>"http://localhost/chat/public/index/index/indexx/?fromid={$toid}&toid={$value}"
    ];
}
// 
return $info;
$count =$this->noread($toid);
 foreach($count as $key=>$vo){

        $list[] = array_merge($vo,$info[$key]);

    }
// $info=array_merge($info,$count);
 // var_dump(is_array($info));
    array_multisort(array_column($list,'last'),SORT_ASC,$list);
  return $list;
}
public function get_lastmessage($fromid,$toid){
          // $last = Db::name('message')->where(['fromid'=>$fromid,'toid'=>$toid])->order("id desc")->find();  //自己发送的不会更新
 $last = Db::name('message')
 ->where(['fromid'=>$fromid,'toid'=>$toid])
 ->whereOr(function ($query) use ($fromid,$toid){
  $query->where(['fromid'=>$toid,'toid'=>$fromid]);
})->order("id desc")->find(); 
 return $last;
         
}
//redis
public function get_lastmessage1($fromid,$toid){
          // $last = Db::name('message')->where(['fromid'=>$fromid,'toid'=>$toid]
          $redis =new \Redis();
      $redis->connect('127.0.0.1', 6379);
          $name =$this->mergename($fromid,$toid);
          $last = $redis->lrange($name,0,0);
                     if (!$last) {
             $data['time']='';
              $data['content']='';
              $data=json_encode($data);
           $last[0]= '';
       
           }
          return $last[0];
}
    //获取聊天记录
public function get_message(){
 // if(Request::instance()->isAjax()){
   $fromid =input('fromid');
   $toid =input('toid');
   // $name =$this->mergename($fromid,$toid);
   //   $redis =new \Redis();
   //   $redis->connect('127.0.0.1', 6379);
   //  $message=    $redis->lrange($name,0,-1);
   //  $message=array_reverse($message);
  //  $num =  Db::name('message')->
  //  where('(fromid=:fromid and toid =:toid)||(fromid=:toid1 and toid =:fromid1)',['fromid'=>$fromid,'toid'=>$toid,'toid1'=>$toid,'fromid1'=>$fromid])->count();

  //  if($num>10){
  //   $message=	Db::name('message')->
  //   where('(fromid=:fromid and toid =:toid)||(fromid=:toid1 and toid =:fromid1)',['fromid'=>$fromid,'toid'=>$toid,'toid1'=>$toid,'fromid1'=>$fromid])->limit($num-10,10)->order('id')->select();
  // }
  // else{ 
  //  $message = Db::name('message')
  //  ->where(['fromid'=>$fromid,'toid'=>$toid])
  //  ->whereOr(function ($query) use ($fromid,$toid){
  //   $query->where(['fromid'=>$toid,'toid'=>$fromid]);
  // })
  //  ->order('id')->select();
 // }

           $message= Db::name('message')->
        where('(fromid=:fromid and toid =:toid)||(fromid=:toid1 and toid =:fromid1)',['fromid'=>$fromid,'toid'=>$toid,'toid1'=>$toid,'fromid1'=>$fromid])->limit(0,10)->order('id','desc')->select();
         $message=array_reverse($message);
  
 return $message;

// }
}
public function get_message1(){
   $fromid =input('fromid');
   $toid =input('toid');
   $name =$this->mergename($fromid,$toid);
     $redis =new \Redis();
     $redis->connect('127.0.0.1', 6379);
    $message=    $redis->lrange($name,0,-1);
    $message=array_reverse($message);
    // var_dump($message);
    return $message ;
}
public function group(){
      $fromid = input("fromid");
      $toid =  input('toid');
      $this->assign('fromid',$fromid);
      $this->assign('toid',$toid);
      return $this->fetch();

}
    //
public function getonread(){
 if (request()->isAjax()) {
  $fromid = input('fromid');
  $toinfo = Db::name('message')->where(['toid'=>$fromid,'isread'=>0])->count();
  return $toinfo;
}
}
    //获取未读信息条数
public function get_unread($fromid,$toid){
 $count = Db::name('message')->where(['fromid'=>$fromid,'toid'=>$toid,'isread'=>0])
 ->count();
 return $count;
}
    //
public function lists(){
  $fromid = input("fromid");
  $toid =  input('toid');
  $this->assign('fromid',$fromid);
  $this->assign('toid',$toid);
  return $this->fetch();
}
public function listss(){
  $fromid = input("fromid");
  $toid =  input('toid');
  $this->assign('fromid',$fromid);
  $this->assign('toid',$toid);
  return $this->fetch();
}
    //发送图片保存到数据库
public function uploadsimg(){
  $file =$_FILES['file'];
  $fromid = input('fromid');
  $toid = input('toid');
  $time = time();
      // return $time;die();
  $online = input('online');
  $suffix = strtolower(strchr($file['name'],'.')) ;
  $type =['.jpg','.jpeg','.gif','.png'];
  if(!in_array( $suffix,$type)){
    return ['status'=>'img type error'];
  }
  if($file['size']/1024>5120){
    return ['status'=>'img is too large'];
  }
  $filename =uniqid("img",false);
  $uploadpath = ROOT_PATH.'public\\uploads\\';
  $file_up=$uploadpath.$filename.$suffix;
  $re =  move_uploaded_file($file['tmp_name'],$file_up);
  if ($re) {
    $name = $filename.$suffix;
    $data['content'] =$name ;
    $data['toid']=$toid;
    $data['fromid']=$fromid;
    $data['isread']=$online;
    $data['type']=2;
    $data['time']=$time;
    $ret =  Db::name('message')->insert($data);

       $data=json_encode($data);
        $name1 = $this->mergename($fromid, $toid);
         $redis =new \Redis();
     $redis->connect('127.0.0.1', 6379);
       $redis->lPush($name1,$data);
          $redis->zincrby($toid,1,$fromid);//zset自增
           $redis->zincrby($fromid,0,$toid);
    if($ret){
     return ["status"=>'ok',"img"=>$name];
   }else{
     return ["status"=>'false'];
   }
 }

}
//清除未读redis刷新
public function changeIsread1(){
   $toid =input('fromid');
  $fromid=input('toid');
  $redis =new \Redis();
     $redis->connect('127.0.0.1', 6379);
       $num= -($redis->zincrby($toid,0, $fromid)) ;
        $redis->zincrby($toid,$num,$fromid);
       
   // $redis->zRem ($toid ,$fromid);
}
//未读信息
public function noread($toid){
   // $fromid =input('toid');
   // $toid=input('toid');

  $redis =new \Redis();
     $redis->connect('127.0.0.1', 6379);
   // $redis->zincrby($toid,1,$fromid);//zset自增
  $num=  $redis->zrange($toid,0,-1,true);
      // var_dump($num);
  // var_dump(count($num));

  foreach ($num as $key => $value) {
   
       $message[]['num']=$value;
   
   
  }
  //   // var_dump($message);
  // if (isset($message1)) {
  //    foreach ($message1 as $key => $value) {
  //   $message[$key]['num']=$value;
  // }
  // $message=array_merge($message, $message1);
  // }
// var_dump($message);
return $message;

  // array (size=6)
  // 90 => float 1
  // 3 => float 10
  // 4 => float 10
  // 6 => float 10
  // 10 => float 12
  // 110 => float 13
   // zRange(key, start, end,withscores)
}
}
