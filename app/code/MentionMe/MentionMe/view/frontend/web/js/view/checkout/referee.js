define([
    'uiComponent'
], function (Component) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'MentionMe_MentionMe/checkout/referee'
        },
        /**
         * Callback function for when the mentionMe component has been rendered on page.
         * At this point it is safe to call the refereefind script to action the component.
         */
        refereeComponentLoaded: function () {
            var element = document.createElement('script'),
                scriptTag = document.getElementsByTagName('script')[0];

            element.async = true;
            element.src = this.getRefereeUrl();
            scriptTag.parentNode.insertBefore(element, scriptTag);
        },
        /**
         * Get the customer's refereefind URL from component config
         * @see MentionMe\MentionMe\Block\LayoutProcessor\Checkout\Onepage::getComponent
         */
        getRefereeUrl: function () {
            return this.refereeIntegrationUrl;
        },
        /**
         * check if placeholder should be rendered or is manually placed
         * @see MentionMe\MentionMe\Block\LayoutProcessor\Checkout\Onepage::getComponent
         */
        placeholderEnabled: function () {
            return this.renderPlaceholder;
        },
    });
});
