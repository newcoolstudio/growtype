const {__} = wp.i18n;
const {addFilter} = wp.hooks;
const {createHigherOrderComponent} = wp.compose;
const {Fragment, cloneElement} = wp.element;
const {InspectorControls} = wp.editor;
const {PanelBody, ToggleControl} = wp.components;

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
            target: {
                type: 'string',
                default: '',
                source: 'attribute',
                attribute: 'target',
                selector: 'a',
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
        const checked = '_blank' === attributes.target;

        return (
            <Fragment>
                <BlockEdit {...props} />
                <InspectorControls>
                    <PanelBody title={__('Link options')}>
                        <ToggleControl
                            label={__('New window')}
                            checked={checked}
                            onChange={() => setAttributes({target: checked ? '' : '_blank'})}
                            help={__('Open this link in a new window?')}
                        />
                    </PanelBody>
                </InspectorControls>
            </Fragment>
        );
    };
}, 'withInspectorControl');

addFilter('editor.BlockEdit', 'jb/core-button', withInspectorControls);

// Save.
addFilter(
    'blocks.getSaveElement',
    'jb/core-button',
    (element, block, attributes) => {
        if ('core/button' !== block.name) {
            return element;
        }

        if ('_blank' === attributes.target) {
            return cloneElement(
                element,
                {},
                cloneElement(element.props.children, {
                    target: '_blank',
                    rel: 'noreferrer noopener',
                })
            );
        }

        return element;
    }
);
