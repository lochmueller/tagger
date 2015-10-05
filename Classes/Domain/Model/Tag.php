<?php

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Tim Lochmüller
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */
namespace HDNET\Tagger\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Class Tag
 *
 * @db
 */
class Tag extends AbstractEntity
{

    /**
     * @var string
     * @db
     */
    protected $title;

    /**
     * @var string
     * @db
     */
    protected $slug;

    /**
     * @var string
     * @db
     */
    protected $link;

    /**
     * @var float
     * @db
     */
    protected $valuation;

    /**
     * @var string
     * @db
     */
    protected $content;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
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
     * @return float
     */
    public function getValuation()
    {
        return (float)$this->valuation;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @param string $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * @param float $valuation
     */
    public function setValuation($valuation)
    {
        $this->valuation = $valuation;
    }

    /**
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