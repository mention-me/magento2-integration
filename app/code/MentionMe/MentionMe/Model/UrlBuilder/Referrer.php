<?php
namespace MentionMe\MentionMe\Model\UrlBuilder;

use Magento\Sales\Model\Order;
use MentionMe\MentionMe\Model\UrlBuilder\AbstractUrlBuilder;

class Referrer extends AbstractUrlBuilder
{
    const API_METHOD = 'referreroffer';
    const SITUATION = 'postpurchase';

    /**
     * @return array
     */
    protected function _getParams()
    {
        /** @var Order $order */
        $order = $this->paramsHelper->getLastRealOrder();
        $customerGroupName = $this->paramsHelper->getCustomerGroupName($order->getCustomerGroupId());

        return [
            'firstname' => $order->getCustomerFirstname(),
            'surname' => $order->getCustomerLastname(),
            'email' => $order->getCustomerEmail(),
            'customer_id' => $order->getCustomerId(),
            'segment' => $customerGroupName,
            'order_number' => $order->getIncrementId(),
            'order_total' => $order->getSubtotal() - abs($order->getDiscountAmount()),
            'order_currency' => $order->getOrderCurrencyCode(),
            'coupon_code' => $order->getCouponCode(),
            'locale' => $this->paramsHelper->getLocale(),
            'situation' => self::SITUATION
        ];
    }
}
