<?php
namespace MentionMe\MentionMe\Plugin\Magento\Framework\View\Layout;

use Magento\Framework\View\Layout\ConfigCondition;
use MentionMe\MentionMe\Helper\Data as DataHelper;

class ConfigConditionPlugin
{
    /** @var DataHelper */
    private $dataHelper;

    /**
     * @param DataHelper $dataHelper
     */
    public function __construct(
        DataHelper $dataHelper
    ) {
        $this->dataHelper = $dataHelper;
    }

    /**
     * Plugin to facilitate general enable/disabled check if dashboard link can be shown in customer account.
     * This has to be an around plugin to allow access to function parameters in Magento before 2.2.x
     *
     * @param ConfigCondition $subject
     * @param callable $proceed
     * @param array $arguments
     * @return bool
     */
    public function aroundIsVisible(
        ConfigCondition $subject,
        callable $proceed,
        array $arguments
    ) {
        $result = $proceed($arguments);

        // Also check the general MentionMe enabled/disabled config if required
        if ($result && $arguments['configPath'] && $arguments['configPath'] == DataHelper::XML_PATH_DASHBOARD_ENABLED) {
            $result = $this->dataHelper->getIsEnabled();
        }

        return $result;
    }
}
