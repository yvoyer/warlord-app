<?php
/**
 * This file is part of the WarlordGame.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Bundle\WarlordGameBundle\Controller;

use Star\Bundle\WarlordGameBundle\Form\Game\NewGameType;
use Star\Bundle\WarlordGameBundle\Form\Game\QuitGameType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class GameController
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Bundle\WarlordGameBundle\Controller
 */
class GameController extends Controller
{
    /**
     * @Route("/", name="star_homepage")
     * @Template()
     */
    public function newAction()
    {
        $router = $this->container->get('router');

        // @todo When game not started, show form to start game.
        $gameType = new NewGameType($router);
        if ($this->get('session')->has('user')) {
            $gameType = new QuitGameType($router);
        }
        $form = $this->createForm($gameType);

        return array(
            'newGameForm' => $form->createView(),
        );
    }

    /**
     * @Route("/game/create", name="star_game_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        // @todo When game already created, show different message, and don't create
        // @todo Create a new session
        $this->get('session')->getFlashBag()->add('success', 'New game created.');
        $this->get('session')->set('user', uniqid());

        return $this->redirect($this->generateUrl('star_homepage'));
    }

    /**
     * @Route("/game/quit", name="star_game_quit")
     * @Method("POST")
     */
    public function quitAction(Request $request)
    {
        // @todo When game do not exists, show different message
        // @todo Flush the session
        $this->get('session')->getFlashBag()->add('success', 'You quited the game.');
        $this->get('session')->remove('user');

        return $this->redirect($this->generateUrl('star_homepage'));
    }
}
