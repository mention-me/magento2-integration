<?php
namespace MentionMe\MentionMe\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Design\Theme\ThemeProviderInterface;
use Magento\Framework\View\Design\ThemeInterface;
use Magento\Framework\View\DesignInterface;
use Magento\Store\Model\ScopeInterface;

class Theme extends AbstractHelper
{
    const PAGE_LAYOUT_1COLUMN = '1column-center';
    const PAGE_LAYOUT_2COLUMNS_LEFT = '2columns-left';
    const PAGE_LAYOUT_2COLUMNS_RIGHT = '2columns-right';
    const PAGE_LAYOUT_3COLUMNS = '3columns';

    /** @var ThemeProviderInterface */
    private $themeProvider;

    /**
     * @param Context $context
     * @param ThemeProviderInterface $themeProvider
     */
    public function __construct(
        Context $context,
        ThemeProviderInterface $themeProvider
    ) {
        parent::__construct($context);

        $this->themeProvider = $themeProvider;
    }

    /**
     * @return bool|ThemeInterface
     */
    public function getThemeForAdminContext()
    {
        try {
            $storeId = (int) $this->_getRequest()->getParam('store', false);
            $websiteId = (int) $this->_getRequest()->getParam('website', false);
        } catch (NoSuchEntityException $e) {
            return false;
        }

        if ($storeId) {
            $theme = $this->getThemeByStoreId($storeId);
        } elseif ($websiteId) {
            $theme = $this->getThemeByWebsiteId($websiteId);
        } else {
            $theme = $this->getDefaultTheme();
        }

        return $theme;
    }

    /**
     * @param $storeId
     * @return ThemeInterface
     */
    public function getThemeByStoreId($storeId)
    {
        $themeId = $this->scopeConfig->getValue(
            DesignInterface::XML_PATH_THEME_ID,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );

        return $this->themeProvider->getThemeById($themeId);
    }

    /**
     * @param $websiteId
     * @return ThemeInterface
     */
    public function getThemeByWebsiteId($websiteId)
    {
        $themeId = $this->scopeConfig->getValue(
            DesignInterface::XML_PATH_THEME_ID,
            ScopeInterface::SCOPE_WEBSITE,
            $websiteId
        );

        return $this->themeProvider->getThemeById($themeId);
    }

    /**
     * @param $websiteId
     * @return ThemeInterface
     */
    public function getDefaultTheme()
    {
        $themeId = $this->scopeConfig->getValue(
            DesignInterface::XML_PATH_THEME_ID
        );

        return $this->themeProvider->getThemeById($themeId);
    }

    /**
     * Retrieve page layouts
     *
     * @return array
     */
    public function getPageLayouts()
    {
        return [
            self::PAGE_LAYOUT_1COLUMN,
            self::PAGE_LAYOUT_2COLUMNS_LEFT,
            self::PAGE_LAYOUT_2COLUMNS_RIGHT,
            self::PAGE_LAYOUT_3COLUMNS,
        ];
    }
}
