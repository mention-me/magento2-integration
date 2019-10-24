<?php
namespace MentionMe\MentionMe\Model\UrlBuilder;

use MentionMe\MentionMe\Model\UrlBuilder\AbstractUrlBuilder;

class Referee extends AbstractUrlBuilder
{
    const API_METHOD = 'refereefind';
    const SITUATION = 'checkout';

    /**
     * @return array|string
     */
    protected function _getParams()
    {
        return [
            'situation' => self::SITUATION
        ];
    }
}
