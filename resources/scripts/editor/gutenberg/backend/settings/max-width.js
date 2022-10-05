const {assign} = lodash;
const {addFilter} = wp.hooks;
const {__} = wp.i18n;
const {createHigherOrderComponent} = wp.compose;
const {Fragment, useState, cloneElement} = wp.element;
const {InspectorControls} = wp.blockEditor;
const {PanelBody, RangeControl, SelectControl} = wp.components;

const enableMaxWidthControlOnBlocks = ['core/paragraph', 'core/heading', 'core/image', 'core/group'];

console.log('sitas suveike labai gerai')

/**
 * Create attributes
 */
function addListBlockClassName(settings, name) {
    console.log('addListBlockClassName')

    if (!enableMaxWidthControlOnBlocks.includes(name)) {
        return settings;
    }

    const attributes = {
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

addFilter(
    'blocks.registerBlockType',
    'growtype-maxwidth/class-names/list-block',
    addListBlockClassName
);

/**
 * Gutenberg create MaxWidth in control panel
 */
const withInspectorControls = createHigherOrderComponent((BlockEdit) => {

        console.log('withInspectorControls')

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
    'withInspectorControls'
);

addFilter(
    'editor.BlockEdit',
    'growtype-maxwidth-block-extension/with-inspector-controls',
    withInspectorControls
);

/**
 * Gutenberg render block
 */
const withClientIdClassName = createHigherOrderComponent(
    (BlockListBlock) => {

        console.log('withClientIdClassName')

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

                console.log(maxWidth, 'maxWidth')

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
    'withClientIdClassName'
);

addFilter(
    'editor.BlockListBlock',
    'growtype-maxwidth-block-extension/with-client-id-class-name',
    withClientIdClassName
);
