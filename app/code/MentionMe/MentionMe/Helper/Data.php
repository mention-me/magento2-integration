<?php
namespace MentionMe\MentionMe\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;
use MentionMe\MentionMe\Model\Config\Source\ApiMode;

class Data extends AbstractHelper
{
    const XML_PATH_ENABLED                      = 'mentionme_mentionme/general/enabled';
    const XML_PATH_API_MODE                     = 'mentionme_mentionme/general/api_mode';
    const XML_PATH_ACCOUNT_CODE                 = 'mentionme_mentionme/general/account_code';
    const XML_PATH_DASHBOARD_ENABLED            = 'mentionme_mentionme/dashboard/enabled';
    const XML_PATH_REFERRER_ENABLED             = 'mentionme_mentionme/referrer_integration/enabled';
    const XML_PATH_REFEREE_ENABLED              = 'mentionme_mentionme/referee_integration/enabled';
    const XML_PATH_REFEREE_POSITION             = 'mentionme_mentionme/referee_integration/position';
    const XML_PATH_PRODUCT_CONVERSION_ENABLED   = 'mentionme_mentionme/product_conversion_message/enabled';
    const XML_PATH_PRODUCT_CONVERSION_POSITION  = 'mentionme_mentionme/product_conversion_message/position';
    const XML_PATH_HOMEPAGE_CONVERSION_ENABLED  = 'mentionme_mentionme/homepage_conversion_message/enabled';
    const XML_PATH_HOMEPAGE_CONVERSION_POSITION = 'mentionme_mentionme/homepage_conversion_message/position';
    const XML_PATH_LANDING_PAGES_ENABLED        = 'mentionme_mentionme/landing_pages/enabled';

    const DEMO_API_BASE_URL = 'https://tag-demo.mention-me.com/api/v2';
    const LIVE_API_BASE_URL = 'https://tag.mention-me.com/api/v2';

    /**
     * @return string
     */
    public function getApiUrl()
    {
        $url = self::DEMO_API_BASE_URL;

        $apiMode = $this->scopeConfig->getValue(
            self::XML_PATH_API_MODE,
            ScopeInterface::SCOPE_STORE
        );

        if ($apiMode == ApiMode::LIVE) {
            $url = self::LIVE_API_BASE_URL;
        }

        return $url;
    }

    /**
     * @return mixed
     */
    public function getAccountCode()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_ACCOUNT_CODE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return bool
     */
    public function getIsEnabled()
    {
        if ($this->getAccountCode() === null) {
            return false;
        }

        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_ENABLED,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return bool
     */
    public function getDashboardEnabled()
    {
        return $this->getIsEnabled() &&
            $this->scopeConfig->isSetFlag(
                self::XML_PATH_DASHBOARD_ENABLED,
                ScopeInterface::SCOPE_STORE
            );
    }

    /**
     * @return bool
     */
    public function getReferrerEnabled()
    {
        return $this->getIsEnabled() &&
            $this->scopeConfig->isSetFlag(
                self::XML_PATH_REFERRER_ENABLED,
                ScopeInterface::SCOPE_STORE
            );
    }

    /**
     * @return bool
     */
    public function getRefereeEnabled()
    {
        return $this->getIsEnabled() &&
            $this->scopeConfig->isSetFlag(
                self::XML_PATH_REFEREE_ENABLED,
                ScopeInterface::SCOPE_STORE
            );
    }

    /**
     * @return bool
     */
    public function getLandingPagesEnabled()
    {
        return $this->getIsEnabled() &&
            $this->scopeConfig->isSetFlag(
                self::XML_PATH_LANDING_PAGES_ENABLED,
                ScopeInterface::SCOPE_STORE
            );
    }

    /**
     * @return bool
     */
    public function getProductConversionMessageEnabled()
    {
        return $this->getIsEnabled() &&
            $this->scopeConfig->isSetFlag(
                self::XML_PATH_PRODUCT_CONVERSION_ENABLED,
                ScopeInterface::SCOPE_STORE
            );
    }

    /**
     * @return bool
     */
    public function getHomepageConversionMessageEnabled()
    {
        return $this->getIsEnabled() &&
            $this->scopeConfig->isSetFlag(
                self::XML_PATH_HOMEPAGE_CONVERSION_ENABLED,
                ScopeInterface::SCOPE_STORE
            );
    }

    /**
     * @return mixed
     */
    public function getRefereeIntegrationPosition()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_REFEREE_POSITION,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return mixed
     */
    public function getProductConversionMessagePosition()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_PRODUCT_CONVERSION_POSITION,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return mixed
     */
    public function getHomepageConversionMessagePosition()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_HOMEPAGE_CONVERSION_POSITION,
            ScopeInterface::SCOPE_STORE
        );
    }
}
