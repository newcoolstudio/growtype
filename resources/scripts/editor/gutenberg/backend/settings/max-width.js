const {assign} = lodash;
const {addFilter} = wp.hooks;
const {__} = wp.i18n;
const {createHigherOrderComponent} = wp.compose;
const {Fragment, useState, cloneElement} = wp.element;
const {InspectorControls} = wp.blockEditor;
const {PanelBody, RangeControl, SelectControl} = wp.components;

const enableMaxWidthControlOnBlocks = ['core/paragraph', 'core/heading', 'core/image', 'core/group'];

/**
 * Create attributes
 */
function extendSettingsAttributes(settings, name) {
    if (!enableMaxWidthControlOnBlocks.includes(name)) {
        return settings;
    }

    if (settings && settings.attributes) {
        let attributes = {
            ...settings.attributes,
            maxWidth: {
                type: 'integer', default: ''
            },
            position: {
                type: 'string', default: ''
            },
        };

        return {...settings, attributes};
    }

    return {...settings};
}

addFilter(
    'blocks.registerBlockType',
    'growtype-maxwidth-block-extension/attributes',
    extendSettingsAttributes
);

/**
 * Gutenberg create MaxWidth in control panel
 */
const createInspectorControls = createHigherOrderComponent((BlockEdit) => {
        return (props) => {

            if (!enableMaxWidthControlOnBlocks.includes(props.name)) {
                return (
                    <Fragment>
                        <BlockEdit {...props} />
                    </Fragment>
                );
            }

            const {maxWidth} = props.attributes;

            function setMaxWidth(value) {
                props.setAttributes({
                    maxWidth: value
                });
            }

            const {position} = props.attributes;

            function setPosition(value) {
                props.setAttributes({
                    position: value
                });
            }

            return (
                <Fragment>
                    <BlockEdit {...props} />
                    <InspectorControls>
                        <PanelBody
                            title={__('Growtype - Maximum width')}
                            initialOpen={true}
                        >
                            <RangeControl
                                label="Max width"
                                value={maxWidth}
                                allowReset
                                onChange={(value) => setMaxWidth(value)}
                                min={1}
                                max={2000}
                            />
                            <SelectControl
                                label={__('Select position:')}
                                value={position} // e.g: value = [ 'a', 'c' ]
                                onChange={(value) => {
                                    setPosition(value)
                                }}
                                options={[{value: '', label: 'Default', disabled: false}, {
                                    value: 'left', label: 'Left'
                                }, {value: 'auto', label: 'Center'}, {value: 'right', label: 'Right'},]}
                            />
                        </PanelBody>
                    </InspectorControls>
                </Fragment>
            );
        };
    },
    'createInspectorControls'
);

addFilter(
    'editor.BlockEdit',
    'growtype-maxwidth-block-extension/create-inspector-controls',
    createInspectorControls
);

/**
 * Gutenberg render block
 */
const addCustomWrapper = createHigherOrderComponent(
    (BlockListBlock) => {
        return (props) => {

            if (!enableMaxWidthControlOnBlocks.includes(props.name)) {
                return (
                    <BlockListBlock
                        {...props} />
                );
            }

            const {attributes} = props;
            const {maxWidth, position} = attributes;
            let divStyle = {};

            if (maxWidth) {
                divStyle['maxWidth'] = maxWidth;
            }

            if (position === 'auto') {
                divStyle['margin'] = position;
            } else if (position === 'left') {
                divStyle['marginRight'] = 'auto';
            } else if (position === 'right') {
                divStyle['marginLeft'] = 'auto';
            }

            if (Object.entries(divStyle).length !== 0) {
                return (
                    <div style={divStyle}>
                        <BlockListBlock {...props}/>
                    </div>
                )
            } else {
                return (
                    <BlockListBlock
                        {...props}
                    />
                )
            }
        };
    },
    'addCustomWrapper'
);

addFilter(
    'editor.BlockListBlock',
    'growtype-maxwidth-block-extension/add-custom-wrapper',
    addCustomWrapper
);
