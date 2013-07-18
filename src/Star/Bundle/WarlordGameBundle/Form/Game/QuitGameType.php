<?php
/**
 * This file is part of the WarlordGame.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Bundle\WarlordGameBundle\Form\Game;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class QuitGameType
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Bundle\WarlordGameBundle\Form\Game
 */
class QuitGameType extends AbstractType
{
    /**
     * @var \Symfony\Component\Routing\RouterInterface
     */
    private $router;

    /**
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quit_game', 'submit')
            ->setAction($this->router->generate('star_game_quit'));
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'star_game_quit';
    }
}
