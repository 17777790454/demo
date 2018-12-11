<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/12/11
 * Time: 10:01
 */

namespace Home\Controller;
use Think\Controller;
use Home\Model\UserModel;
class RegisterController extends BaseController{


    //用户注册
    public function addUser(){
        $request = I("");//接值

        if(empty($request['tel'])){
            $this->retMsg(1001,'手机号不能为空');
        }else{

            /* 验证手机号格式是否正确 */

            $user = new UserModel();//实例化模型
            $userTel = $user->getTel($request);

            if($userTel){
                $this->retMsg(1002,'该手机号已注册');
            }else{

                /* 手机短信获取验证码功能 */

                $num = rand(1000,9999); //生成一个随机的四位数验证码

                //判断验证码和密码
                if($request['num'] == "" || $request['pwd'] == ""){
                    $this->retMsg(1001,'请输入验证码和密码');
                }elseif ($request['pwd'] != $request['qrpwd']){
                    $this->retMsg(1001,'两次密码输入不一致');
                }
                $data = $user->addUser($request);

                if($data){
                    $this->retMsg(1000,'注册成功');
                }else{
                    $this->retMsg(1001,'注册失败');
                }
            }
        }

    }



}