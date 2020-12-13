/**
 * Block dependencies
 */
import icon from './icon';
import './editor.scss';
import './style.scss';

/**
 * Internal block libraries
 */
const {__} = wp.i18n;
const {registerBlockType} = wp.blocks;
const { serverSideRender: ServerSideRender } = wp;
const blockId = 'predicblocks/sports-odds-table';

registerBlockType(
  blockId,
  {
    title: __('Sports odds table', 'predic-blocks'),
    description: __('Shows odds for top 10 games of user’s choice from Live Sports Odds API.', 'predic-blocks'),
    icon: {
      background: '#fbb34b',
      src: icon
    },
    category: 'widgets',
    attributes: {},
    edit: ({ attributes }) => {
      return (
        <ServerSideRender
          block={blockId}
          attributes={attributes}
        />
      );
    }
    , // end edit
    save() {
      // Rendering in PHP
      return null;
    },
    example: {
      attributes: {
        'preview' : true
      }
    }
  });
