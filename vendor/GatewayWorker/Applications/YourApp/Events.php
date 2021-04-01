<?php
/**
 * This file is part of workerman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link http://www.workerman.net/
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * 用于检测业务代码死循环或者长时间阻塞等问题
 * 如果发现业务卡死，可以将下面declare打开（去掉//注释），并执行php start.php reload
 * 然后观察一段时间workerman.log看是否有process_timeout异常
 */
//declare(ticks=1);

use \GatewayWorker\Lib\Gateway;

/**
 * 主逻辑
 * 主要是处理 onConnect onMessage onClose 三个方法
 * onConnect 和 onClose 如果不需要可以不用实现并删除
 */
class Events
{
    /**
     * 当客户端连接时触发
     * 如果业务不需此回调可以删除onConnect
     * 
     * @param int $client_id 连接id
     */
    public static function onConnect($client_id)
    {
      var_dump($client_id);
        Gateway::sendToClient($client_id,json_encode([
            'type'=>'init',
            'client_id'=>$client_id
            ]));
    }
    
   /**
    * 当客户端发来消息时触发
    * @param int $client_id 连接id
    * @param mixed $message 具体消息
    */
   public static function onMessage($client_id, $message)
   {
        // 向所有人发送 
        // Gateway::sendToAll("$client_id said $message\r\n");
   $message_data = json_decode($message,true);
   var_dump($message_data);
        switch ($message_data['type']) {
          case 'bind':
            Gateway::bindUid( $client_id, $message_data['fromid']);
         return;
           case 'binds':
            Gateway::bindUid( $client_id, $message_data['fromid']);
             Gateway::joinGroup($client_id, $message_data['toid']);
         return;
           case 'gimg':
          $data=[
              'fromid'=>$message_data['fromid'],
              'toid'=>$message_data['toid'],
              'type'=>'img',
              'time'=>time(),
              'data'=>$message_data['data']
            ];
                       Gateway::sendToGroup($message_data['toid'],json_encode($data) );

         return;
           case 'img':
          $data=[
              'fromid'=>$message_data['fromid'],
              'toid'=>$message_data['toid'],
              'type'=>'img',
              'time'=>time(),
              'data'=>$message_data['data']
            ];
                        Gateway::sendToUid($message_data['toid'], json_encode($data));

         return;
          case "online":
             $status =Gateway::isUidOnline($message_data['toid']);
             var_dump($status);
               GateWay::sendToUid($message_data['fromid'],json_encode(["type"=>"online","status"=>$status]));
              return;
          case 'said':
             $data=[
              'fromid'=>$message_data['fromid'],
              'toid'=>$message_data['toid'],
              'type'=>'text',
              'time'=>time(),
              'data'=>$message_data['data']
            ];
            // var_dump(Gateway::isUidOnline($message_data['toid']));
            // 如果toid在线
            if(Gateway::isUidOnline($message_data['toid'])){
              $data['isread']=1;
              GateWay::sendToUid($message_data['toid'],json_encode($data));
            }else{
              $data['isread']=0;
            }


            $data['type']="save";
               Gateway::sendToUid($message_data['fromid'],json_encode($data));
          return;
           case 'gsaid':
           var_dump($message_data['toid']);
             $data=[
              'fromid'=>$message_data['fromid'],
              'toid'=>$message_data['toid'],
              'type'=>'text',
              'time'=>time(),
              'data'=>$message_data['data']
            ];
            // Gateway::sendToGroup( Gateway::getUidListByGroup($message_data['toid']),json_encode($data) [$exclude_client_id = null[ $raw = false]]);        
              Gateway::sendToGroup(Gateway::getUidListByGroup($message_data['toid']),json_encode($data));
            // Gateway::sendToGroup($message_data['toid'],json_encode($data) ,[$exclude_client_id = $data['fromid']]);
            Gateway::sendToGroup($message_data['toid'],json_encode($data) );
              // GateWay::sendToUid();
              var_dump( $message_data['toid']);
            $data['type']="save";
               Gateway::sendToUid($message_data['fromid'],json_encode($data));
          return;
        }
        
       
   }
   
   /**
    * 当用户断开连接时触发
    * @param int $client_id 连接id
    */
   public static function onClose($client_id)
   {
       // 向所有人发送 
       // GateWay::sendToAll("$client_id logout\r\n");
   }
}
