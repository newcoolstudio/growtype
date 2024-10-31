import React from "react";

const {assign} = lodash;
const {addFilter} = wp.hooks;
const {__} = wp.i18n;
const {createHigherOrderComponent} = wp.compose;
const {Fragment, useState, cloneElement} = wp.element;
const {InspectorControls} = wp.blockEditor;
const {PanelBody, RangeControl, SelectControl, TextareaControl} = wp.components;

const enableCodeControlOnBlocks = ['core/group'];

/**
 * Create attributes
 */
function extendSettingsAttributes(settings, name) {
    if (!enableCodeControlOnBlocks.includes(name)) {
        return settings;
    }

    if (settings && settings.attributes) {
        let attributes = {
            ...settings.attributes,
            customStyles: {
                type: 'string', default: ''
            },
        };

        return {...settings, attributes};
    }

    return {...settings};
}

addFilter(
    'blocks.registerBlockType',
    'growtype-code-block-extension/attributes',
    extendSettingsAttributes
);

/**
 * Gutenberg create Code in control panel
 */
const createInspectorControls = createHigherOrderComponent((BlockEdit) => {
        return (props) => {

            if (!enableCodeControlOnBlocks.includes(props.name)) {
                return (
                    <Fragment>
                        <BlockEdit {...props} />
                    </Fragment>
                );
            }

            const {customStyles} = props.attributes;

            function setCustomStyles(value) {
                props.setAttributes({
                    customStyles: value
                });
            }

            return (
                <Fragment>
                    <BlockEdit {...props} />
                    <InspectorControls>
                        <PanelBody
                            title={__('Custom CSS (Growtype)')}
                            initialOpen={true}
                        >
                            <TextareaControl
                                label="CSS code"
                                value={customStyles}
                                onChange={(value) => setCustomStyles(value)}
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
    'growtype-code-block-extension/create-inspector-controls',
    createInspectorControls
);

/**
 * Gutenberg render block
 */
const addCustomWrapper = createHigherOrderComponent(
    (BlockListBlock) => {
        return (props) => {

            if (!enableCodeControlOnBlocks.includes(props.name)) {
                return (
                    <BlockListBlock
                        {...props} />
                );
            }

            const {attributes} = props;
            const {customStyles, position} = attributes;
            let divStyle = {};

            if (customStyles) {
                divStyle['customStyles'] = customStyles;
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
    'growtype-code-block-extension/add-custom-wrapper',
    addCustomWrapper
);
