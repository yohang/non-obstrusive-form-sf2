<?php

namespace Yohang\Bundle\PetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Yohang\Bundle\PetBundle\Model\Book;
use Yohang\Bundle\PetBundle\Form\Type\BookType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index", requirements={"_method": "GET"})
     * @Template()
     */
    public function indexAction()
    {
        return array(
            'form' => $this->createForm(new BookType, $this->getBook())->createView(),
            'book' => $this->getBook()
        );
    }

    /**
     * @Route("/", name="post", requirements={"_method": "POST"})
     * @Template("YohangPetBundle:Default:index.html.twig")
     */
    public function postAction(Request $request)
    {
        $form = $this->createForm(new BookType, $this->getBook());
        $form->bind($request);
        if ($form->isValid()) {
            $this->setBook($form->getData());

            return $this->redirect($this->generateUrl('index'));
        }

        return array('form' => $form->createView(), 'book' => $this->getBook());
    }

    public function getBook()
    {
        if ($this->get('session')->has('book')) {
            return clone $this->get('session')->get('book');
        }
        return null;
    }

    public function setBook(Book $book)
    {
        $this->get('session')->set('book', $book);
    }
}
