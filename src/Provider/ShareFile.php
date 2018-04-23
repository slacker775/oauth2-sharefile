<?php

declare(strict_types=1);

namespace Fpdr\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use Psr\Http\Message\ResponseInterface;

class ShareFile extends AbstractProvider
{
    use BearerAuthorizationTrait;

    const PATH_TOKEN = '/oauth/token';

    /**
     *
     * {@inheritdoc}
     *
     * @see \League\OAuth2\Client\Provider\AbstractProvider::getBaseAccessTokenUrl()
     */
    public function getBaseAccessTokenUrl(array $params)
    {
        if(isset($params['baseUrl']))
            $baseUrl = $params['baseUrl'];
        else
            $baseUrl = 'secure.sharefile.com';
        
        return 'https://' . $baseUrl . self::PATH_TOKEN;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \League\OAuth2\Client\Provider\AbstractProvider::getBaseAuthorizationUrl()
     */
    public function getBaseAuthorizationUrl()
    {
        return 'https://secure.sharefile.com/oauth/authorize';
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \League\OAuth2\Client\Provider\AbstractProvider::getDefaultScopes()
     */
    protected function getDefaultScopes()
    {
        return [];
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \League\OAuth2\Client\Provider\AbstractProvider::checkResponse()
     */
    protected function checkResponse(ResponseInterface $response, $data)
    {
        if (isset($data['error'])) 
            throw new IdentityProviderException($data['error_description'], $response->getStatusCode(), $response);        
    }

    /**
     * 
     * {@inheritDoc}
     * @see \League\OAuth2\Client\Provider\AbstractProvider::getResourceOwnerDetailsUrl()
     */
    public function getResourceOwnerDetailsUrl(AccessToken $token)
    {
        return null;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \League\OAuth2\Client\Provider\AbstractProvider::createResourceOwner()
     */
    protected function createResourceOwner(array $response, AccessToken $token)
    {
        return null;
    }
}