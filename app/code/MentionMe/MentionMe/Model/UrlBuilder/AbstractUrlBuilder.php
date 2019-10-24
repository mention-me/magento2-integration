<?php
namespace MentionMe\MentionMe\Model\UrlBuilder;

use MentionMe\MentionMe\Helper\Data as DataHelper;
use MentionMe\MentionMe\Helper\Params as ParamsHelper;

abstract class AbstractUrlBuilder
{
    /** @var DataHelper */
    protected $dataHelper;

    /** @var ParamsHelper */
    protected $paramsHelper;

    /**
     * @param DataHelper $dataHelper
     * @param ParamsHelper $paramsHelper
     */
    public function __construct(
        DataHelper $dataHelper,
        ParamsHelper $paramsHelper
    ) {
        $this->dataHelper = $dataHelper;
        $this->paramsHelper = $paramsHelper;
    }

    /**
     * @param array $extraParams
     * @return string
     */
    public function getUrl($extraParams = [])
    {
        return sprintf(
            '%s?%s',
            $this->_getBaseUrl(),
            $this->getParams($extraParams)
        );
    }

    /**
     * @return string
     */
    protected function _getBaseUrl()
    {
        return sprintf(
            '%s/%s/%s',
            $this->dataHelper->getApiUrl(),
            static::API_METHOD,
            $this->dataHelper->getAccountCode()
        );
    }

    /**
     * @return array
     */
    protected function _getParams()
    {
        return [];
    }

    /**
     * @param array $extraParams
     * @return string
     */
    private function getParams($extraParams = [])
    {
        $params = $this->_getParams();
        $params['locale'] = $this->paramsHelper->getLocale();

        $allParams = array_merge($params, $extraParams);

        return http_build_query($allParams);
    }
}
