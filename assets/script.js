$(function () {
    const block = {
        $node: null,
        $panel: null,
        id: null,
        haveChanges: false
    };
    const messages = {
        saveBeforeClosing: 'Save changes before closing?'
    };

    function closeCurrentBlockWithoutSaving() {
        block
            .$node
            .attr('contenteditable', false)
            .removeClass('app-block-item--active');
        block.$panel.removeClass('app-block-item-panel--show');
        block.$node = null;
        block.id = null;
        block.haveChanges = false;
    }
    
    function closeCurrentBlock() {
        return new Promise((resolve) => {
            if (block.id === null) {
                return resolve();
            }
            if (!block.haveChanges) {
                closeCurrentBlockWithoutSaving()
                return resolve();
            }
            if (confirm(messages.saveBeforeClosing)) {
                return onSaveActiveBlockContent()
                    .then(() => {
                        closeCurrentBlockWithoutSaving();
                        resolve();
                    });
            } else {
                return restoreActiveBlockContent()
                    .then(() => {
                        closeCurrentBlockWithoutSaving();
                        resolve();
                    })
            }
        });
    }

    function restoreActiveBlockContent() {
        return new Promise((resolve) => {
            $.request('block::onFetchBlockContent', {
                loading: $.wn.stripeLoadIndicator,
                data: {
                    block_id: block.id
                }
            }).then(() => {
                resolve();
            });
        });
    }

    function onSaveActiveBlockContent() {
        return new Promise((resolve) => {
            $.request('block::onSaveBlockContent', {
                loading: $.wn.stripeLoadIndicator,
                data: {
                    block_id: block.id,
                    text: block.$node.html()
                }
            }).then((response) => {
                if (response.success) {
                    block.haveChanges = false;
                    resolve();
                }
            })
        });
    }

    $('.app-block-item').on('click', function (e) {
        e.preventDefault();
        const $node = $(this);
        if ($node.data('block-id') === block.id) {
            return;
        }
        closeCurrentBlock()
            .then(() => {
                block.$node = $node;
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

    $('.app-block-save').on('click', function (e) {
        e.preventDefault();
        onSaveActiveBlockContent()
            .then(() => {
                closeCurrentBlock();
            })
    });

    $('.app-block-close').on('click', function (e) {
        e.preventDefault();
        closeCurrentBlock();
    })
});