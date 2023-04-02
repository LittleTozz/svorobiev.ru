// Находим все родительские элементы <code>
const parentCodeBlocks = document.querySelectorAll('code');

// Проходим по каждому элементу и добавляем кнопку "Копировать"
for (let i = 0; i < parentCodeBlocks.length; i++) {
  const parentCodeBlock = parentCodeBlocks[i].parentNode;

  // Создаем кнопку "Копировать"
  const copyButton = document.createElement('button');
  copyButton.innerHTML = '<img src="../assets/img/icons/copy.png" alt="Скопировать" loading="lazy">';
  copyButton.classList.add('copy-button');

  // Добавляем обработчик клика на кнопку
  copyButton.addEventListener('click', () => {
    // Находим элемент <code> внутри родительского элемента
    const codeBlock = parentCodeBlock.querySelector('code');

    // Создаем временный элемент textarea для копирования текста
    const textarea = document.createElement('textarea');
    textarea.value = codeBlock.innerText;
    document.body.appendChild(textarea);
    textarea.select();
    document.execCommand('copy');
    document.body.removeChild(textarea);
    
    // Выводим сообщение об успешном копировании
    const toastMessage = document.createElement('div');
    toastMessage.innerText = 'Скопирован';
    toastMessage.classList.add('toast-message');
    copyButton.appendChild(toastMessage);
    setTimeout(() => {
        copyButton.removeChild(toastMessage);
    }, 1000);
  });

  // Добавляем кнопку "Копировать" в родительский элемент <code>
  parentCodeBlock.appendChild(copyButton);
}

// Получаем все элементы <p> на странице
const paragraphs = document.getElementsByTagName('p');

// Проходим по каждому элементу <p>
for (let i = 0; i < paragraphs.length; i++) {
  const paragraph = paragraphs[i];

  // Проверяем, есть ли дочерний элемент с тегом <code>
  const codeElements = paragraph.getElementsByTagName('code');
  if (codeElements.length > 0) {

    // Добавляем класс ".code-box"
    paragraph.classList.add('code-box');
  }
}
