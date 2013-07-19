<?php
/**
 * This file is part of the WarlordGame.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Bundle\WarlordGameBundle\Tests\Integration\Controller;

use Star\Bundle\WarlordGameBundle\Controller\GameController;
use Star\Component\TestUtils\Tests\IntegrationTestCase;

/**
 * Class GameControllerTest
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Bundle\WarlordGameBundle\Tests\Integration\Controller
 */
class GameControllerTest extends IntegrationTestCase
{
    public function testShouldStartAGame()
    {
        $this->request('/');
        $form = $this->getCrawler()->selectButton('New game')->form();
        $this->getClient()->submit($form);
        $this->assertTrue($this->getClient()->getResponse()->isRedirect());
        $this->getClient()->followRedirect();
        $this->assertContains('New game created.', $this->getCrawler()->text());
    }

    public function testShouldQuitAStartedAGame()
    {
        $this->request($this->generateUrl(GameController::ACTION_GAME_CREATE), 'POST');
        $this->assertTrue($this->getClient()->getResponse()->isRedirect());
        $this->getClient()->followRedirect();

        $crawler = $this->getCrawler();
        $form    = $crawler->selectButton('Quit game')->form();

        $this->getClient()->submit($form);
        $this->assertTrue($this->getClient()->getResponse()->isRedirect());
        $this->getClient()->followRedirect();
        $this->assertContains('You quited the game.', $this->getCrawler()->text());
    }
}
