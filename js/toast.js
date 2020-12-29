// setCookie("temp_user", "ahmad", 10);
let tmp = "";

var path = window.location.pathname;
var page = path.split("/").pop();

//taskStated taskUpdated taskDeleted taskInsert 

if(getCookie('taskStated'))
{
  tmp = getCookie("taskStated");
  tmp = tmp.replace("+", " ");
  tmp = tmp.replace("+", " ");
  tmp = tmp.replace("+", " ");
  tmp = tmp.replace("+", " ");
  M.toast({html: `<p style="font-size: 14px;">"${tmp}"</p>`, classes: 'green rounded', displayLength: 2000, width: 100});
}

if(getCookie('taskUpdated'))
{
  tmp = getCookie("taskUpdated");
  tmp = tmp.replace("+", " ");
  tmp = tmp.replace("+", " ");
  tmp = tmp.replace("+", " ");
  tmp = tmp.replace("+", " ");
  M.toast({html: `<p style="font-size: 14px;">${tmp}</p>`, classes: 'green rounded', displayLength: 3000, width: 100});
}

if(getCookie('taskDeleted'))
{
  tmp = getCookie("taskDeleted");
  tmp = tmp.replace("+", " ");
  tmp = tmp.replace("+", " ");
  tmp = tmp.replace("+", " ");
  tmp = tmp.replace("+", " ");
  M.toast({html: `<p style="font-size: 14px;">${tmp}</p>`, classes: 'green rounded', displayLength: 2000, width: 100});
}

if(getCookie('taskInsert'))
{
  tmp = getCookie("taskInsert");
  tmp = tmp.replace("+", " ");
  tmp = tmp.replace("+", " ");
  tmp = tmp.replace("+", " ");
  tmp = tmp.replace("+", " ");
  M.toast({html: `<p style="font-size: 14px;">${tmp}</p>`, classes: 'green rounded', displayLength: 2000, width: 100});
}

if(getCookie("temp_user") && page == "index.php")
{
  tmp = getCookie("temp_user");
  M.toast({html: `<p style="font-size: 14px;">User "${tmp}" Successfully Created! </p>`, classes: 'green rounded', displayLength: 5000, width: 100});
}

if(getCookie("logged_user") && page == "dashboard.php")
{
  tmp = getCookie("logged_user");
  M.toast({html: `<p style="font-size: 14px;">Welcome ${tmp}! </p>`, classes: 'materialize-red rounded', displayLength: 5000, width: 100});
}

if(getCookie("loggedout_user") && page == "index.php")
{
  tmp = getCookie("loggedout_user");
  M.toast({html: `<p style="font-size: 14px;">See You Soon ${tmp}! </p>`, classes: 'materialize-red rounded', displayLength: 5000, width: 100});
}

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