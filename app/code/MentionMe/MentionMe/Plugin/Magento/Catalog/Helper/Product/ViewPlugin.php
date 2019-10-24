<?php
namespace MentionMe\MentionMe\Plugin\Magento\Catalog\Helper\Product;

use Magento\Framework\View\Result\Page as ResultPage;
use Magento\Catalog\Helper\Product\View;
use Magento\Framework\View\LayoutInterface;
use MentionMe\MentionMe\Helper\Data as DataHelper;
use MentionMe\MentionMe\Model\UrlBuilder\ConversionMessage as UrlBuilder;
use MentionMe\MentionMe\Model\Config\Source\Integration\Conversion\ProductPosition;
use Psr\Log\LoggerInterface as PsrLogger;

class ViewPlugin
{
    /** @var DataHelper */
    private $dataHelper;

    /** @var UrlBuilder */
    private $urlBuilder;

    /** @var PsrLogger */
    private $logger;

    /**
     * @param DataHelper $dataHelper
     * @param UrlBuilder $urlBuilder
     * @param PsrLogger $logger
     */
    public function __construct(
        DataHelper $dataHelper,
        UrlBuilder $urlBuilder,
        PsrLogger $logger
    ) {
        $this->dataHelper = $dataHelper;
        $this->urlBuilder = $urlBuilder;
        $this->logger = $logger;
    }

    /**
     * This has to be an around plugin to allow access to function parameters in Magento before 2.2.x
     *
     * @param View $subject
     * @param callable $proceed
     * @param ResultPage $resultPage
     * @param $product
     * @param null $params
     * @return mixed
     */
    public function aroundInitProductLayout(
        View $subject,
        callable $proceed,
        ResultPage $resultPage,
        $product,
        $params = null
    ) {
        $result = $proceed($resultPage, $product, $params);

        // Only continue if this integration is enabled
        if ($this->dataHelper->getProductConversionMessageEnabled() == false) {
            return $result;
        }

        // Add the placeholder in to the layout if not being manually added
        if ($this->getPosition() != ProductPosition::POSITION_MANUAL) {
            $this->addPlaceholder($resultPage->getLayout());
        }

        // Add the script tag
        $this->addScript($resultPage);

        return $result;
    }

    /**
     * @param LayoutInterface $layout
     */
    private function addPlaceholder(LayoutInterface $layout)
    {
        try {
            $layout->addBlock(
                \Magento\Framework\View\Element\Template::class,
                'mentionme.product.conversion.placeholder',
                $this->getPosition()
            )->setTemplate(
                'MentionMe_MentionMe::placeholder.phtml'
            );
        } catch (\Exception $e) {
            $this->logger->critical($e, ['MentionMe Product View Plugin::addPlaceholder']);
        }
    }

    /**
     * @param ResultPage $resultPage
     */
    private function addScript(ResultPage $resultPage)
    {
        $resultPage->getConfig()->addRemotePageAsset(
            $this->urlBuilder->getUrl(['situation' => 'product']),
            'js',
            ['attributes' => ['defer' => 'defer']]
        );
    }

    /**
     * @return mixed
     */
    private function getPosition()
    {
        return $this->dataHelper->getProductConversionMessagePosition();
    }
}
