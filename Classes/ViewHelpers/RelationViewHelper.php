<?php

namespace HDNET\Tagger\ViewHelpers;

use HDNET\Tagger\Domain\Model\Tag;

class RelationViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * @var \HDNET\Tagger\Service\RelationService
     * @inject
     */
    protected $relationService;

    /**
     * @param Tag $tag
     *
     * @return string
     */
    public function render(Tag $tag)
    {
        return $this->relationService->getUsageByTag($tag);
    }
}
