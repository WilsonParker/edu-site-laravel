<?php

namespace Tests\Unit;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Tests\TestCase;

class APITest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $client = new Client();
        $response = $client->post('http://ticket.cgv.co.kr/CGV2011/RIA/CJ000.aspx/CJ_HP_TIME_TABLE', [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body' => '{"REQSITE":"x02PG4EcdFrHKluSEQQh4A==","MovieGroupCd":"93dbhvN1HLBKviQLF/KpQg==","TheaterCd":"LMP+XuzWskJLFG41YQ7HGA==","PlayYMD":"Pj+XXZzEk1bypzsrdVX0pg==","MovieType_Cd":"nG6tVgEQPGU2GvOIdnwTjg==","Subtitle_CD":"nG6tVgEQPGU2GvOIdnwTjg==","SOUNDX_YN":"nG6tVgEQPGU2GvOIdnwTjg==","Third_Attr_CD":"nG6tVgEQPGU2GvOIdnwTjg==","IS_NORMAL":"nG6tVgEQPGU2GvOIdnwTjg==","Language":"zqWM417GS6dxQ7CIf65+iA=="}',
        ]);
        $result = json_decode($response->getBody()->getContents());
        $data = $result->d->data->DATA;
        if (Str::of($data)->contains('IMAX')) {
            Log::debug('founded imax');
            $this->testSendMessage();
        } else {
            Log::debug('not found imax');
        }
    }

    public function testCode() {
        $client = new Client();
        $response = $client->get('https://kauth.kakao.com/oauth/authorize?client_id=2be673b3baae9b7075d3d442ca0a0b09&redirect_uri=https://study-laravel-project.test/kakao/login&response_type=code');

        dd($response->getBody()->getContents());
    }

    public function testLogin()
    {
        $client = new Client();
        // cHWsnLu18PH4nn0iMvPFMAe-U_Le6tO-nJg8fCxJZEV30r1jJHfdCPqSPlj3ph_JzTricgopb9QAAAF87ZpXJg
        // cHWsnLu18PH4nn0iMvPFMAe-U_Le6tO-nJg8fCxJZEV30r1jJHfdCPqSPlj3ph_JzTricgopb9QAAAF87ZpXJg
        $code = 'cEIhXa3V1yKXJdKZRBDOh14rvWm47Sf0zpmo7Aopb1QAAAF87aKT_g';
        $data = [
            'grant_type' => 'authorization_code',
            'client_id' => '2be673b3baae9b7075d3d442ca0a0b09',
            'code' => $code,
        ];

        $response = $client->post('https://kauth.kakao.com/oauth/token', [
            'header' => [
                'Content-Type' => 'application/x-www-form-urlencoded'
            ],
            'body' => json_encode($data)
        ]);
        dd($response->getBody()->getContents());
    }

    public function testSendMessage()
    {
        $client = new Client();
        $accessCode = '_Cv848ucG_soIF9n-LCg7Sy9C56VD96I6qwieworDNIAAAF8_VbSrw';
        $data = 'template_object=
            {
                "object_type": "text",
                "text": "IMAX 좌석이 생성 되었습니다.",
                "link": {
                },
                "button_title": "바로 확인"
            }';
        $response = $client->post('https://kapi.kakao.com/v2/api/talk/memo/default/send', [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Authorization' => 'Bearer '.$accessCode
            ],
            'body' => $data,
            // [1977384727]
            // { "object_type": "text", "text": "IMAX 좌석이 생성 되었습니다.", "link": { }, "button_title": "바로 확인" }
        ]);
        $result = json_decode($response->getBody()->getContents());
        dump($result);
        return $result;
    }

}
