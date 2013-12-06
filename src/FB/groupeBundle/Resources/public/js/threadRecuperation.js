
    var inter=new Array();
    var i=0;
    var conn;
    this.onmessage = function (event) {
    //URL=event.data;
    //ExecuterEncore(get(URL));

    if(event.data==="demarrer"){

        conn=new WebSocket('ws://www.fbgrpdonnees.com:8080');

        conn.onopen = function(e) {

                       };
        conn.onmessage = function(e) {
                          postMessage(e.data);
                          };
        conn.onclose  = function (e){
            postMessage(500);
        };
    } 
    else
        if(event.data==="arret"){
            for(i=0;i<inter.length;i++)
            clearInterval(inter[i]);

        }else
        {
         inter[i]=setInterval(function (){ conn.send(event.data);} ,50);
         i++;
        }



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