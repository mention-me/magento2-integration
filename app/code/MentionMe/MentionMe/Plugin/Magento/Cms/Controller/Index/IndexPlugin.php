<?php
namespace MentionMe\MentionMe\Plugin\Magento\Cms\Controller\Index;

use Magento\Framework\View\Result\Page as ResultPage;
use Magento\Cms\Controller\Index\Index;
use Magento\Framework\View\LayoutInterface;
use MentionMe\MentionMe\Helper\Data as DataHelper;
use MentionMe\MentionMe\Model\UrlBuilder\ConversionMessage as UrlBuilder;
use MentionMe\MentionMe\Model\Config\Source\Integration\Conversion\CMSPosition;
use Psr\Log\LoggerInterface as PsrLogger;

class IndexPlugin
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
     * @param Index $subject
     * @param $result
     * @return mixed
     */
    public function afterExecute(Index $subject, $result)
    {
        // Prevent adding placeholder to non CMS page result
        if (!$result instanceof \Magento\Framework\View\Result\Page) {
            return $result;
        }

        // Only continue if this integration is enabled
        if ($this->dataHelper->getHomepageConversionMessageEnabled() == false) {
            return $result;
        }

        // Add the placeholder in to the layout if not being manually added
        if ($this->getPosition() != CMSPosition::POSITION_MANUAL) {
            $this->addPlaceholder($result->getLayout());
        }

        // Add the script tag
        $this->addScript($result);

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
                'mentionme.homepage.conversion.placeholder',
                $this->getPosition()
            )->setTemplate(
                'MentionMe_MentionMe::placeholder.phtml'
            );
        } catch (\Exception $e) {
            $this->logger->critical($e, ['MentionMe CMS Index Plugin::addPlaceholder']);
        }
    }

    /**
     * @param ResultPage $resultPage
     */
    private function addScript(ResultPage $resultPage)
    {
        $resultPage->getConfig()->addRemotePageAsset(
            $this->urlBuilder->getUrl(['situation' => 'homepage']),
            'js',
            ['attributes' => ['defer' => 'defer']]
        );
    }

    /**
     * @return mixed
     */
    private function getPosition()
    {
        return $this->dataHelper->getHomepageConversionMessagePosition();
    }
}
