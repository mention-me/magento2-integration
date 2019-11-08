<?php
namespace MentionMe\MentionMe\Model\Config\Source\Integration\Referee;

use Magento\Framework\Option\ArrayInterface;

class Position implements ArrayInterface
{
    const MANUAL                             = 'manual';
    const ABOVE_PROGRESS_BAR                 = 'above_progress_bar';
    const BELOW_PROGRESS_BAR                 = 'below_progress_bar';
    const BELOW_CHECKOUT_STEPS               = 'after_checkout_steps';
    const BEFORE_SIDEBAR                     = 'before_sidebar';
    const BEFORE_EMAIL_ADDRESS               = 'before_email_address';
    const BEFORE_LOGIN_BUTTON                = 'before_login_button';
    const BEFORE_SHIPPING_ADDRESS_FORM       = 'before_shipping_address_form';
    const AFTER_SHIPPING_ADDRESS_FORM        = 'after_shipping_address_form';
    const BEFORE_SHIPPING_METHOD_LIST        = 'before_shipping_method_list';
    const AFTER_SIDEBAR_SUMMARY_ITEMS        = 'after_sidebar_summary_items';
    const AFTER_SIDEBAR_SHIPPING_INFORMATION = 'after_sidebar_shipping_information';
    const BEFORE_PAYMENT_METHODS             = 'before_payment_methods';
    const AFTER_PAYMENT_METHODS_LIST         = 'after_payment_methods_list';
    const AFTER_PAYMENT_METHODS              = 'after_payment_methods';

    const POSTIONS = [
        self::MANUAL => ' I will choose where to place the tag manually',
        self::ABOVE_PROGRESS_BAR => 'Above Progress bar',
        self::BELOW_PROGRESS_BAR => 'Below Progress Bar',
        self::BEFORE_EMAIL_ADDRESS => 'Before Email Address',
        self::BEFORE_LOGIN_BUTTON => 'Before Login Button',
        self::BEFORE_SHIPPING_ADDRESS_FORM => 'Before Shipping Address Form',
        self::AFTER_SHIPPING_ADDRESS_FORM => 'After Shipping Address Form',
        self::BEFORE_SHIPPING_METHOD_LIST => 'Before Shipping Method List',
        self::BEFORE_PAYMENT_METHODS => 'Before Payment Methods',
        self::AFTER_PAYMENT_METHODS_LIST => 'After Payment Methods List',
        self::AFTER_PAYMENT_METHODS => 'After Discount Code',
        self::BEFORE_SIDEBAR => 'Before Sidebar',
        self::AFTER_SIDEBAR_SUMMARY_ITEMS => 'After Sidebar Summary Items',
        self::AFTER_SIDEBAR_SHIPPING_INFORMATION => 'After Sidebar Shipping Information',
        self::BELOW_CHECKOUT_STEPS => 'After Checkout Steps'
    ];

    public function toOptionArray()
    {
        $options = [];

        foreach (self::POSTIONS as $value => $label) {
            $options[] = [
                'value' => $value,
                'label' => $label
            ];
        }

        return $options;
    }
}
