<?php

namespace App\Tests\Util;

use App\Service\ExternalRequest;
use PHPUnit\Framework\TestCase;

class ExternalRequestTest extends TestCase
{
  private $project_api_url = 'https://api.github.com/search/repositories?q=:php&sort=stars&order=desc&per_page=10';

    public function testPerformRequest()
    {
        $externalRequest =  new ExternalRequest();
        $result = $externalRequest->performRequest($this->project_api_url);

        try {
          $decoded_result = json_decode($result);
          $this->assertEquals(10, count($decoded_result->items));
        } catch (Exception $e) {
           
        }
    }
}