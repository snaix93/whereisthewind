<?php

namespace App\Actions;

use App\Models\CityWeather;
use App\Models\User;
use App\Models\UserWeather;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Laravel\Jetstream\Contracts\DeletesUsers;

class HowToDressAction implements DeletesUsers
{
    /**
     * Get weather info based on a city provided by a user
     */
    public function execute($currentWeather)
    {
        try{
            $apiKey = config('custom.open-ai');
            $url =  config('custom.open-ai-api');

//        TODO: Rewrite using Laravel`s Http::post ....
            $headers = array(
                "Authorization: Bearer {$apiKey}",
                "OpenAI-Organization: org-9rf26xtd3krWyhQX8bRdmP3r",
                "Content-Type: application/json"
            );

            // Define messages
            $messages = array();
            $message = array();
            $message["role"] = "user";
            $message["content"] = $currentWeather . " How to dress?";
            $messages[] = $message;

            // Define data
            $data = array();
            $data["model"] = "gpt-3.5-turbo";
            $data["messages"] = $messages;
            $data["max_tokens"] = 400;

            // init curl
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

            $result = curl_exec($curl);

            $decodedResponse = json_decode($result, true);

            //Todo: verify the presence of each array element, otherwise throw an error
            return $decodedResponse['choices'][0]['message']['content'];
        }catch (\Throwable $e){
            return 'Can`t generate data at the moment';
        }
    }
}
