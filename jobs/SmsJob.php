<?php

namespace app\jobs;

use app\classes\SmsService;
use yii\base\BaseObject;
use yii\queue\JobInterface;
use Yii;

/**
 * Class SmsJob
 * 
 * @package app\jobs
 */
class SmsJob extends BaseObject implements JobInterface
{
    public array $params;

    public function execute($queue)
    {
        $smsService = new SmsService($this->params['phone'], $this->params['text']);
        $response = $smsService->sendRequest();
        if ($response->isFailure()) {
            Yii::info(
                [
                    'Error description' => $response->getErrorDescription(),
                    'Phone number' => $this->params['phone'],
                    'Text SMS' => $this->params['text']
                ],
                'job_errors'
            );
        }
    }
}
