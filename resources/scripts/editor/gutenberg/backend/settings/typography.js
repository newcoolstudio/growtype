const {assign} = lodash;
const {addFilter} = wp.hooks;
const {__} = wp.i18n;
const {createHigherOrderComponent} = wp.compose;
const {Fragment} = wp.element;
const {InspectorControls, __experimentalUseCustomUnits} = wp.blockEditor;
const {PanelBody, FontSizePicker} = wp.components;

const enableOnBlocks = [
    'core/paragraph',
    'core/heading',
    'core/list',
    'core/list-item',
    'core/quote',
    'core/button',
    'core/code',
    'core/preformatted',
];

/**
 * Add mobile font size control attribute to block.
 *
 * @param {object} settings Current block settings.
 * @param {string} name Name of block.
 *
 * @returns {object} Modified block settings.
 */
const addResponsiveFontSizeControlAttribute = (settings, name) => {
    if (!enableOnBlocks.includes(name)) {
        return settings;
    }

    settings.attributes = assign(settings.attributes, {
        mobile_font_size: {
            type: 'string',
            default: '',
        },
    });

    return settings;
};

addFilter('blocks.registerBlockType', 'extend-block/attribute/responsive-font-size', addResponsiveFontSizeControlAttribute);

/**
 * Create responsive font size control component to be added to the existing Typography section.
 */
const responsiveFontSizeControl = createHigherOrderComponent((BlockEdit) => {
    return (props) => {
        if (!enableOnBlocks.includes(props.name)) {
            return <BlockEdit {...props} />;
        }

        const {mobile_font_size} = props.attributes;
        const {setAttributes} = props;

        const onChangeFontSize = (newFontSize) => {
            setAttributes({mobile_font_size: newFontSize});
        };

        // Define custom font size options
        const fontSizes = [
            {name: __('Small', 'your-text-domain'), slug: 'small', size: 12},
            {name: __('Medium', 'your-text-domain'), slug: 'medium', size: 16},
            {name: __('Large', 'your-text-domain'), slug: 'large', size: 24},
            {name: __('Extra Large', 'your-text-domain'), slug: 'extra-large', size: 36},
        ];

        return (
            <Fragment>
                <BlockEdit {...props} />
                <InspectorControls __experimentalGroup="styles">
                    <PanelBody
                        title={__('Typography - Mobile', 'growtype-post')}
                        initialOpen={true}
                    >
                        <FontSizePicker
                            value={mobile_font_size}
                            onChange={onChangeFontSize}
                            fontSizes={fontSizes}
                            __nextHasCustomFontSize
                            fallbackFontSize={16}
                            withSlider
                        />
                    </PanelBody>
                </InspectorControls>
            </Fragment>
        );
    };
}, 'responsiveFontSizeControl');

addFilter('editor.BlockEdit', 'extend-block/responsive-font-size-control', responsiveFontSizeControl);
