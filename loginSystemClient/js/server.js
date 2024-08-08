var server = "http://localhost/loginAPI";
var saveBTN = document.getElementById('save-btn');
var loginBTN = document.getElementById('login_Btn');
var logoutBTN = document.getElementById('logout_btn');
//create


function saveData(){

    
    saveBTN.innerHTML = "Saving...";
    saveBTN.disabled = true;

    var userName = document.getElementById('uName').value;
    var firstName = document.getElementById('fName').value;
    var lastName = document.getElementById('lName').value;
   
    var email = document.getElementById('email').value;
 
    var password = document.getElementById('password').value;
 

    var formData = new FormData();

    formData.append('userName', userName);
    formData.append('firstName', firstName);
    formData.append('lastName', lastName);
    formData.append('password', password);
    formData.append('email', email);
   
    console.log(formData)

    var http = new XMLHttpRequest();

    http.onload = function(){
        saveBTN.innerHTML = "Save";
        saveBTN.disabled = false;
        console.log(http.response)
        var response = JSON.parse(http.response);
       
        var server_response = response.success;
        alert(server_response);
    }

    http.onerror = function(err){
        console.log(err);    
    }

    http.open('POST', server+'/index.php?function=save-data');
    http.send(formData);
}

// saveBTN.addEventListener("click", saveData)
function login(){
        loginBTN.innerHTML = "login...";
        loginBTN.disabled = true;
        var userName = document.getElementById('uName').value;
        var password = document.getElementById('password').value;

        var formData = new FormData();
        formData.append('userName', userName);
        formData.append('password', password);

        var http = new XMLHttpRequest();

        http.onload = function(){
        loginBTN.innerHTML = "Login";
        loginBTN.disabled = false;
        var response = JSON.parse(http.response);
        if(response.user){
        window.localStorage.setItem('user', JSON.stringify(response.user));
        // console.log('user', response.user.first_name)
        window.location.href = "dashbord.html";
        }
        if(response.error){
        alert(response.error);
        }
        }

        http.onerror = function(err){
        console.log(err);    
        }

        http.open('POST', server+'/index.php?function=login', true);
        http.send(formData);
}


function logout() {
       window.localStorage.removeItem('user');
        var http = new XMLHttpRequest();
        http.onload = function(){
            window.location.href = "./login.html";
        }
        
        http.onerror = function(err){
            console.log(err);    
        }

        http.open('GET', server+'/index.php?function=logout', true);
        http.send();
        


}
