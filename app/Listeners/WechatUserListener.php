<?php

namespace App\Listeners;

use Overtrue\LaravelWechat\Events\WeChatUserAuthorized;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class WechatUserListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  WeChatUserAuthorized  $event
     * @return void
     */
    public function handle(WeChatUserAuthorized $event)
    {
        $user = $event->user;
        if( $event->isNewSession ){
            //新授权用户写入表
            $data = [
                'openid' => $user->id,
                'nickname' => '',
                'avatar' => '',
                'sex' => '',
                'province' => '',
                'city' => '',
                'country' => '',
                /*
                'nickname' => $user->nickname,
                'avatar' => $user->avatar,
                'sex' => $user->original["sex"],
                'province' => $user->original["province"],
                'city' => $user->original["city"],
                'country' => $user->original["country"],
                */
            ];
            $count = \App\WechatUser::where('openid', $user->id)->count();
            if($count >= 1){
                \App\WechatUser::where('openid', $user->id)->update($data);
            }
            else{
                \App\WechatUser::create($data);
            }
        }
        $wechat_user = \App\WechatUser::where('openid', $user->id)->first();
        if( $wechat_user )
            \Session::put('user_id', $wechat_user->id);
        else
            \Session::put('user_id', 1);
    }
}
