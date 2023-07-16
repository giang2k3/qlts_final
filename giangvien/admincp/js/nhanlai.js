    window.onload = function() {
        const Studentid = document.querySelector("[name='student_id']");
        const message = document.querySelector("[name='message']");
        const success = document.querySelector("#success");
        const errorNodes = document.querySelector(".error");
        
        function validateForm() {
            if (Studentid.value.length < 1) {
                errorNodes[0].innerText = "Name cannot be blank";
                Studentid.classList.add("error-border");
                errorFlag = true;
            }
            if (message.value.length < 1) {
                errorNodes[0].innerText = "Name cannot be blank";
                message.classList.add("error-border");
                errorFlag = true;
            }
            if (!errorFlag) {
                success.innerText = "Success!";
            }
        }
        
        function clearMessage(){
            for(let i=0;i<errorNodes.length;i++){
                errorNodes[i].innerText="";
            }
            success.innerText = ";"
            Studentid.classList.remove("error-border");
            message.classList.remove("error-border");
        }
    };