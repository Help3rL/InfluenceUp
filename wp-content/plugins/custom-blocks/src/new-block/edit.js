import { TextControl, SelectControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

import { useBlockProps, InspectorControls, BlockControls } from '@wordpress/block-editor';
import { formatBold, formatItalic, link } from '@wordpress/icons';
import ServerSideRender from '@wordpress/server-side-render';

export default function Edit() {
    return (
        <p { ...useBlockProps() }>
            { __(
                'Copyright Date Block – hello from the editor!',
                'copyright-date-block-demo'
            ) }
        </p>
    );
}