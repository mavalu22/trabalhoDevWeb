document.getElementById('recipient').addEventListener('keyup', function () {
    let query = this.value;
    if (query.length > 2) {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', `index.php?action=searchRecipient&query=${query}`, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let recipientList = document.getElementById('recipientList');
                recipientList.innerHTML = xhr.responseText;
                recipientList.style.display = 'block';
            }
        };
        xhr.send();
    } else {
        document.getElementById('recipientList').style.display = 'none';
    }
});

function selectRecipient(name) {
    let selectedRecipients = document.getElementById('selectedRecipients');
    let recipientsInput = document.getElementById('recipientsInput');

    // Verifica se o destinatário já foi adicionado
    if (!recipientsInput.value.includes(name)) {
        // Adiciona o destinatário à div de destinatários selecionados
        let recipientTag = document.createElement('div');
        recipientTag.classList.add('recipient-tag');
        recipientTag.innerHTML = `${name} <span onclick="removeRecipient('${name}')">x</span>`;
        selectedRecipients.appendChild(recipientTag);

        // Adiciona o destinatário ao campo oculto (input)
        if (recipientsInput.value === '') {
            recipientsInput.value = name;
        } else {
            recipientsInput.value += `,${name}`;
        }
    }

    // Limpa o campo de input e esconde a lista de sugestões
    document.getElementById('recipient').value = '';
    document.getElementById('recipientList').style.display = 'none';
}

function removeRecipient(name) {
    let recipientsInput = document.getElementById('recipientsInput');
    let selectedRecipients = document.getElementById('selectedRecipients');

    // Remove o destinatário da lista visual
    let tags = selectedRecipients.getElementsByClassName('recipient-tag');
    for (let i = 0; i < tags.length; i++) {
        if (tags[i].textContent.includes(name)) {
            selectedRecipients.removeChild(tags[i]);
            break;
        }
    }

    // Remove o destinatário do campo oculto (input)
    let recipients = recipientsInput.value.split(',');
    recipients = recipients.filter(recipient => recipient !== name);
    recipientsInput.value = recipients.join(',');
}