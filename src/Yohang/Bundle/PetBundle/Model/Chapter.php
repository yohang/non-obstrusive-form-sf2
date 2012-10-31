<?php

namespace Yohang\Bundle\PetBundle\Model;

use Symfony\Component\Validator\Constraints as Constraints;

/**
 *
 *
 * @author Yohan Giarelli <yohan@frequence-web.fr>
 */
class Chapter
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @Constraints\NotBlank
     *
     * @var string
     */
    protected $name;

    /**
     * @var Book
     */
    protected $book;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param Book $book
     */
    public function setBook(Book $book)
    {
        $this->book = $book;
    }

    /**
     * @return Book
     */
    public function getBook()
    {
        return $this->book;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
