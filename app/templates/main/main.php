<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/app/css/style.css" type="text/css">
    <title>Document</title>
</head>
<body>

<h1>Сокращение cсылок</h1>
<div class="shorten_about">На этой странице вы можете сделать из длинной и сложной ссылки простую.<br>Такие ссылки
    удобнее использовать в ваших записях и сообщениях.
</div>

<div class="shorten_row shorten_form_row" id="shorten_row" style="">
    <div class="shorten_input " id="shorten_input_wrapper"
         style="">
        <input type="text" class="shortener_input" id="shorten_link"
               placeholder="Cсылка для сокращения">
    </div>
    <button class="F">
        <span class="button_short">Сократить</span>
    </button>
</div>
<div class="short_link d-none" ">
    <a href="123" class="link"></a>
</body>
<script>

    let submit = document.querySelector('.button_short')
    submit.addEventListener('click', function (event) {
        let inputValue = document.querySelector('.shortener_input').value;

        fetch('http://localhost/get_link/', {
            method: 'post',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(inputValue)
        })
            .then(response => response.json())
            .then(function (data) {
                document.querySelector('.link').href = data;
                document.querySelector('.link').text = data;
                document.querySelector('.short_link').classList.remove('d-none')
                document.querySelector('.short_link').classList.add('d-block')
            })
    });
</script>
</html>
