<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 *
 * @category  Class
 * @package   App\Controller
 * @author    Agence Dn'D <contact@dnd.fr>
 * @copyright 2018 Agence Dn'D
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      https://www.dnd.fr/
 *
 * @route(name="app_default_")
 */
class DefaultController extends AbstractController
{
    /**
     * @Route(name="index", path="/", methods={"GET"})
     */
    public function index()
    {
        return $this->render(
            'Default/index.html.twig'
        );
    }

    /**
     * @Route(name="lucky_number", path="/lucky/number", methods={"GET"})
    */
    public function number()
    {
       $number = random_int(0, 100);

       return $this->render(
           'Default/luckyNumber.html.twig',
           [
                'luckyNumber' => $number
           ]
       );
    }

    /**
     * @Route(name="say", path="/say/{name}", methods={"GET"})
     * @param string $name
     *
     * @return string
     */
    public function say($name = 'John')
    {
        $name = ucfirst($name);

        return $this->render(
            'Default/say.html.twig',
            [
                'name' => $name
            ]
        );
    }
}