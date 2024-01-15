function get_messages(){
    fetch("./process/ajax/process_get_messages.php")
    .then((response)=>{
        // console.log(response);
        return response.json();
    }).then((messages)=>{
        const boxMessages = document.querySelector('#messages')
        const cookies= document.cookie.split("; ")
        let pseudoCookie = cookies[0].split('=')[1]
        // console.log(pseudoCookie)

        boxMessages.innerHTML = ""
        messages.forEach(message => {
            boxMessages.innerHTML += `
            <p class="${message.pseudo === pseudoCookie ?? "" ? 'text-end' : 'text-start'} ${message.pseudo === pseudoCookie ?? "" ? 'text-success' : 'text-danger'}">
                <span class="fst-italic">${message.created_at}</span>                
                <b>${message.pseudo} : </b>
                ${message.content}
            </p>
            
            `
        });


    })
}

setInterval(() => {
    get_messages()
}, 3000);




const form = document.querySelector('form')


form.addEventListener('submit', function(event){
    console.log(event);
    event.preventDefault()
    const pseudo = document.querySelector('#pseudo').value
    const message = document.querySelector('#message').value
    const adress_ip = document.querySelector('#adress_ip').value

    const formData = new FormData()
    formData.append('pseudo', pseudo)
    formData.append('message', message)
    formData.append('adress_ip', adress_ip)

    fetch('./process/process_add_user_message.php', {
        method:"POST",
        body: formData
    }).then((response)=>{
        return response.json();
    }).then((data)=>{
        console.log(data);
        if (data.status === 401) {
           return window.location.href = './login.php'
        }
    })
})