<?php
/**
 * Relation view helper
 */

namespace HDNET\Tagger\ViewHelpers;

use HDNET\Tagger\Domain\Model\Tag;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * RelationViewHelper
 */
class RelationViewHelper extends AbstractViewHelper
{

    /**
     * Relation service
     *
     * @var \HDNET\Tagger\Service\RelationService
     * @inject
     */
    protected $relationService;

    /**
     * Return an array with the usage of the given tag
     *
     * @param Tag $tag
     *
     * @return array
     */
    public function render(Tag $tag)
    {
        return $this->relationService->getUsageByTag($tag);
    }
}
