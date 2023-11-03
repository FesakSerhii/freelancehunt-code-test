<?php
class ApiClient {
    private $api_url = 'https://api.freelancehunt.com/v2/';
    private $token = '96b1f5ca360ac575f28d43b191cb256eb555d81a';
    private $cacheDir = __DIR__ .'../../../../bootstrap/cache/';

    public function get($endpoint) {
        return $this->makeRequest('GET', $endpoint);
    }

    private function makeRequest($method, $endpoint) {
//        if (!is_dir(__DIR__ .'../../../../bootstrap/cache')) {
//            mkdir(__DIR__ .'../../../../bootstrap/cache', 0755, true);
//        }
        $cacheFile = $this->cacheDir . md5($this->api_url . $endpoint);

        if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < 3600) {
            return json_decode(file_get_contents($cacheFile), true);
        }

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->api_url . $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->token
        ]);

        $response = curl_exec($ch);


        if($response === false){
            return ['error' => curl_error($ch)];
        } else {
            file_put_contents($cacheFile, $response);

            return json_decode($response, true);
        }
        curl_close($ch);
    }
}
