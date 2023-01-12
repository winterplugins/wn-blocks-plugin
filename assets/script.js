$(function () {
    let $activeBlockItem = null;
    let activeBlockId = null;

    $('.app-block-item').on('click', function (e) {
        e.preventDefault();
        $activeBlockItem = $(this);
        activeBlockId = $activeBlockItem.data('block-id');
        const $panel = $('.app-block-item-panel-' + activeBlockId);

        $activeBlockItem
            .attr('contenteditable', true)
            .addClass('app-block-item--active')
            .focus();
        $panel.addClass('app-block-item-panel--show');
    });
});