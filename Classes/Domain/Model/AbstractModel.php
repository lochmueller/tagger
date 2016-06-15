<?php

/**
 * Abstract model
 */

namespace HDNET\Tagger\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Class AbstractModel
 */
class AbstractModel extends AbstractEntity
{

    /**
     * To array
     *
     * @return array
     */
    public function toArray()
    {
        $vars = [];
        $objectVars = array_keys(get_object_vars($this));
        foreach ($objectVars as $var) {
            if (method_exists($this, 'get' . ucfirst($var))) {
                $vars[$var] = call_user_func([$this, 'get' . ucfirst($var)]);
            }
        }
        return $vars;
    }
}
