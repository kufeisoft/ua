<?php
use kufeisoft\getos;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class UaTest extends TestCase {
  /**
    * @dataProvider uaProvider
  */
  public function testGetOs($ua, $result) {
    $this->assertEquals(
      $result,
      \kufeisoft\Ua::getOS($ua)
    );
  }

  public function uaProvider() {
    return [
      [
        'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36', 
        ['server' => 'Mac OS X', 'version' => '10.15.7']
      ],
      [
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36',
        ['server' => 'Windows', 'version' => '10 x64 Edition']
      ]
    ];
  }
}