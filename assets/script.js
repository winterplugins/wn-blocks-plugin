$(function () {
    const block = {
        $node: null,
        $panel: null,
        $toolbar: null,
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
        block.$toolbar = null;
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

    function renderToolbar() {
        const $strong = $('<button type="button" class="app-block-item-panel__button"><strong>B</strong></button>');
        const $italic = $('<button type="button" class="app-block-item-panel__button"><i>I</i></button>');
        const $stroke = $('<button type="button" class="app-block-item-panel__button"><s>S</s></button>');

        $strong.on('click', function () {
            document.execCommand('bold', false, null);
        });
        $italic.on('click', function () {
            document.execCommand('italic', false, null);
        });
        $stroke.on('click', function () {
            document.execCommand('strikeThrough', false, null);
        });

        block.$toolbar.append($strong);
        block.$toolbar.append($italic);
        block.$toolbar.append($stroke);
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
                block.$toolbar = block.$panel.find('.app-block-item-panel__toolbar');
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
                renderToolbar();
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