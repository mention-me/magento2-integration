<?php
namespace MentionMe\MentionMe\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class ApiMode implements ArrayInterface
{
    const DEMO = 'demo';
    const LIVE = 'live';

    public function toOptionArray()
    {
        $options = [
            ['value' => self::DEMO, 'label' => __('Demo')],
            ['value' => self::LIVE, 'label' => __('Live')],
        ];

        return $options;
    }
}
