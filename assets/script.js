$(function () {
    const editors = new Map();

    $('.app-block-item').on('click', function (e) {
        e.preventDefault();
        const $scope = $(this);
        const blockId = $scope.data('block-id');
        if (editors.has(blockId)) {
            return;
        }
        const $panel = $('.app-block-item-panel-' + blockId);

        $scope
            .attr('contenteditable', true)
            .addClass('app-block-item--active')
            .focus();
        $panel.addClass('app-block-item-panel--show');
    });
});