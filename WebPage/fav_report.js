//......................FAVORITES(100% WORKING)................
            $(document).ready(function () {
                $(".favorite").click(function () {
                    if ($(this).children('i').hasClass("disabled fa fa-heart-o")) {
                    } else {
                        var id = $(this).parent('div').parent('div').parent('div').attr('id');
                        var email = $(this).parent('div').parent('div').parent('div').attr('name');
                        var addURL = "https://enikioadmin.000webhostapp.com/Favorites/callFavoritesOperation.php?operation=0&email=" + email + "&houseID=" + id + "&key=c245eb9221f65bb871a4a9fe253dfbe0c6d3d74d";
                        var deleteURL = "https://enikioadmin.000webhostapp.com/Favorites/callFavoritesOperation.php?operation=1&email=" + email + "&houseID=" + id + "&key=c245eb9221f65bb871a4a9fe253dfbe0c6d3d74d";
//             var cl = $(this).attr('class');
//                                    alert($(this));            
                        if ($(this).children('i').hasClass("fa fa-heart-o")) {
                            $.get(addURL, function (data, status) {
                                if (data[21][0] == 2) {
                                    $("#" + id).children('div').children('div').children('button').children('i').attr('class', 'fa fa-heart');
                                    $("#" + id).children('div').children('div').children('button').first().attr('title', 'Αγαπημένο');
                                }
                            });
                        } else if ($(this).children('i').hasClass("fa fa-heart")) {
                            $.get(deleteURL, function (data, status) {
                                if (data[24][0] == 2) {
                                    $("#" + id).children('div').children('div').children('button').children('i').attr('class', 'fa fa-heart-o');
                                    $("#" + id).children('div').children('div').children('button').first().attr('title', 'Προσθήκη στα αγαπημένα');
                                }
                            });
                        }
                    }
                });
            });

               



            