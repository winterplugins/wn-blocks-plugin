$(function () {
    const block = {
        $node: null,
        $panel: null,
        id: null,
        haveChanges: false
    }

    function deactivateActiveBlock() {
        if (block.$node !== null) {
            block
                .$node
                .attr('contenteditable', false)
                .removeClass('app-block-item--active');
            block.$panel.removeClass('app-block-item-panel--show');
        }
        block.$node = null;
        block.id = null;
        block.haveChanges = false;
    }

    function restoreBlockContent(blockId) {
        $.request('block::onFetchBlockContent', {
            loading: $.wn.stripeLoadIndicator,
            data: {
                block_id: blockId
            }
        });
    }

    $('.app-block-item').on('click', function (e) {
        e.preventDefault();

        if (block.haveChanges) {
            if (confirm('Save changes before closing?')) {

            } else {
                restoreBlockContent(block.id);
            }
        }
        deactivateActiveBlock();

        block.$node = $(this);
        block.id = block.$node.data('block-id');
        block.$panel = $('.app-block-item-panel-' + block.id);
        block.haveChanges = false;

        block
            .$node
            .attr('contenteditable', true)
            .addClass('app-block-item--active')
            .focus()
            .on('input', () => {
                block.haveChanges = true;
            });
        block.$panel.addClass('app-block-item-panel--show');
    });
});