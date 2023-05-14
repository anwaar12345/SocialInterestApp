import './bootstrap';

let btn = document.getElementById('loginBtn');
if(btn)
btn.addEventListener('click',function(e){
    e.preventDefault();
    let emailInput = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    let _token =  document.getElementsByTagName('meta')['csrf-token'].content;

    let url = "http://localhost/SocialInterestApp/public/local/api/v1/login";
    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': _token,
            'Content-Type': 'application/json',
            'accept': 'application/json'
        },
        body: JSON.stringify({
          email : emailInput,
          password : password
        })
      })
      .then((response) => response.json())
      .then(data => {
        if (data.errors) {
            // Display validation errors under the input fields
            if (data.errors.email) {
              const emailError = document.getElementById('email-error');
              emailError.innerHTML = data.errors.email[0];
            }
            if(!data.errors.email){
                document.getElementById('email-error').innerHTML = '';
            }

            if (data.errors.password) {
              const passwordError = document.getElementById('password-error');
              passwordError.innerHTML = data.errors.password[0];
            }
            if(!data.errors.password){
                document.getElementById('password-error').innerHTML = '';
            }

          } else {
            document.getElementById('email-error').innerHTML = '';
            document.getElementById('password-error').innerHTML = '';
            if(data.access_token){
                localStorage.setItem('access_token',data.access_token);
                window.location.href="http://localhost/SocialInterestApp/public/profile";        
            }
            if(data.message){
                alert(data.message);
            }
          }
      
      })
      .catch(error => console.log(error));
});
if(localStorage.getItem('access_token')){
    document.getElementById('login').style.visibility = "hidden";
    document.getElementById('register').style.visibility = "hidden";    
}
window.addEventListener('load',function(){
    let publicIndex = window.location.href.indexOf('public');
    if(window.location.href.substring(publicIndex) == "public/profile"){
        if(!localStorage.getItem('access_token')){
            window.location.href="http://localhost/SocialInterestApp/public/login"
        }
        let token = localStorage.getItem('access_token');
        let _token =  document.getElementsByTagName('meta')['csrf-token'].content;
        let url = 'http://localhost/SocialInterestApp/public/local/api/v1/profile';
        fetch(url, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': _token,
                'Content-Type': 'application/json',
                'accept': 'application/json',
                'Authorization': 'Bearer ' + token
            }
          })
          .then((response) => response.json())
          .then((data) => {
            let profile = document.getElementById("profile");
            let html = `<div class="container mt-3">
            <h2>${data.profile.first_name} ${data.profile.last_name}</h2>
            <p>interests: </br><u>
            ${data.profile.interests}
            </u></p>
            
            <div class="card" style="width:400px">
              <div class="card-body">
                <h4 class="card-title">John Doe</h4>
                <p class="card-text">Address: ${data.profile.address}</p>
                <a href="mailto:${data.profile.email}" class="btn btn-primary">Send Email</a>
              </div>
            </div>
            <br>`;
          profile.innerHTML = html;
          })   
    }
});

let logout = document.getElementById('logout');
if(logout)
logout.addEventListener('click',function(){
    let token = localStorage.getItem('access_token');
    let _token =  document.getElementsByTagName('meta')['csrf-token'].content;
    let url = 'http://localhost/SocialInterestApp/public/local/api/v1/account/logout';
    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': _token,
            'Content-Type': 'application/json',
            'accept': 'application/json',
            'Authorization': 'Bearer ' + token
        }
      })
      .then((response) => response.json())
      .then((data) => {
            alert(data.message);
            localStorage.removeItem("access_token");
            window.location.href="http://localhost/SocialInterestApp/public/login"
      })
      .catch(error => console.log(error));     
});