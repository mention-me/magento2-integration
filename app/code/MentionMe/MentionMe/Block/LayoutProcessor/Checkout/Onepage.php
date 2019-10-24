<?php
namespace MentionMe\MentionMe\Block\LayoutProcessor\Checkout;

use Magento\Checkout\Block\Checkout\LayoutProcessorInterface;
use MentionMe\MentionMe\Model\Config\Source\Integration\Referee\Position;
use MentionMe\MentionMe\Helper\Data as DataHelper;
use MentionMe\MentionMe\Helper\Params as ParamsHelper;
use MentionMe\MentionMe\Model\UrlBuilder\Referee as UrlBuilder;

class Onepage implements LayoutProcessorInterface
{
    const COMPONENT_URI = 'MentionMe_MentionMe/js/view/checkout/referee';

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
     * Process js Layout of Checkout block to add Referee integration
     *
     * @param array $jsLayout
     * @return array
     */
    public function process($jsLayout)
    {
        // phpcs:disable Magento2.Files.LineLength.MaxExceeded
        switch ($this->dataHelper->getRefereeIntegrationPosition()) {
            case Position::ABOVE_PROGRESS_BAR:
                $path = 'components.checkout.children';
                $displayArea = 'authentication';
                break;
            case Position::BELOW_PROGRESS_BAR:
                $path = 'components.checkout.children';
                $displayArea = 'progressBar';
                break;
            case Position::BEFORE_EMAIL_ADDRESS:
                $path = 'components.checkout.children.steps.children.shipping-step.children.shippingAddress.children.customer-email.children';
                $displayArea = 'before-login-form';
                break;
            case Position::BEFORE_LOGIN_BUTTON:
                $path = 'components.checkout.children.steps.children.shipping-step.children.shippingAddress.children.customer-email.children';
                $displayArea = 'additional-login-form-fields';
                break;
            case Position::BEFORE_SHIPPING_ADDRESS_FORM:
                $path = 'components.checkout.children.steps.children.shipping-step.children.shippingAddress.children';
                $displayArea = 'before-form';
                break;
            case Position::AFTER_SHIPPING_ADDRESS_FORM:
                $path = 'components.checkout.children.steps.children.shipping-step.children.shippingAddress.children';
                $displayArea = 'additional-fieldsets';
                break;
            case Position::BEFORE_SHIPPING_METHOD_LIST:
                $path = 'components.checkout.children.steps.children.shipping-step.children.shippingAddress.children';
                $displayArea = 'before-shipping-method-form';
                break;
            case Position::BEFORE_PAYMENT_METHODS:
                $path = 'components.checkout.children.steps.children.billing-step.children.payment.children';
                $displayArea = 'beforeMethods';
                break;
            case Position::AFTER_PAYMENT_METHODS_LIST:
                $path = 'components.checkout.children.steps.children.billing-step.children.payment.children';
                $displayArea = 'payment-methods-list';
                break;
            case Position::AFTER_PAYMENT_METHODS:
                $path = 'components.checkout.children.steps.children.billing-step.children.payment.children';
                $displayArea = 'afterMethods';
                break;
            case Position::BEFORE_SIDEBAR:
                $path = 'components.checkout.children';
                $displayArea = 'sidebar';
                break;
            case Position::AFTER_SIDEBAR_SUMMARY_ITEMS:
                $path = 'components.checkout.children.sidebar.children.summary.children';
                $displayArea = 'totals';
                break;
            case Position::AFTER_SIDEBAR_SHIPPING_INFORMATION:
                $path = 'components.checkout.children.sidebar.children';
                $displayArea = 'shipping-information';
                break;
            case Position::BELOW_CHECKOUT_STEPS:
                $path = 'components.checkout.children';
                $displayArea = 'steps';
                break;
            case Position::MANUAL:
                $path = 'components.checkout.children';
                $displayArea = 'sidebar';
                break;
            default:
                $path = false;
                $displayArea = false;
                break;
        }
        // phpcs:enable Magento2.Files.LineLength.MaxExceeded

        if ($path && $displayArea) {
            $jsLayout = $this->addToLayout($jsLayout, $path, $displayArea);
        }

        return $jsLayout;
    }

    /**
     * @param $jsLayout
     * @param $path
     * @param $displayArea
     * @return array
     */
    private function addToLayout($jsLayout, $path, $displayArea)
    {
        $cloneLayout = &$jsLayout;
        foreach (explode(".", $path) as $key) {
            $cloneLayout = &$cloneLayout[$key];
        }

        // Add mention me component to the layout
        $cloneLayout['mention-me'] = $this->getComponent($displayArea);

        // Remove temporary clone
        unset($cloneLayout);

        return $jsLayout;
    }

    /**
     * @param $displayArea
     * @return array
     */
    private function getComponent($displayArea)
    {
        return [
            'component' => self::COMPONENT_URI,
            'displayArea' => $displayArea,
            'renderPlaceholder' => $this->dataHelper->getRefereeIntegrationPosition() != Position::MANUAL,
            'refereeIntegrationUrl' => $this->urlBuilder->getUrl(),
            'config' => [
                'deps' => [
                    'checkout.steps',
                    'checkout.errors',
                    'checkout.authentication',
                    'checkout.progressBar',
                    'checkout.estimation',
                    'checkout.sidebar'
                ]
            ]
        ];
    }
}
