const {assign} = lodash;
const {addFilter} = wp.hooks;
const {__} = wp.i18n;
const {createHigherOrderComponent} = wp.compose;
const {Fragment} = wp.element;
const {InspectorControls} = wp.editor;
const {PanelBody, SelectControl, FormFileUpload} = wp.components;

const enableBackgroundControlOnBlocks = [
    'core/group',
];

/**
 * Add spacing control attribute to block.
 *
 * @param {object} settings Current block settings.
 * @param {string} name Name of block.
 *
 * @returns {object} Modified block settings.
 */
const addBackgroundControlAttribute = (settings, name) => {

    // Do nothing if it's another block than our defined ones.
    if (!enableBackgroundControlOnBlocks.includes(name)) {
        return settings;
    }

    // Use Lodash's assign to gracefully handle if attributes are undefined
    settings.attributes = assign(settings.attributes, {
        background: {
            type: 'string',
            default: '',
        },
    });

    return settings;
};

addFilter('blocks.registerBlockType', 'extend-block/attribute/background', addBackgroundControlAttribute);


/**
 * Create component
 */
const backgroundControl = createHigherOrderComponent((BlockEdit) => {
    return (props) => {
        // Do nothing if it's another block than our defined ones.
        if (!enableBackgroundControlOnBlocks.includes(props.name)) {
            return (
                <BlockEdit {...props} />
            );
        }

        const {background} = props.attributes;

        // add has-spacing-xy class to block
        if (background) {
            props.attributes.className = `has-spacing-${spacing}`;
        }

        return (
            <Fragment>
                <BlockEdit {...props} />
                <InspectorControls>
                    <PanelBody
                        title={__('Background')}
                        initialOpen={true}
                    >
                        <FormFileUpload
                            accept="image/*"
                            onChange={ () => console.log( 'new image' ) }
                        >
                            Upload
                        </FormFileUpload>
                    </PanelBody>
                </InspectorControls>
            </Fragment>
        );
    };
}, 'backgroundControl');

addFilter('editor.BlockEdit', 'extend-block/background-control', backgroundControl);
