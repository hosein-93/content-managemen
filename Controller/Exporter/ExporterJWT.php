<?php

namespace Controller\Exporter;

use Controller\Exporter\Exporter;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

final class ExporterJWT extends Exporter
{
        public function export()
        {
                $key = 'Create JWT Content';
                $payload = [
                        'iss' => 'Exporter : Hosein Abdollahpoor',      // صادر کننده
                        'aud' => 'Receiver : web crawling Goutte',      // موضوع
                        'iat' => time(),        // زمان ایجاد
                        'exp' => time() + 600000,       // زمان انقضا
                        'url' => "C:\xampp\htdocs\script.ac\Site-Management\Controller\Exporter\ExporterJWT.php",
                        'data' => $this->data,
                ];
                $jwt = JWT::encode($payload, $key, 'HS256');
                // $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
                $className = str_replace(__NAMESPACE__ . "\\", "", __CLASS__);
                $filePath =  $this->folderPath . "{$className}.json";
                $content = "key=Create JWT Content \t algoritme=HS256\n{$jwt}";
                is_dir($this->folderPath) ? true : mkdir($this->folderPath, 0777, false);
                file_put_contents($filePath, $content . PHP_EOL, FILE_USE_INCLUDE_PATH);
                // file_put_contents($filePath, $content . PHP_EOL, FILE_APPEND);
        }
}
