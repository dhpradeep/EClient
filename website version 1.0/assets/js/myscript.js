/*function popitup(username, byid) {
    var id = $('#id').val();
    $.ajax({
        type: 'post',
        url: 'setnotification.php',
        data: {
            uid: id,
            username: username,
            byid: byid
        },
        async: true,
        cache: false,
        success: function (data) {
            console.log(data);
        }
    });
    
    var url = 'calling.php';
    alert(rand_val);
    newwindow = window.open(url + "?room=" + rand_val, 'name', 'height=600,width=1300');
    if (window.focus) { newwindow.focus() }
    return false;
}
*/