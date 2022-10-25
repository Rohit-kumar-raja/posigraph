<html>
<head>
    
    <meta http-equiv="content-type" charset="utf-8">
    <script>
    var V;
    function onVidyoClientLoaded(status)
        {
            console.log("load : "+status.state);
            if(status.state=="READY")
                {
                    
                    
                     console.log("log load : "+status.state);

            VC.CreateVidyoConnector({
                
                      viewId: "render",                            // Div ID where the composited video will be rendered, see VidyoConnector.html
                      viewStyle: "VIDYO_CONNECTORVIEWSTYLE_Default", // Visual style of the composited renderer
                      remoteParticipants: 15,                        // Maximum number of participants
                      logFileFilter: "error",
                      logFileName:"",
                      userData:""
                    }).then(function(vc) {
                
                console.log("Created");
                
                     V=vc;
                
                    }).catch(function(err) {
                      console.error("CreateVidyoConnector Failed");
    });
                    
                    
                    
                    
                    
                }
        }
        
        function joinCall()
        {
            V.Connect({
                host: "prod.vidyo.io",
                 token: "cHJvdmlzaW9uAHVzZXIxQDg4NGZkYi52aWR5by5pbwA2MzcyMTQ2MTc4NQAAMTk1MjRjZjFiNzc1ZTcwYjRiZmY5ZDJhNWE2ZDhiNDFhNmZjYjQ4MDgzMDcxZjI2ZjIwMTBjN2YwNTU4ODQ1ZjE0YWMwNWU2M2Y3YjNhM2VmYTVjOWI0NTkzZTIyODEz",
                 displayName: "Abul",
                 resourceId: "demoRoom",
                 onSuccess: function()            { console.log("Connected");},
                 onFailure: function(reason)      { console.log("failed " +reason);},
                 onDisconnected: function(reason) { console.log("disconnected " +reason);}
});
        }
        
  
        
        
    </script>
    <script src="https://static.vidyo.io/4.1.25.30/javascript/VidyoClient/VidyoClient.js?onload=onVidyoClientLoaded"></script>

</head>
    <body>
    
    
    <div id="render" style="width:300px; height:400px"></div>
        <button onclick="joinCall()"> join live call</button>
    
    </body>

</html>