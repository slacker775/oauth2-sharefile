<?php

declare(strict_types=1);

namespace Slacker775\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Tool\ArrayAccessorTrait;

class ShareFileResourceOwner implements ResourceOwnerInterface
{

    use ArrayAccessorTrait;
    
    /**
     * Raw response
     *
     * @var array
     */
    protected $response;

    /**
     *
     * @var string
     */
    protected $domain;
    
    /**
     * 
     * @param array $response
     */
    public function __construct(array $response = [])
    {
        $this->response = $response;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \League\OAuth2\Client\Provider\ResourceOwnerInterface::getId()
     */
    public function getId()
    {
        return $this->getValueByKey($this->response, 'id');
    }

    public function getNickname() : ?string
    {
        return $this->getValueByKey($this->response, 'login');
    }
    
    public function getUrl() : ?string
    {
        $urlParts = array_filter([$this->domain, $this->getNickname()]);
        
        return count($urlParts) ? implode('/', $urlParts) : null;
    }
    
    public function setDomain(string $domain) : ResourceOwnerInterface
    {
        $this->domain = $domain;
        return $this;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \League\OAuth2\Client\Provider\ResourceOwnerInterface::toArray()
     */
    public function toArray()
    {
        return $this->response;
    }
}