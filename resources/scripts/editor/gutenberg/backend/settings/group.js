(function ($) {
    let addCustomClassToEmptyBlocksOnly = false;
    let addClassIfInputIsNotEmpty = false;

    function generateUniqueClassName() {
        let selectedBlockClientId = wp.data.select('core/block-editor').getSelectedBlockClientId();
        selectedBlockClientId = selectedBlockClientId.substring(0, 10).replace(/-/g, "");
        return 'wp-block-group-' + selectedBlockClientId;
    }

    function addCustomClassToGroupBlockInput() {
        let customClassName = generateUniqueClassName();
        let selectedBlockClientId = wp.data.select('core/block-editor').getSelectedBlockClientId();
        if (selectedBlockClientId) {
            let selectedBlock = wp.data.select('core/block-editor').getBlock(selectedBlockClientId);
            if (selectedBlock.name === 'core/group') {
                let classNames = selectedBlock.attributes.className || '';

                if (classNames !== '' && !addClassIfInputIsNotEmpty) {
                    return;
                }

                if (((addCustomClassToEmptyBlocksOnly && classNames === '') || (!addCustomClassToEmptyBlocksOnly)) && !classNames.split(/\s+/).includes(customClassName)) {
                    classNames += ' ' + customClassName;
                    wp.data.dispatch('core/block-editor').updateBlockAttributes(selectedBlockClientId, {
                        className: classNames.trim()
                    });

                    console.log('custom block class is added')
                }
            }
        }
    }

    wp.data.subscribe(function () {
        let selectedBlockClientId = wp.data.select('core/block-editor').getSelectedBlockClientId();
        if (selectedBlockClientId) {
            let selectedBlock = wp.data.select('core/block-editor').getBlock(selectedBlockClientId);
            if (selectedBlock && selectedBlock.name === 'core/group' && ((addCustomClassToEmptyBlocksOnly && selectedBlock.innerBlocks.length === 0) || (!addCustomClassToEmptyBlocksOnly))) {
                addCustomClassToGroupBlockInput();
            }
        }
    });
})(jQuery);
