<?php
declare(strict_types=1);
?>

<h1>Articles</h1>

<div id="elements"></div>

<script>
    let elementBlock = document.querySelector('#elements');

    if (elementBlock) {
        fetch('http://127.0.0.1/api/articles', {
            method: 'GET',
        }).then(response => {
            if (!response.ok) {
                throw response;
            }
            return response.json()
        })
            .then(response => {

                Object.keys(response).forEach(key => {
                    let elem = '<div>' + response[key].text + '</div>';
                    elementBlock.insertAdjacentHTML('beforeend', elem);
                });

            })
    }
</script>