const {assign} = lodash;
const {addFilter} = wp.hooks;
const {__} = wp.i18n;
const {createHigherOrderComponent} = wp.compose;
const {Fragment} = wp.element;
const {InspectorControls} = wp.editor;
const {PanelBody, SelectControl} = wp.components;

const enableSpacingControlOnBlocks = [
    'core/group',
];

const spacingControlOptions = [
    {
        label: __('None'),
        value: '',
    },
    {
        label: __('Small'),
        value: 'small',
    },
    {
        label: __('Medium'),
        value: 'medium',
    },
    {
        label: __('Large'),
        value: 'large',
    },
];

/**
 * Add spacing control attribute to block.
 *
 * @param {object} settings Current block settings.
 * @param {string} name Name of block.
 *
 * @returns {object} Modified block settings.
 */
const addSpacingControlAttribute = (settings, name) => {

    // Do nothing if it's another block than our defined ones.
    if (!enableSpacingControlOnBlocks.includes(name)) {
        return settings;
    }

    // Use Lodash's assign to gracefully handle if attributes are undefined
    settings.attributes = assign(settings.attributes, {
        spacing: {
            type: 'string',
            default: spacingControlOptions[0].value,
        },
    });

    return settings;
};

addFilter('blocks.registerBlockType', 'extend-block-example/attribute/spacing', addSpacingControlAttribute);


/**
 * Create HOC to add spacing control to inspector controls of block.
 */
const withSpacingControl = createHigherOrderComponent((BlockEdit) => {
    return (props) => {
        // Do nothing if it's another block than our defined ones.
        if (!enableSpacingControlOnBlocks.includes(props.name)) {
            return (
                <BlockEdit {...props} />
            );
        }

        const {spacing} = props.attributes;

        // add has-spacing-xy class to block
        if (spacing) {
            props.attributes.className = `has-spacing-${spacing}`;
        }

        return (
            <Fragment>
                <BlockEdit {...props} />
                <InspectorControls>
                    <PanelBody
                        title={__('Spacing')}
                        initialOpen={true}
                    >
                        <SelectControl
                            label={__('Spacing')}
                            value={spacing}
                            options={spacingControlOptions}
                            onChange={(selectedSpacingOption) => {
                                props.setAttributes({
                                    spacing: selectedSpacingOption,
                                });
                            }}
                        />
                    </PanelBody>
                </InspectorControls>
            </Fragment>
        );
    };
}, 'withSpacingControl');

addFilter('editor.BlockEdit', 'extend-block-example/with-spacing-control', withSpacingControl);
