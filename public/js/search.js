  //retrieve the word from data in the file php
  function showHintCategory(str) 
  {
    if (str.length == 0) {
      document.getElementById("txtHint").innerHTML = "";
      document.getElementById("txtHint").style.border = "0px";
      return;
    } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("txtHint").innerHTML = this.responseText;
          document.getElementById("txtHint").style.border = "1px solid #A5ACB2";
          document.getElementById("txtHint").style.width = "170px";


        }
      };
     
      xmlhttp.open("GET","/category/search"+"?q="+str, true);
       //debugger;
       
      xmlhttp.send();
    }
  }
  function showHintPost(str) {
    if (str.length == 0) {
      document.getElementById("txtHint").innerHTML = "";
      document.getElementById("txtHint").style.border = "0px";
      return;
    } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("txtHint").innerHTML = this.responseText;
          document.getElementById("txtHint").style.border = "1px solid #A5ACB2";
          document.getElementById("txtHint").style.width = "170px";


        }
      };
     
      xmlhttp.open("GET","/post/search"+"?q="+str, true);
       //debugger;
       
      xmlhttp.send();
    }
  }