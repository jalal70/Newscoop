<?php
/**
 * @package Newscoop
 * @copyright 2012 Sourcefabric o.p.s.
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */

namespace Newscoop\Image;

/**
 * Article Image
 * @Entity
 * @Table(name="ArticleImages")
 */
class ArticleImage implements ImageInterface
{
    /**
     * @Id @Column(type="integer", name="NrArticle")
     * @var int
     */
    private $articleNumber;

    /**
     * @Id @ManyToOne(targetEntity="Newscoop\Image\LocalImage", fetch="EAGER")
     * @JoinColumn(name="IdImage", referencedColumnName="Id")
     * @var Newscoop\Image\Image
     */
    private $image;

    /**
     * @Column(type="integer", name="Number")
     * @var int
     */
    private $number;

    /**
     * @param int $articleNumber
     * @param Newscoop\Image\LocalImage $image
     * @param int $number
     */
    public function __construct($articleNumber, LocalImage $image, $number = 1)
    {
        $this->articleNumber = (int) $articleNumber;
        $this->image = $image;
        $this->number = (int) $number;
    }

    /**
     * Get article number
     *
     * @return int
     */
    public function getArticleNumber()
    {
        return $this->articleNumber;
    }

    /**
     * Get image
     *
     * @return Newscoop\Image\Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Get image id
     *
     * @return int
     */
    public function getId()
    {
        return $this->image->getId();
    }

    /**
     * Get image path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->image->getPath();
    }

    /**
     * Get width
     *
     * @return int
     */
    public function getWidth()
    {
        return $this->image->getWidth();
    }

    /**
     * Get height
     *
     * @return int
     */
    public function getHeight()
    {
        return $this->image->getHeight();
    }
}
