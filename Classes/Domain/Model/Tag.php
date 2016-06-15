<?php

/**
 * Tag
 */

namespace HDNET\Tagger\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Tag
 *
 * @db
 */
class Tag extends AbstractEntity
{

    /**
     * Title
     *
     * @var string
     * @db
     */
    protected $title;

    /**
     * Slug
     *
     * @var string
     * @db
     */
    protected $slug;

    /**
     * Link
     *
     * @var string
     * @db
     */
    protected $link;

    /**
     * Valuation
     *
     * @var float
     * @db
     */
    protected $valuation;

    /**
     * Content
     *
     * @var string
     * @db
     */
    protected $content;

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        if (trim($this->link) == '') {
            return false;
        }
        return $this->link;
    }

    /**
     * Get valuation
     *
     * @return float
     */
    public function getValuation()
    {
        return (float)$this->valuation;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Set link
     *
     * @param string $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * Set valuation
     *
     * @param float $valuation
     */
    public function setValuation($valuation)
    {
        $this->valuation = $valuation;
    }

    /**
     * Set content
     *
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Get the real valuation for the tag cloud generator
     *
     * @return integer
     */
    public function getValuationSize()
    {
        return rand(8, 30);
    }
}
