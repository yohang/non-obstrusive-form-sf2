<?php

namespace Yohang\Bundle\PetBundle\Model;

use Symfony\Component\Validator\Constraints as Constraints;

/**
 * A book representation
 *
 * @author Yohan Giarelli <yohan@frequence-web.fr>
 */
class Book
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
     * @Constraints\NotBlank
     *
     * @var string
     */
    protected $author;

    /**
     * @Constraints\Valid
     *
     * @var array<Chapter>
     */
    protected $chapters = array();

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
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

    /**
     * @return array<Chapter>
     */
    public function getChapters()
    {
        return array_values($this->chapters);
    }

    /**
     * @param Chapter $chapter
     */
    public function addChapter(Chapter $chapter)
    {
        $this->chapters[] = $chapter;
        $this->chapters = array_values($this->chapters);
        $chapter->setBook($this);
    }

    /**
     * @param Chapter $chapter
     *
     * @return bool
     */
    public function removeChapter(Chapter $chapter)
    {
        foreach ($this->chapters as $key => $searchedChapter) {
            if ($searchedChapter->getId() === $chapter->getId()) {
                unset($this->chapters[$key]);

                return true;
            }
        }

        return false;
    }
}
