const {__} = wp.i18n;
const {addFilter} = wp.hooks;
const {createHigherOrderComponent} = wp.compose;
const {Fragment, cloneElement} = wp.element;
const {InspectorControls, InspectorAdvancedControls} = wp.blockEditor;
const {PanelBody, ToggleControl, TextControl} = wp.components;

// Attributes.
addFilter(
    'blocks.registerBlockType',
    'jb/core-button',
    (props, name) => {
        if ('core/button' !== name) {
            return props;
        }

        const attributes = {
            ...props.attributes,
            customAttributes: {
                type: 'string',
                default: '',
            },
        };

        return {...props, attributes};
    }
);

// Edit.
const withInspectorControls = createHigherOrderComponent((BlockEdit) => {
    return (props) => {
        if ('core/button' !== props.name) {
            return <BlockEdit {...props} />;
        }

        const {attributes, setAttributes} = props;

        return (
            <Fragment>
                <BlockEdit {...props} />
                <InspectorAdvancedControls>
                    <TextControl
                        label={__('Extra attributes', 'growtype')}
                        onChange={(val) => setAttributes({customAttributes: val})}
                        value={attributes.customAttributes}
                        help={__('Add extra attributes to element.', 'growtype')}
                    />
                </InspectorAdvancedControls>
            </Fragment>
        );
    };
}, 'withInspectorControl');

addFilter('editor.BlockEdit', 'jb/core-button', withInspectorControls);
