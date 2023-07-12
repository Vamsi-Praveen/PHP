function set_status(data){
    let xhr = new XMLHttpRequest();
    xhr.open("POST","home.php",true);
    xhr.onreadystatechange=function(){
        if(xhr.readyState==4 && xhr.status===200){
        
        }
    };
    xhr.send(data);
}
function ajax(){
    // alert("clicked");
    const txt = document.getElementById('txt');
    let xhr = new XMLHttpRequest();
    // xhr.onload = function(){
    //     txt.innerHTML=xhr.responseText;
    // };
    xhr.onreadystatechange=function(){
        if(xhr.readyState==4 && xhr.status===200){
            alert(
                "data sent"
            );
        }
    };
    xhr.open("POST","vamsi.txt",true);
    xhr.send();
}

function ajax_request(){
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(xhr.readyState==4 && xhr.status==200){
            //what work should be done
        }
    }
    xhr.open("POST","",true);
    xhr.send();
}


function make_admin(id){
    // const xhr = new XMLHttpRequest();
    // xhr.onreadystatechange=function(){
    //     if(xhr.status==200 && xhr.readyState==4){
    //         // alert("Success");
    //         // window.location.href="make_admin.php";
    //     }
    // }
    // xhr.open("POST","make_admin.php?id="+id,true);
    // xhr.send(data);  
    const data = id;
    alert(data);
}

const btn = document.getElementById("submit_btn");
btn.addEventListener('click',function(){
    alert("vamasi");
});