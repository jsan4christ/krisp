  $(document).ready(function () {
        $('#txtSearchTool').typeahead({
            order: "asc",
            source: function (query, result) {
                $.ajax({
                    url: "db_scripts/search-tool.php",
					data: 'query=' + query,            
                    dataType: "json",
                    type: "POST",                   
                    success: function (data) {
                        var sw_name = data["sw_name"];
                       // console.log(data);
                        /**/
						result($.map(sw_name, function (item) {
							return item;
                        }));
                        $(".dropdown-item").click(function(){
                            var $this = $(this);
                            var pos = data["sw_name"].indexOf($this.text());
                            var id = data["sw_id"][pos];
                            $(".dropdown-item").attr("data-id", id);
                            //alert(pos);
                        });
                        $(".dropdown-item").keypress(function(e){
                            if (e.which == 13) {
                                var $this = $(this);
                                var pos = data["sw_name"].indexOf($this.text());
                                var id = data["sw_id"][pos];
                                $(".dropdown-item").attr("data-id", id);
                            }
                        });
                        /**/
                    }
                });
            },
           
        });
    });