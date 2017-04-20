    function send_cometQL_query(text)
    {
        jQuery.ajax({
            url: "http://comet-server.ru/doc/CometQL/commander/index.php?query="+encodeURIComponent(text),
            type: "GET",
            success: function(data) 
            {
                jQuery("#CometQL-cli-reslog").append(data).scrollTop(999999); 
                
            }
        });
    } 