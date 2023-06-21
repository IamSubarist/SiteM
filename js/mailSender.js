const form = document.forms[0] // нашли форму
form.addEventListener('submit', (e) => { // добавляем своего слушателя события отправки формы
    e.preventDefault() // отменяем стандартную отправку формы с перезагрузкйо страницы
    const userData = new FormData() // создаём обэект отправки формы
    Array.from(form).forEach((el) => {  // тут записываем в объект данные с формы (начало)
        if (el.name && el.value !== '') {
            userData.append([el.name], el.value)
        }
    }) // (конец) с каждого поля если оно не заполнено или не имеет name атрибута то не записываем 
    fetch("php/mail.php", {  // отправляем данные на сервер 
            method: "POST",
            body: userData
        })
        .then(response => { // получаем ответ 
            if (response.status !== 201 && response.status !== 403) { // если всё норм расшифровываем его
                return Promise.reject();
            }
            return response.json();
        })
    .then(function (data) {
            alert(data.message) // и выводим сооющение что прислал севрер
        })
        .catch((e) =>
            console.log('ошибка сервера')); // это если что с сервером сломалось технический вывод
});
