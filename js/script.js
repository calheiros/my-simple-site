window.onload = getRequest();

function getRequest() {
   let url = "backend/server.php";
   let xhttp = new XMLHttpRequest();
   xhttp.onload = handler;         
   xhttp.open('GET', url, true);
   xhttp.send(null);
}

function handler() {
   try {
      if (this.status == 200) {
         var json = JSON.parse(this.responseText).data;
         buildView(json);
      }
   } catch(err) {
      errorHandler(err);
   }
}

function buildView(data) {
   var gridLayout = document.querySelector(".grid");
   
   for (var x in data) {
      var container = document.createElement("div");
      var image = document.createElement("img");
           
      image.style.backgroundImage = "url('" + data[x].src + "')";
      container.setAttribute("id", "image_item");
      container.appendChild(image);
      gridLayout.appendChild(container);
   }
}

function errorHandler(err) {
   var container = document.querySelector(".grid");
   container.innerHTML = "</br> <h4>há algo de errado! </br>😱 🤔</h4>";
   console.log(err);
}

