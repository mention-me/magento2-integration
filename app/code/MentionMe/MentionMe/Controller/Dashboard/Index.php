<?php
namespace MentionMe\MentionMe\Controller\Dashboard;

use Magento\Customer\Controller\AbstractAccount;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\Page;
use Magento\Framework\Controller\Result\Redirect;
use MentionMe\MentionMe\Helper\Data as DataHelper;
use MentionMe\MentionMe\Model\UrlBuilder\Dashboard as UrlBuilder;

class Index extends AbstractAccount
{
    /** @var PageFactory */
    private $resultPageFactory;

    /** @var DataHelper */
    private $dataHelper;

    /** @var UrlBuilder */
    private $urlBuilder;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param DataHelper $dataHelper
     * @param UrlBuilder $dashboardUrlBuilder
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        DataHelper $dataHelper,
        UrlBuilder $urlBuilder
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->dataHelper = $dataHelper;
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * @return Redirect|Page
     */
    public function execute()
    {
        // Redirect to customer account if dashboard is disabled
        if ($this->dataHelper->getDashboardEnabled() === false) {
            $resultRedirect = $this->resultRedirectFactory->create();
            $resultRedirect->setPath('customer/account');
            return $resultRedirect;
        }

        $resultPage = $this->resultPageFactory->create();

        // Set page title
        $resultPage->getConfig()->getTitle()->set(__('Mention Me Dashboard'));

        // Add Dashboard javascript
        $resultPage->getConfig()->addRemotePageAsset(
            $this->urlBuilder->getUrl(),
            'js',
            ['attributes' => ['defer' => 'defer']]
        );

        return $resultPage;
    }
}
