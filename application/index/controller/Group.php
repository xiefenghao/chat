<?php
namespace app\index\controller;
use think\Db;
use think\Request;
use think\Controller;

class Group extends Controller
{
  public function tex(){
    $toid='190group';
          $redis = new \Redis();  
$redis->connect('127.0.0.1', 6379);//serverip port
// $ret =$redis->LPush($name, $message);//左进左出用array_reverse
$info=$redis->lrange($toid,0,-1);
foreach ($info as $key => $value) {
  var_dump($value);
}
  }
  public function get_message(){
    $fromid =input('fromid').'group';
   $name =input('toid').'_';
     $redis =new \Redis();
     $redis->connect('127.0.0.1', 6379);
    $message=    $redis->lrange($name,0,-1);

    $time= $redis->lrange($fromid,0,-1);
   foreach ($time as $k => $v) {
     $from[$k]=explode('.', $v);
   }
   // return $from;
        foreach ($message as $key => $value) {     
      $i= json_decode($value,true);
foreach ($from as $k1 => $v1) {
if ($i['toid']==$v1[0]&&$i['time']>$v1[1]) {
  $message1[]['data']=$i;

}

}
    }
    if (isset($message1)) {    
      $message1=array_reverse($message1);
      return $message1;
    }
     // 
}
  //redis添加用户
     public function adduser(){
       $message['name']='我是40';
       $message['img_url']='http://localhost/chat/public/static/2.jpg';
      
           $redis =new \Redis();
           $name ='40'.'user';
            $message=json_encode($message);
     $redis->connect('127.0.0.1', 6379);
    $message=    $redis->lpush($name,$message);
    var_dump($message);
     }
     //redis添加到聊天组
     public function addgroup(){
       // $message['name']='我是40';
       // $message['img_url']='http://localhost/chat/public/static/3.jpg';
       // $message['name']='我是40';
           $redis =new \Redis();
           $time=time();
            $grouptime =input('toid').'.'.$time;
             $group =input('toid').'group';
           $from=input('fromid').'group';
           $fromid=input('fromid');
           // $message=json_encode($message);
     $redis->connect('127.0.0.1', 6379);
    $message=    $redis->lPush($group,$fromid);
     $message=    $redis->lPush($from,$grouptime);
     $redis->zincrby($fromid,0,input('toid'));
    var_dump($message);
     }
//判断聊天组最后时间
    public function check($message,$time,$in){
sort($in);
      foreach ($message as $key => $value) {

        $time1=json_decode($value['last'],true);//数组的时间
          foreach ($time as $key => $value) {
         if ($time1['toid']==$value[0]) {
            if ($time1['time']<=$value[1]) {
             $i=array_search($time1['toid'], $in);
           // var_dump($i);
            
             $message[$i]['last']='';
             // $message1[$key]=$message[$key];
             // var_dump($message1);
            }
          # code...
        }
        }


        }
   return $message;
  }
    //发送文本信息保存到数据库
    public function save_message(){
    	 if(Request::instance()->isAjax()){
        $message =input('post.');
        $message['content']=$message['data'];
        $message['shopid']=0;
        // $name = $this->mergename($data['fromid'], $data['toid']);
        // $ret=  Db::name('message')->insert($data);
        $message['type']=0;
        $toid=$message['toid'];
        $toid1=$toid.'group';
        $name=$message['toid'].'_';
         $fromid=$message['fromid'];
         // return $fromid;
        // var_dump($name);
        $message = json_encode($message);
        $redis = new \Redis();  
$redis->connect('127.0.0.1', 6379);//serverip port
$ret =$redis->LPush($name, $message);//左进左出用array_reverse
$info=$redis->lrange($toid1,0,-1);
  
foreach ($info as $key => $value) {
 // $ret[]=$value;
  // return $value;
   $ret1=$redis->zincrby($value,1,$toid);//zset自增

   
}
 
   $redis->zincrby($fromid,-1,$toid);
  // return $ret1;
}
// $redis->zincrby($fromid,-1,$toid);
}
    //
    //获取聊天对象名

    //获取聊天双方头像
public function get_img(){
  if(Request::instance()->isAjax()){
   $name =input('fromid').'user';
     $redis =new \Redis();
           // $name ='40user';
           // $message=json_encode($message);
     $redis->connect('127.0.0.1', 6379);
    $message=    $redis->lrange($name,0,0);
   return $message;
 }
}
public function get_all($fromid){
    $redis =new \Redis();
            $name =$fromid.'user';
           // $message=json_encode($message);
     $redis->connect('127.0.0.1', 6379);
    $message=    $redis->lrange($name,0,0);
   return $message;

}
public function mergename($fromid,$toid){
  if ($fromid>$toid) {
    $name = $fromid. '_' .$toid;
  }else{
   $name =$toid. '_' .$fromid;
 }
 return $name;
}
public function get_lastmessage1($fromid,$toid){
          // $last = Db::name('message')->where(['fromid'=>$fromid,'toid'=>$toid]
          $redis =new \Redis();
      $redis->connect('127.0.0.1', 6379);
          $name =$this->mergename($fromid,$toid);
          
          $last = $redis->lrange($name,0,0);
         // var_dump($last);
          return $last[0];
}
public function get_lastmessage2($fromid){
          // $last = Db::name('message')->where(['fromid'=>$fromid,'toid'=>$toid]
          $redis =new \Redis();
      $redis->connect('127.0.0.1', 6379);
          $name =$fromid.'_';
          // var_dump($name);
          $last = $redis->lrange($name,0,0);
           if (!$last) {
             $data['time']='';
              $data['content']='';
              $data=json_encode($data);
           $last[0]= '';
       
           }
           // var_dump($last);
          
           return $last[0];
}
    //获取聊天记录
// public function aaa(){
//    ;
//    $name ='190'.'_';
//    // $name =$this->mergename($fromid,$toid);
//      $redis =new \Redis();
//      $redis->connect('127.0.0.1', 6379);
//     $message=    $redis->lrange($name,0,-1);
//     foreach ($message as $key => $value) {     
//       $i= json_decode($value,true);
//         $message[$key] = Db::name('user')->field('img_url')->where('id',$i['fromid'])->find();
//         $message[$key]['data']=$i;
//     }
//      $message=array_reverse($message,);
//       var_dump($message);
// }
//获取所在的所有数组最后一条信息，如果加入时间比信息晚则内容为空
public function list(){
      $fromid =input('id');
       $group =$fromid.'group';
   // $name =input('toid').'_';
     $redis =new \Redis();
     $redis->connect('127.0.0.1', 6379);
  $groupin= $redis->lrange($group,0,-1);
    foreach ($groupin as $k => $v) {
     $from[$k]=explode('.', $v);
     $in[] = $from[$k][0];
   }
    $time= $redis->zrange($fromid,0,-1,true);

      foreach ($time as $key => $value) {
    // var_dump($key);
      if (in_array($key,$in)) {

           $info1[]= [
      'name' =>$this->get_all($key),
       
      'last'=>$this->get_lastmessage2($key),
      'chat_page'=>"http://localhost/chat/public//index/index/group?fromid={$fromid}&toid={$key}",
    
       'num'=>$value,
       ];
     // var_dump($info1);
    $info2 =  $this->check($info1,$from,$in);
     //   $u= json_decode($info1['last']);
     // var_dump($u);
      }else{
         // var_dump($key,$fromid);
          $info[]= [
      'name' =>$this->get_all($key),
      
      'last'=>$this->get_lastmessage1($key,$fromid),
      'chat_page'=>"http://localhost/chat/public/index/index/indexx/?fromid={$fromid}&toid={$key}",
    
       'num'=>$value,
       ];
      }
   
   
  }

$info=array_merge($info,$info2);
array_multisort(array_column($info,'last'),SORT_DESC,$info);
// $info=array_reverse($info);
 // var_dump($info);
 return $info;
}


public function aaaaaaa(){
    $name = $key.'_';
       var_dump($name);
        $message['last']=    $redis->lrange($name,0,0); //最后的信息
var_dump($message);
            $message1=json_decode($message['last'][0],true);
       
       $user=$key.'user';
        $message['name']=$redis->lrange($user,0,0);//聊天组的信息
        foreach ($from as $k1 => $v1) {
          var_dump($v1);
           if ($message['name']==$v1[0]) {
        if($message['time']<$v1[1]){
          var_dump($message);
        }
        }
        }
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
    // $ret =  Db::name('message')->insert($data);

       $data=json_encode($data);
       $name1 =$toid.'_';
       $toid1=$toid.'group';
         $redis =new \Redis();
     $redis->connect('127.0.0.1', 6379);
     $ret=  $redis->lPush($name1 ,$data);
     $info=$redis->lrange($toid1,0,-1);
foreach ($info as $key => $value) {

   $redis->zincrby($value,1,$toid);//zset自增
}
          // $redis->zincrby($toid,1,$fromid);//zset自增
          //  $redis->zincrby($fromid,0,$toid);
    if($ret){
     return ["status"=>'ok',"img"=>$name];
   }else{
     return ["status"=>'false'];
   }
 }

}
//清除未读redis刷新
public function changeIsread1(){
   $fromid =input('fromid');
  $toid=input('toid');
   // return $toid;
  $redis =new \Redis();
     $redis->connect('127.0.0.1', 6379);
     
       $num= -($redis->zincrby($fromid,-0, $toid)) ;
      $ret=  $redis->zincrby($fromid,$num,$toid);
       return $num;
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
//退出群聊
   public function outgroup(){
       // $message['name']='我是40';
       // $message['img_url']='http://localhost/chat/public/static/3.jpg';
       // $message['name']='我是40';
           $redis =new \Redis();
           $time='1616898548';
             $groupid =input('group');
             $group =input('group').'group';
           $from=input('fromid').'group';
           $fromid=input('fromid');
           $num=0;
           // $message=json_encode($message);
     $redis->connect('127.0.0.1', 6379);
      $message=    $redis->lrange($group,0, -1);
      foreach ($message as $key => $value) {
        if ($value==$fromid) {
          var_dump($value);
          $redis->lrem($group,$fromid);
        }
      }
       $message1=    $redis->lrange($from,0, -1);
       foreach ($message1 as $k => $v) {
        var_dump($v);
      $info[$k]=explode('.', $v);

     // 
      // var_dump($);
   }var_dump($info);
   foreach ($info as $key => $value) {
     if($groupid==$value[0]){
        $redis->lrem($from,$message1[$key]);
     }
   }
    // $message=    $redis->lPushx($group,$fromid);
    //  $message=    $redis->lPush($from,$groupid);
    var_dump($message,$message1);
     }
}
