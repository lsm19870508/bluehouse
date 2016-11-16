<?php

namespace App\Jobs;

use App\Jobs\Job;
use GuzzleHttp\Client;

class HuaXingSNSJob extends Job
{
    protected $phone;
    protected $msg;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($phone,$msg)
    {
        //
        $this->msg = $msg;
        $this->phone = $phone;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $client  = new Client();

        $response = $client->request('POST',env("HUAXING_MSG_API"),[
            'query' => 'reg=' . env("HUAXING_USER")
                . '&pwd=' . env("HUAXING_PASSWORD")
                //. '&sourceadd='
                . 'phone=' . $this->phone
                . '&content= ' . $this->msg
        ]);

        $statusCode = $response->getStatusCode();
        $result = [];

        //操作成功
        if ($statusCode == 200) {
            // 拆解结果集
//            result=0&message=短信发送成功&smsid=
//            result：结果码，0表示成功，其他表示失败
//            message：结果码解释
//            smsid：短信包ID
            $r = explode('&', (string)$response->getBody());
            $rCode = intval(explode('=',$r[0])[1]);
            $result['code'] = $rCode;
            if ($rCode != 0) {
                $result['reason'] = explode('=',$r[1])[1];
            }
        } else {
            $result['code'] = $statusCode;
            $result['reason'] = $response->getReasonPhrase();
        }
        return $result;
    }
}
