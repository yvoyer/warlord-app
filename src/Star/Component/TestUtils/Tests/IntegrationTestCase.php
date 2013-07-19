<?php
/**
 * This file is part of the WarlordGame.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\TestUtils\Tests;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class IntegrationTestCase
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Component\TestUtils\Tests
 */
class IntegrationTestCase extends WebTestCase
{
    /**
     * @var Client
     */
    private $client;

    protected function setUp()
    {
        $this->client = self::createClient();
    }

    public function tearDown()
    {
        parent::tearDown();
        $this->client = null;
    }

    /**
     * @throws \RuntimeException
     * @return Client
     */
    protected function getClient()
    {
        if (null === $this->client) {
            throw new \RuntimeException('The client is not set, did you override the setUp.');
        }

        return $this->client;
    }

    /**
     * @return \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected function getContainer()
    {
        return $this->getClient()->getContainer();
    }

    /**
     * @return null|\Symfony\Component\DomCrawler\Crawler
     */
    protected function getCrawler()
    {
        return $this->getClient()->getCrawler();
    }

    /**
     * @param string $service
     *
     * @return object
     */
    protected function getService($service)
    {
        return $this->getContainer()->get($service);
    }

    /**
     * @param string $route
     * @param array  $parameters
     * @param bool   $referenceType
     *
     * @return mixed
     */
    protected function generateUrl(
        $route,
        array $parameters = array(),
        $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH
    ) {
        return $this->getService('router')->generate($route, $parameters, $referenceType);
    }

    /**
     * Request the $uri
     *
     * @param string $uri
     * @param string $method
     * @param array  $parameters
     * @param array  $files
     * @param array  $server
     * @param null   $content
     * @param bool   $changeHistory
     *
     * @return \Symfony\Component\DomCrawler\Crawler
     */
    protected function request(
        $uri,
        $method = 'GET',
        array $parameters = array(),
        array $files = array(),
        array $server = array(),
        $content = null,
        $changeHistory = true
    ) {
        return $this->getClient()->request($method, $uri, $parameters, $files, $server, $content, $changeHistory);
    }
}
