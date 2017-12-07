window.ShareButton = require('better-share-button');
console.log('Share button');
new ShareButton({
    ui: {
        flyout: "bottom left",
        button_font: false,
        icon_font: false,
        buttonText: ''
    },
    networks: {
        pinterest: {
            enabled: false
        },
        googlePlus: {
            enabled: false
        },
        reddit: {
            enabled: false
        },
        linkedin: {
            enabled: false
        }
    }
});
