<?php

namespace app\classes;

use Yii;
use yii\httpclient\Client;

class SmsService
{
    const API_KEY = 'XXXXXXXXXXXXYYYYYYYYYYYYZZZZZZZZXXXXXXXXXXXXYYYYYYYYYYYYZZZZZZZZ';
    const SENDER = 'INFORM';
    const URL = 'https://smspilot.ru/api.php';
    const FORMAT = 'json';

    private Client $client;
    private string $phone;
    private string $text;
    private array $formatVariants = [
        'json' => [
            'type' => 'json',
            'content-type' => 'application/json',
        ]
    ];
    private array $response = [];

    public function __construct(string $phone, string $text)
    {
        $this->client = new Client([
           'baseUrl' => self::URL,
           'requestConfig' => [
               'format' => Client::FORMAT_JSON
           ],
           'responseConfig' => [
               'format' => Client::FORMAT_JSON
           ],
       ]);

        $this->phone = $this->preparePhone($phone);
        $this->text = $text;
    }

    /**
     * Преобразовать номер телефона в валидный для сервиса
     *
     * @param string $phone
     * @return string
     */
    private function preparePhone(string $phone): string
    {
        return strval(str_replace([' ', '+', '(', ')'], ['', '', '', ''], $phone));
    }

    /**
     * Отправить запрос
     *
     * @return SmsService
     */
    public function sendRequest(): SmsService
    {
        $this->response = $this->oClient->createRequest()
            ->setMethod('GET')
            ->addHeaders([
                 'content-type' => $this->formatVariants[self::FORMAT]['content-type'],
             ])
            ->setData([
                'send' => $this->text,
                'to' => $this->phone,
                'from' => self::SENDER,
                'apikey' => self::API_KEY,
                'format' => $this->formatVariants[self::FORMAT]['type'],
            ])
            ->send();

        return $this;
    }

    /**
     * Успешный ли запрос
     *
     * @return bool
     */
    public function isSuccess(): bool
    {
        return isset($this->response['send']);
    }

    /**
     * Проверить, неудачный запрос
     *
     * @return bool
     */
    public function isFailure(): bool
    {
        return isset($this->response['error']);
    }

    /**
     * Получить текст ошибки
     *
     * @return string
     */
    public function getErrorDescription(): string
    {
        return $this->response['error']['description_ru'] ?? '';
    }
}