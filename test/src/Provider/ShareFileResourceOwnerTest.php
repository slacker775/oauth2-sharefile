<?php 
namespace Slacker775\OAuth2\Client\Test\Provider;

use Mockery as m;
use PHPUnit\Framework\TestCase;

class ShareFileResourceOwnerTest extends TestCase
{
    public function testUrlIsNullWithoutDomainOrNickname()
    {
        $user = new \Slacker775\OAuth2\Client\Provider\ShareFileResourceOwner();

        $url = $user->getUrl();

        $this->assertNull($url);
    }

    public function testUrlIsDomainWithoutNickname()
    {
        $domain = uniqid();
        $user = new \Slacker775\OAuth2\Client\Provider\ShareFileResourceOwner();
        $user->setDomain($domain);

        $url = $user->getUrl();

        $this->assertEquals($domain, $url);
    }

    public function testUrlIsNicknameWithoutDomain()
    {
        $nickname = uniqid();
        $user = new \Slacker775\OAuth2\Client\Provider\ShareFileResourceOwner(['login' => $nickname]);

        $url = $user->getUrl();

        $this->assertEquals($nickname, $url);
    }
}
