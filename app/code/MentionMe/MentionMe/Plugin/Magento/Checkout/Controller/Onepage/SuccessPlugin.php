<?php
namespace MentionMe\MentionMe\Plugin\Magento\Checkout\Controller\Onepage;

use Magento\Framework\View\Result\Page as ResultPage;
use Magento\Checkout\Controller\Onepage\Success;
use Magento\Framework\View\LayoutInterface;
use MentionMe\MentionMe\Helper\Data as DataHelper;
use MentionMe\MentionMe\Model\UrlBuilder\Referrer as UrlBuilder;
use MentionMe\MentionMe\Model\Config\Source\Integration\Conversion\CMSPosition;

class SuccessPlugin
{
    /** @var DataHelper */
    private $dataHelper;

    /** @var UrlBuilder */
    private $urlBuilder;

    /**
     * @param DataHelper $dataHelper
     * @param UrlBuilder $urlBuilder
     */
    public function __construct(
        DataHelper $dataHelper,
        UrlBuilder $urlBuilder
    ) {
        $this->dataHelper = $dataHelper;
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * @param Index $subject
     * @param $result
     * @return mixed
     */
    public function afterExecute(Success $subject, $result)
    {
        // Only continue if this integration is enabled
        if ($this->dataHelper->getReferrerEnabled() == false) {
            return $result;
        }

        // Add the script tag
        $this->addScript($result);

        return $result;
    }

    /**
     * @param ResultPage $resultPage
     */
    private function addScript(ResultPage $resultPage)
    {
        $resultPage->getConfig()->addRemotePageAsset(
            $this->urlBuilder->getUrl(),
            'js',
            ['attributes' => ['defer' => 'defer']]
        );
    }
}
