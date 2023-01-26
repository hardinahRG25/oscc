
$(function () {
    $('#edit').click(function () {
        var headers = $('#dt th').map(function () {
            var th = $(this);
            return {
                text: th.text(),
                shown: th.css('display') != 'none'
            };
        });
        var h = ['<div id="tableEditor"><button type="submit" class="btn btn-secondary mt-3 submit">Choisir</button><ul>'];
        $.each(headers, function () {
            var checkedView = 'checked';
            h.push('<li><input type="checkbox"', (this.shown ? ' ' + checkedView + ' ' : ' '), ' /> ', this.text, '</li > ');
        });
        h.push('</ul></div>');
        $('#containertable').prepend(h.join(''));

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
});
