function get(url) {
  try {
    var xhr = new XMLHttpRequest();;
    xhr.open('GET', url, false);
    xhr.send();
    return xhr.responseText;
  } catch (e) {
    return 'Erreur'+e;; // turn all errors into empty results
  }
  }
  
function ExecuterEncore(data){
postMessage(data);
ExecuterEncore(get(URL)); 
}

this.onmessage = function (event) {
URL=event.data;
ExecuterEncore(get(URL));
};

/*
 * var thread = new Worker('threadRecuperation.js');
   function postDataToThread(donnes) {
     thread.postMessage(donnes);
   }
thread.onmessage = function (event) {
     var data = event.data 
     }
 */