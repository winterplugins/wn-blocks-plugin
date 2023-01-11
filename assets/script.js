$(function () {
    const editors = new Map();

    $('.app-block-item').on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        const $scope = $(this);
        const blockId = $scope.data('block-id');
        if (editors.has(blockId)) {
            return;
        }
        const $panel = $('.app-block-item-panel-' + blockId);

        $scope.attr('contenteditable', true);
        $panel.addClass('app-block-item-panel--show');
    });
});