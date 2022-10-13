<?php
namespace MentionMe\MentionMe\Model\UrlBuilder;

use MentionMe\MentionMe\Model\UrlBuilder\AbstractUrlBuilder;

class Dashboard extends AbstractUrlBuilder
{
    const API_METHOD = 'dashboard';
    const SITUATION = 'dashboard';

    /**
     * @return string
     */
    protected function _getBaseUrl()
    {
        return sprintf(
            '%s/%s/%s/%s',
            $this->dataHelper->getApiUrl(),
            static::API_METHOD,
            $this->dataHelper->getAccountCode(),
            urlencode($this->getCustomerEmail())
        );
    }

    /**
     * @return array
     */
    protected function _getParams()
    {
        return [
            'locale' => $this->paramsHelper->getLocale(),
            'situation' => self::SITUATION,
            'firstname' => $this->getCustomerFirstname(),
            'surname' => $this->getCustomerLastname(),
        ];
    }

    private function getCustomerEmail()
    {
        return $this->paramsHelper->getCurrentCustomer()->getEmail();
    }

    private function getCustomerFirstName()
    {
        return $this->paramsHelper->getCurrentCustomer()->getFirstname();
    }

    private function getCustomerLastName()
    {
        return $this->paramsHelper->getCurrentCustomer()->getLastname();
    }
}
