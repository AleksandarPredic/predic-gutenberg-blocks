/**
 * Block dependencies
 */
import icon from './icon';
import './style.scss';
import './editor.scss';

/**
 * Internal block libraries
 */
const {__} = wp.i18n;
const {registerBlockType} = wp.blocks;
const { serverSideRender: ServerSideRender } = wp;
const blockId = 'predicblocks/bet-calculator';

registerBlockType(
  blockId,
  {
    title: __('Bet calculator', 'predic-blocks'),
    description: __('Calculate how much a bet returns for any given stake.', 'predic-blocks'),
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
    }
  });
