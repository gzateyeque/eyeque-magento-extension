<?php

namespace Emizentech\CustomSmtp\Block\Adminhtml\System\Config;

use \Magento\Framework\UrlInterface;

/**
 * "Reset to Defaults" button renderer
 *
 */
class TestButton extends \Magento\Config\Block\System\Config\Form\Field
{
    /** @var UrlInterface */
    protected $_urlBuilder;
    
    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
         UrlInterface $urlBuilder,
        array $data = []
    ) {
        $this->_urlBuilder = $urlBuilder;
        parent::__construct($context, $data);
    }

    /**
     * Set template
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('Emizentech_CustomSmtp::system/config/testbutton.phtml');
    }

    /**
     * Generate button html
     *
     * @return string
     */
    public function getButtonHtml()
    {
        $button = $this->getLayout()->createBlock(
            'Magento\Backend\Block\Widget\Button'
        )->setData(
            [
                'id' => 'emizentechcustomsmtp_debug_result_button',
                'label' => __('Send Test Email'),
                'onclick' => 'javascript:EmizentechCustomSmtpDebugTest(); return false;',
            ]
        );

        return $button->toHtml();
    }
    
    public function getAdminUrl(){
        return $this->_urlBuilder->getUrl('emizentechcustomsmtp/test', ['store' => $this->_request->getParam('store')]);
    }

    /**
     * Render button
     *
     * @param  \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    public function render(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        // Remove scope label
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();
        return parent::render($element);
    }

    /**
     * Return element html
     *
     * @param  \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        return $this->_toHtml();
    }
}