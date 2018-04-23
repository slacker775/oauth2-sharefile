<?php 
namespace Fpdr\OAuth2\Client\Test\Provider;

use Mockery as m;

class ShareFileResourceOwnerTest extends \PHPUnit_Framework_TestCase
{
    public function testUrlIsNullWithoutDomainOrNickname()
    {
        $user = new \Fpdr\OAuth2\Client\Provider\ShareFileResourceOwner();

        $url = $user->getUrl();

        $this->assertNull($url);
    }

    public function testUrlIsDomainWithoutNickname()
    {
        $domain = uniqid();
        $user = new \Fpdr\OAuth2\Client\Provider\ShareFileResourceOwner();
        $user->setDomain($domain);

        $url = $user->getUrl();

        $this->assertEquals($domain, $url);
    }

    public function testUrlIsNicknameWithoutDomain()
    {
        $nickname = uniqid();
        $user = new \Fpdr\OAuth2\Client\Provider\ShareFileResourceOwner(['login' => $nickname]);

        $url = $user->getUrl();

        $this->assertEquals($nickname, $url);
    }
}
