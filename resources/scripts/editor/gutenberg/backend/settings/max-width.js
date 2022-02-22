const {assign} = lodash;
const {addFilter} = wp.hooks;
const {__} = wp.i18n;
const {createHigherOrderComponent} = wp.compose;
const {Fragment, useState, cloneElement} = wp.element;
const {InspectorControls} = wp.editor;
const {PanelBody, RangeControl, SelectControl} = wp.components;

const enableMaxWidthControlOnBlocks = ['core/paragraph', 'core/heading'];

/**
 * Create attributes
 */
addFilter('blocks.registerBlockType', 'jb/core-button', (props, name) => {
    if (!enableMaxWidthControlOnBlocks.includes(name)) {
        return props;
    }

    const attributes = {
        ...props.attributes, maxWidth: { // here is our new attribute
            type: 'integer', default: ''
        }, position: { // here is our new attribute
            type: 'string', default: ''
        },
    };

    return {...props, attributes};
});

/**
 * Gutenberg create MaxWidth in control panel
 */
const withMaxWidthControl = createHigherOrderComponent((BlockEdit) => {
    return (props) => {

        if (!enableMaxWidthControlOnBlocks.includes(props.name)) {
            return (<BlockEdit {...props} />);
        }

        const {maxWidth} = props.attributes;

        function setMaxWidth(value) {
            props.setAttributes({
                maxWidth: value
                // style: {
                //     ...props.attributes.style,
                //     typography: {
                //         fontSize: value + 'px',
                //     },
                // }
            });
        }

        const {position} = props.attributes;

        function setPosition(value) {
            props.setAttributes({
                position: value
            });
        }

        return (<Fragment>
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
        </Fragment>);
    };
}, 'withMaxWidthControl');

addFilter('editor.BlockEdit', 'extend-block-example/with-maxwidth-control', withMaxWidthControl);

/**
 * Gutenberg render block
 */
const withToolbarButtonProp = createHigherOrderComponent((BlockListBlock) => {
    return (props) => {

        // If current block is not allowed
        if (!enableMaxWidthControlOnBlocks.includes(props.name)) {
            return (<BlockListBlock {...props} />);
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
            return (<div style={divStyle}>
                <BlockListBlock {...props}/>
            </div>)
        } else {
            return <BlockListBlock {...props} />
        }
    };
}, 'withToolbarButtonProp');

wp.hooks.addFilter('editor.BlockListBlock', 'custom-attributes/with-toolbar-button-prop', withToolbarButtonProp);

/**
 * Save values
 */
addFilter('blocks.getSaveElement', 'jb/core-button', (element, block, attributes) => {

    if (!enableMaxWidthControlOnBlocks.includes(block.name)) {
        return element;
    }

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
        return (<div style={divStyle}>
            {element}
        </div>);
    }

    return element;
});
