<?php

namespace MentionMe\MentionMe\Model\Config\Source\Integration\Conversion;

use Magento\Framework\Option\ArrayInterface;
use Magento\Framework\View\Element\Context;
use Magento\Framework\View\Layout\ProcessorFactory;
use Magento\Framework\View\Layout\ProcessorInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Store\Model\StoreManagerInterface;
use MentionMe\MentionMe\Helper\Theme as ThemeHelper;

class CMSPosition implements ArrayInterface
{
    const POSITION_MANUAL = 'manual';

    /** @var ProcessorFactory */
    private $layoutProcessorFactory;

    /** @var ThemeHelper */
    private $themeHelper;

    /**
     * @param ProcessorFactory $layoutProcessorFactory
     * @param ThemeHelper $themeHelper
     */
    public function __construct(
        ProcessorFactory $layoutProcessorFactory,
        ThemeHelper $themeHelper
    ) {
        $this->layoutProcessorFactory = $layoutProcessorFactory;
        $this->themeHelper = $themeHelper;
    }

    /**
     * Construct list of layout hooks available on homepage
     *
     * @see Magento\Widget\Block\Adminhtml\Widget\Instance\Edit\Chooser\Container
     *
     * @return array
     * @throws LocalizedException
     */
    private function getPositions()
    {
        $positions = [
            self::POSITION_MANUAL => __(' I will manually add the tag to my homepage'),
        ];

        $theme = $this->themeHelper->getThemeForAdminContext();

        // Return early if there was an issue with retrieveing the theme
        if ($theme == false) {
            return $positions;
        }

        $layoutMergeParams = ['theme' => $theme];

        /** @var $layoutProcessor ProcessorInterface */
        $layoutProcessor = $this->layoutProcessorFactory->create($layoutMergeParams);
        $layoutProcessor->addPageHandles(['cms_index_index']);
        $layoutProcessor->addPageHandles(['default']);
        $layoutProcessor->load();

        $pageLayoutProcessor = $this->layoutProcessorFactory->create($layoutMergeParams);
        $pageLayouts = $this->themeHelper->getPageLayouts();
        foreach ($pageLayouts as $pageLayout) {
            $pageLayoutProcessor->addHandle($pageLayout);
        }
        $pageLayoutProcessor->load();

        $containers = array_merge($pageLayoutProcessor->getContainers(), $layoutProcessor->getContainers());

        foreach ($containers as $containerName => $containerLabel) {
            $positions[$containerName] = ucwords($containerLabel);
        }

        asort($positions, SORT_STRING);

        return $positions;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = [];

        foreach ($this->getPositions() as $value => $label) {
            $options[] = [
                'value' => $value,
                'label' => $label
            ];
        }

        return $options;
    }
}
