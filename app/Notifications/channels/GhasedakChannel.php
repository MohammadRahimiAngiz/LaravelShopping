<?php


namespace App\Notifications\channels;

//use Ghasedak\GhasedakApi;
use Ghasedak\Exceptions\ApiException ;
use Ghasedak\Exceptions\HttpException;
use Illuminate\Notifications\Notification;

class GhasedakChannel
{
    public function send(Notification $notification)
    {
        $data=$notification->toGhasedakSms();
//        dd($data);
        $message = $data['text'];
        $receptor=$data['phone'];
        $apiKey=config('services.ghasedak.key');

        try
        {
//            $message = "تست ارسال وب سرویس قاصدک";
            $lineNumber = "10008566";
//            $receptor = "09121940336";
            $api = new \Ghasedak\GhasedakApi($apiKey);
            $api->SendSimple($receptor,$message,$lineNumber);
        }
        catch(ApiException $e){
            throw $e;
        }
        catch(HttpException $e){
            throw $e;
        }

    }
}
