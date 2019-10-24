<?php
namespace MentionMe\MentionMe\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use MentionMe\MentionMe\Helper\Data as DataHelper;
use MentionMe\MentionMe\Helper\Params as ParamsHelper;
use MentionMe\MentionMe\Model\UrlBuilder\LandingPage as UrlBuilder;

class LandingPage extends Template implements BlockInterface
{
    protected $_template = 'MentionMe_MentionMe::widget/landing-page.phtml';

    /** @var DataHelper */
    private $dataHelper;

    /** @var UrlBuilder */
    private $urlBuilder;

    public function __construct(
        Template\Context $context,
        DataHelper $dataHelper,
        UrlBuilder $urlBuilder,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->dataHelper = $dataHelper;
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->dataHelper->getLandingPagesEnabled();
    }

    /**
     * @return string
     */
    public function getLandingPageUrl()
    {
        return $this->urlBuilder->getUrl(['situation' => $this->getData('situation')]);
    }
}
