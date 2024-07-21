const fromOpenBtn = document.querySelector("#form-open"),
 home = document.querySelector(".home"),
 formContainer =  document.querySelector(".form_container"),
 fromCloseBtn = document.querySelector(".form_close"),
 signupBtn = document.querySelector("#signup"),
 loginBtn = document.querySelector("#login"),
 PwShowHide = document.querySelectorAll(".pw_hide");

 fromOpenBtn.addEventListener("click", () => home.classList.add("show"));
 fromCloseBtn.addEventListener("click", () => home.classList.remove("show"));

 PwShowHide.forEach(icon => {
           
    icon.addEventListener("click", () => {
        let getPwInput = icon.parentElement.querySelector("input");
         
        if(getPwInput.type === "password"){
            getPwInput.type = "text";
            icon.classList.replace("uil-eye-slash", "uil-eye");
        }else{
            getPwInput.type = "password";
            icon.classList.replace("uil-eye", "uil-eye-slash");
        }
    });
 });

  
 signupBtn.addEventListener("click", (e) => {
    e.preventDefault();
    formContainer.classList.add("active");
 });

 loginBtn.addEventListener("click", (e) => {
    e.preventDefault();
    formContainer.classList.remove("active");
 });