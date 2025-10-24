const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const {
    InspectorControls,
    RichText,
    InnerBlocks,
    useBlockProps,
} = wp.blockEditor;
const { PanelBody, ToggleControl } = wp.components;

// Register Accordion parent block
registerBlockType('growtype/accordion-details', {
    apiVersion: 2,
    title: __('Accordion (Growtype)', 'growtype'),
    icon: 'editor-ul',
    category: 'layout',
    attributes: {
        singleOpen: {
            type: 'boolean',
            default: false,
        },
    },
    edit: ({ attributes, setAttributes }) => {
        const blockProps = useBlockProps();
        return (
            <>
                <InspectorControls>
                    <PanelBody title={__('Behavior', 'growtype')} initialOpen>
                        <ToggleControl
                            label={__('Allow only one open at a time', 'growtype')}
                            checked={attributes.singleOpen}
                            onChange={(value) => setAttributes({ singleOpen: value })}
                            help={__('Single-open: opening one Detail closes others.', 'growtype')}
                        />
                    </PanelBody>
                </InspectorControls>
                <div {...blockProps} data-single-open={attributes.singleOpen}>
                    <InnerBlocks
                        allowedBlocks={['growtype/detail-item']}
                        template={[['growtype/detail-item']]}
                    />
                </div>
            </>
        );
    },
    save: ({ attributes }) => {
        const blockProps = useBlockProps.save();
        return (
            <div {...blockProps} data-single-open={attributes.singleOpen}>
                <InnerBlocks.Content />
            </div>
        );
    },
});

// Register Detail Item child block
registerBlockType('growtype/detail-item', {
    apiVersion: 2,
    title: __('Detail Item', 'growtype'),
    icon: 'editor-expand',
    category: 'layout',
    parent: ['growtype/accordion-details'],
    supports: {
        html: false,
        anchor: true,
    },
    attributes: {
        summary: { type: 'string', source: 'text', selector: '.details-summary' },
        open: { type: 'boolean', default: false },
        anchor: { type: 'string' },
    },
    edit: ({ attributes, setAttributes }) => {
        const { summary, open, anchor } = attributes;
        // Always open in editor for easy editing
        const blockProps = useBlockProps({
            id: anchor || undefined,
            style: { /* Ensure it stays open in editor */ }
        });
        return (
            <>
                <InspectorControls>
                    <PanelBody title={__('Details Settings', 'growtype')} initialOpen>
                        <ToggleControl
                            label={__('Default open', 'growtype')}
                            checked={open}
                            onChange={(value) => setAttributes({ open: value })}
                            help={__('Controls whether this detail is open by default on the frontend.', 'growtype')}
                        />
                    </PanelBody>
                </InspectorControls>
                <details {...blockProps} open={true}>
                    <summary
                        onClick={(e) => {
                            // Prevent toggling in editor
                            e.preventDefault();
                            e.stopPropagation();
                        }}
                        style={{ cursor: 'default' }}
                    >
                        <RichText
                            tagName="span"
                            className="details-summary"
                            value={summary}
                            onChange={(value) => setAttributes({ summary: value })}
                            placeholder={__('Detail title...', 'growtype')}
                        />
                    </summary>
                    <div className="detail-content">
                        <InnerBlocks />
                    </div>
                </details>
            </>
        );
    },
    save: ({ attributes }) => {
        const { summary, open, anchor } = attributes;

        const blockProps = useBlockProps.save({
            ...(anchor && { id: anchor }),
            className: open ? 'wp-block-growtype-detail-item is-open' : 'wp-block-growtype-detail-item'
        });

        return (
            <div {...blockProps}>
                <div className="details-summary" role="button" tabIndex="0">
                    <RichText.Content tagName="span" value={summary} />
                </div>
                <div className="detail-content">
                    <InnerBlocks.Content />
                </div>
            </div>
        );
    }
});
