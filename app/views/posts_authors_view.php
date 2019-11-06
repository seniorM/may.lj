<script>
    function getAuthors() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '<?= url('/api/getauthors') ?>');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var authors = JSON.parse(xhr.response);
                var html = '<ul>';
                authors.forEach(function (author) {
                    html += '<li id="' + author.id + '" onclick="jqRequest(this)">' + author.login + '</li>';
                });
                html += '</ul>';
                document.getElementById('authors').innerHTML = html;
            } else {
                //TODO error action
            }
        };
        xhr.send();
    }
    function jqRequest(el) {
        console.log(el.id);
        $.getJSON('<?= url('/api/getauthorposts') ?>?id=' + el.id, function (posts) {
		console.log(posts);
        });
    }
</script>
<button type="button" onclick="getAuthors()">Get Authors</button>
<div id="authors"></div>

