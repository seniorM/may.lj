<script>
    function getAuthors() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '<?= url('/api/getauthors') ?>');
        xhr.onreadystatechange = function(){
        if (xhr.readyState === 4 && xhr.status === 200){
        alert(xhr.responseText);
        }
        };
	xhr.send();
    }
</script>
<button type="button" onclick="getAuthors()">Get Authors</button>
<div id="authors"></div>

