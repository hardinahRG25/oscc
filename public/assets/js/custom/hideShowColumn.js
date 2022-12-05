$('#edit').click(function () {
    var headers = $('#dt th').map(function () {
        var th = $(this);
        return {
            text: th.text(),
            shown: th.css('display') != 'none'
        };
    });
    var h = ['<div id="tableEditor"><button class="submit" id="btn-1">Done</button><table><thead><tr>'];
    $.each(headers, function () {
        h.push('<th><input type="checkbox"', (this.shown ? ' checked ' : ' '), '/> ', this.text, '</th>');
    });
    h.push('</tr></thead></table></div>');
    $('#containertable').append(h.join(''));

    $('.submit').click(function () {
        var showHeaders = $('#tableEditor input').map(function () {
            return this.checked;
        });
        $.each(showHeaders, function (i, show) {
            var cssIndex = i + 1;
            var tags = $('#dt th:nth-child(' + cssIndex + '), #dt td:nth-child(' + cssIndex + ')');
            if (show)
                tags.show();
            else
                tags.hide();



        });
        $('#tableEditor').remove();
        return false;
    });

    return false;
});

