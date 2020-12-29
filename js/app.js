let set = document.querySelectorAll('.SET');
let edit = document.querySelectorAll('.EDIT');
let del = document.querySelectorAll('.DEL');


set.forEach((item) => {
    item.addEventListener("click", function(){
        setCookie("tmpSet", `${this.id}`, 5)
    });
});

edit.forEach((item) => {
    item.addEventListener("click", function(){
        console.log(`${this.id}`)
        console.log("pressed!")
        setCookie("tmpEdit", `${this.id}`, 5)
    });
});

del.forEach((item) => {
    item.addEventListener("click", function(){
        setCookie("tmpDel", `${this.id}`, 5)
    });
});


function setCookie(cname, cvalue, sec) 
{
    var d = new Date();
    d.setTime(d.getTime() + sec*1000);//(exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }