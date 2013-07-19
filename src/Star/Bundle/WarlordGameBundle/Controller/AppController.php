<?php
/**
 * This file is part of the WarlordGame.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Bundle\WarlordGameBundle\Controller;

use Star\Component\TestUtils\Controller\StarController;

/**
 * Class AppController
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Bundle\WarlordGameBundle\Controller
 */
class AppController extends StarController
{
    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function redirectHome()
    {
        return $this->redirect($this->generateUrl('warlord.home'));
    }
}
