<?php
/**
 * TagTest
 */

namespace HDNET\Tagger\Tests\Unit\Domain\Model;

use HDNET\Tagger\Domain\Model\Tag;

/**
 * TagTest
 */
class TagTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{

    /**
     * @var Tag
     */
    protected $fileDomainModelInstance;

    /**
     * Setup
     *
     * @return void
     */
    protected function setUp()
    {
        $this->fileDomainModelInstance = new Tag();
    }

    /**
     * @test
     */
    public function titleCanBeSet()
    {
        $title = 'This is the title';
        $this->fileDomainModelInstance->setTitle($title);
        $this->assertEquals($title, $this->fileDomainModelInstance->getTitle());
    }
}
