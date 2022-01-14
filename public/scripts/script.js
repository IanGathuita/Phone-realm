var login_tab = document.querySelector("#login-tab");
var register_tab = document.querySelector("#register-tab");
var login_form = document.querySelector("#login-form");
var register_form = document.querySelector("#register-form");

if(register_tab != null){
	register_tab.addEventListener('click',(e) => {
		login_form.style.display = "none";
		register_form.style.display = "block";
		login_tab.style.borderBottom = "0";
		register_tab.style.borderBottom="5px solid blue";
    });
}

if(login_tab != null){
	login_tab.addEventListener('click',(e) => {
		register_form.style.display = "none";
		login_form.style.display = "block";
		register_tab.style.borderBottom = "0";
		login_tab.style.borderBottom="5px solid blue";
    });
}


