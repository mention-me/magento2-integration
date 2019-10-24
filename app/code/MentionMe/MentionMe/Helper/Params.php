<?php

namespace MentionMe\MentionMe\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\Locale\ResolverInterface;
use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Customer\Api\GroupRepositoryInterface;
use Magento\Sales\Model\Order;
use Magento\Customer\Helper\Session\CurrentCustomer;
use Magento\Customer\Api\Data\CustomerInterface;

class Params extends AbstractHelper
{
    /** @var ResolverInterface */
    private $localeResolver;

    /** @var CurrentCustomer */
    private $currentCustomer;

    /** @var GroupRepositoryInterface */
    private $groupRepository;

    /** @var CheckoutSession */
    private $checkoutSession;

    /**
     * @param ResolverInterface $localeResolver
     * @param CurrentCustomer $currentCustomer
     * @param GroupRepositoryInterface $groupRepository
     * @param CheckoutSession $checkoutSession
     */
    public function __construct(
        ResolverInterface $localeResolver,
        CurrentCustomer $currentCustomer,
        GroupRepositoryInterface $groupRepository,
        CheckoutSession $checkoutSession
    ) {
        $this->localeResolver = $localeResolver;
        $this->currentCustomer = $currentCustomer;
        $this->groupRepository = $groupRepository;
        $this->checkoutSession = $checkoutSession;
    }

    /**
     * @return CustomerInterface
     */
    public function getCurrentCustomer()
    {
        return $this->currentCustomer->getCustomer();
    }

    /**
     * @return Order
     */
    public function getLastRealOrder()
    {
        return $this->checkoutSession->getLastRealOrder();
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->localeResolver->getLocale();
    }

    /**
     * @param $customerGroupId
     * @return string
     */
    public function getCustomerGroupName($customerGroupId)
    {
        try {
            $customerGroup = $this->groupRepository->getById($customerGroupId);
            $customerGroupName = $customerGroup->getCode();
        } catch (\Exception $e) {
            $customerGroupName = 'none';
        }

        return $customerGroupName;
    }
}
