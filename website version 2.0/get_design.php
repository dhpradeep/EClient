<?php
if (!defined('IN_APP')) {
    header('Location: dashboard.php');
    exit();
}
?>
<?php include_once 'includes/header.php' ?>

<div class="col col-lg-3 text-black" style="border-right: 2px solid #ccc;">

        <h4 id="first_tab" style="pointer:default;">Choose color <i class="fa fa-angle-down"></i></h4><br>
        <div id="first_tab_data">
           <div class="col-lg-8">
                <button id="colorButton0" class="btn btn-md btn-outline-success btn-block">Bg. color</button>
            </div>
            <div class="col-lg-12" id="colorPicker0">
                <input type="text" id="inlinecolors0" class="form-control" data-inline="true" value="#4fc8db">
            </div>
                <p id="inlinecolorhex0">#ffffff</p>

            <div class="col-lg-8">
                <button id="colorButton1" class="btn btn-md btn-outline-success btn-block">Primary color</button>
            </div>
            <div class="col-lg-12" id="colorPicker1">
                <input type="text" id="inlinecolors1" class="form-control" data-inline="true" value="#4fc8db">
            </div>
                <p id="inlinecolorhex1">#ffffff</p>

            <div class="col-lg-8">
                <button  id="colorButton2" class="btn btn-md btn-outline-success btn-block">Second. color</button>
            </div>
            <div class="col-lg-12" id="colorPicker2">
                <input type="text" id="inlinecolors2" class="form-control" data-inline="true" value="#4fc8db">
            </div>
                <p id="inlinecolorhex2">#ffffff</p>
        </div>

        <h4 id="second_tab" style="pointer:default;">Choose fonts <i class="fa fa-angle-down"></i></h4><br>
        <div id="second_tab_data">
           <div class="col-lg-8">
                <p>Primary font:</p>
                
            </div>
            <div class="col-lg-12">
            <input id="headingFont" type="range" min="10" max="50" value="30" step="1"/>
            </div>
                <p id="primaryfontSize">30px</p>
            <div class="col-lg-12">
                <span id="bold0">Bold</span>&nbsp;&nbsp;
                <span id="italic0">Italic</span>&nbsp;&nbsp;&nbsp;
                <span id="underline0">Underline</span>&nbsp;&nbsp;&nbsp;
            </div>
            <div class="col-lg-8">
                <p>Second. font:</p>
            </div>
            <div class="col-lg-12">
                <input id="paragraphFont" type="range" min="10" max="50" value="15" step="1"/>
            </div>
                <p id="secondaryfontSize">15px</p>
            <div class="col-lg-12">
                <span id="bold1">Bold</span>&nbsp;&nbsp;
                <span id="italic1">Italic</span>&nbsp;&nbsp;&nbsp;
                <span id="underline1">Underline</span>&nbsp;&nbsp;&nbsp;
            </div>
        </div>

        <h4 id="third_tab" style="pointer:default;">Choose Button <i class="fa fa-angle-down"></i></h4><br>
        <div id="third_tab_data">
            <div class="col-lg-12">
                <form id="myForm">
                    <div class="custom-control custom-radio col-lg-6">
                        <input type="radio" onclick="buttonStyle('button1')" checked name="buttonDesign" class="custom-control-input" id="btn1" value="buttton1">
                        <label class="custom-control-label" for="btn1">Button1</label>
                    </div>
                    <div class="custom-control custom-radio col-lg-6">
                        <input type="radio" onclick="buttonStyle('button2')" name="buttonDesign" class="custom-control-input" id="btn2" value="buttton2">
                        <label class="custom-control-label" for="btn2">Button2</label>
                    </div><br><br>
                    <div class="custom-control custom-radio col-lg-6">
                        <input type="radio" onclick="buttonStyle('button3')" name="buttonDesign" class="custom-control-input" id="btn3" value="buttton3">
                        <label class="custom-control-label" for="btn3">Button3</label>
                    </div>
                    <div class="custom-control custom-radio col-lg-6">
                        <input type="radio" onclick="buttonStyle('button4')" name="buttonDesign" class="custom-control-input" id="btn4" value="buttton4">
                        <label class="custom-control-label" for="btn4">Button4</label>
                    </div>
                </form>
            </div>
        </div>
</div>


<div class="col col-lg-9">
    <div class="container">
        <div class="row background">
            <font class="heading" style="font-size:30px;">Testing title</font><br><br>
            <p class="paragraph" style="font-size:15px;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse magnam nulla fugit sed odio tenetur deleniti impedit. Perspiciatis, maiores illo commodi porro nemo ipsa aliquid impedit illum, praesentium possimus laboriosam.</p>
            <button id="myBtn" class="btns first">Read more..</button>
        </div>
    </div>
</div>

<div class="col col-lg 12">
    <button onclick="complete()" class="btn btn-md btn-success">Done editing</button>
</div>

<script>
$(function(){  
  var $inlinehex = $('#inlinecolorhex0');
  $('#inlinecolors0').minicolors({
    inline: true,
    change: function(hex) {
      if(!hex) return;
      $inlinehex.html(hex);
      $('.background').css('background', hex);
    }
  });
});
$(function(){  
  var $inlinehex1 = $('#inlinecolorhex1');
  $('#inlinecolors1').minicolors({
    inline: true,
    change: function(hex) {
      if(!hex) return;
      $inlinehex1.html(hex);
      $('.heading').css('color', hex);
    }
  });
});
$(function(){  
  var $inlinehex2 = $('#inlinecolorhex2');
  $('#inlinecolors2').minicolors({
    inline: true,
    change: function(hex) {
      if(!hex) return;
      $inlinehex2.html(hex);
      $('.paragraph').css('color', hex);
    }
  });
});

//sidebar font controller
$("#headingFont").on("input",function () {
    $('.heading').css("font-size", $(this).val() + "px");
    $('#primaryfontSize').html($(this).val() + "px");
});
$("#paragraphFont").on("input",function () {
    $('.paragraph').css("font-size", $(this).val() + "px");
    $('#secondaryfontSize').html($(this).val() + "px");
});
//for bold
$("#bold0").on('click', function(){
    if($(this).val() == "Bold"){
        $(this).css("font-weight","bold");
        $('.heading').css('font-weight', 'bold');
        $(this).val("UnBold");
    }else{
        $(this).css("font-weight","normal");
        $('.heading').css('font-weight', 'normal');
        $(this).val("Bold");
}
});
//for italic
$("#italic0").on('click', function(){
    if($(this).val() == "Italic"){
        $(this).css("font-style","italic");
        $('.heading').css('font-style', 'italic');
        $(this).val("UnItalic");
    }else{
        $(this).css("font-style","normal");
        $('.heading').css('font-style', 'normal');
        $(this).val("Italic");
}
});
//for underline
$("#underline0").on('click', function(){
    if($(this).val() == "Underline"){
        $(this).css("text-decoration","underline");
        $('.heading').css('text-decoration', 'underline');
        $(this).val("UnUnderline");
    }else{
        $(this).css("text-decoration","none");
        $('.heading').css('text-decoration', 'none');
        $(this).val("Underline");
}
});
//for bold
$("#bold1").on('click', function(){
    if($(this).val() == "Bold"){
        $(this).css("font-weight","bold");
        $('.paragraph').css('font-weight', 'bold');
        $(this).val("UnBold");
    }else{
        $(this).css("font-weight","normal");
        $('.paragraph').css('font-weight', 'normal');
        $(this).val("Bold");
}
});
//for italic
$("#italic1").on('click', function(){
    if($(this).val() == "Italic"){
        $(this).css("font-style","italic");
        $('.paragraph').css('font-style', 'italic');
        $(this).val("UnItalic");
    }else{
        $(this).css("font-style","normal");
        $('.paragraph').css('font-style', 'normal');
        $(this).val("Italic");
}
});
//for underline
$("#underline1").on('click', function(){
    if($(this).val() == "Underline"){
        $(this).css("text-decoration","underline");
        $('.paragraph').css('text-decoration', 'underline');
        $(this).val("UnUnderline");
    }else{
        $(this).css("text-decoration","none");
        $('.paragraph').css('text-decoration', 'none');
        $(this).val("Underline");
}
});
//button controller
function buttonStyle(name)
{
    var btn = document.getElementById('myBtn');
    if (name == 'button1'){
		btn.className = ''
		btn.classList.add('btns');
		btn.classList.add('first');
	}
	if (name == 'button2'){
		btn.className = ''
		btn.classList.add('btns');
		btn.classList.add('second');
	}
	if (name == 'button3'){
		btn.className = ''
		btn.classList.add('btns');
		btn.classList.add('third');
	}
	if (name == 'button4'){
		btn.className = ''
		btn.classList.add('btns');
		btn.classList.add('fourth');
	}
}

var button = "button1";
$('#myForm input').on('change', function() {
   button = $('input[name=buttonDesign]:checked', '#myForm').val(); 
});

//on complete editing
function complete()
{
    var somedata = [
        {
            "color": [
                {
                    "bg_color": $('#inlinecolorhex0').text(),
                    "primary_color": $('#inlinecolorhex1').text(),
                    "secondary_color":$('#inlinecolorhex2').text()
                }
            ],
            "font":[
                {
                    "primary_font":[
                    {
                        "font_size": $("#primaryfontSize").text(),
                        "font_bold": $("#bold0").val(),
                        "font_italic": $("#italic0").val(),
                        "font_unserline": $("#underline0").val()
                    }
                    ],
                    "secondary_font": [
                    {
                        "font_size": $("#secondaryfontSize").text(),
                        "font_bold": $("#bold1").val(),
                        "font_italic": $("#italic1").val(),
                        "font_unserline": $("#underline1").val()
                    }
                    ]
                }
            ],
            "button": button
        }
    ];

    //bold,italic data are negative because of the val().
    console.log(somedata);

    //send data to backend from here....
    download_data(somedata,"design_setting");
}

function download_data(exportObj,exportName)
{
    var dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(exportObj));
    var downloadAnchorNode = document.createElement('a');
    downloadAnchorNode.setAttribute("href",     dataStr);
    downloadAnchorNode.setAttribute("download", exportName + ".json");
    document.body.appendChild(downloadAnchorNode); // required for firefox
    downloadAnchorNode.click();
    downloadAnchorNode.remove();
}

//sidebar setting
$('#first_tab_data').hide();
$('#first_tab').on('click', function(){
    $('#first_tab_data').slideToggle();
});
$('#second_tab_data').hide();
$('#second_tab').on('click', function(){
    $('#second_tab_data').slideToggle();
});
$('#third_tab_data').hide();
$('#third_tab').on('click', function(){
    $('#third_tab_data').slideToggle();
});
$('#colorPicker0').hide();
$('#colorButton0').on('click', function(){
    $('#colorPicker0').slideToggle();
});
$('#colorPicker1').hide();
$('#colorButton1').on('click', function(){
    $('#colorPicker1').slideToggle();
});
$('#colorPicker2').hide();
$('#colorButton2').on('click', function(){
    $('#colorPicker2').slideToggle();
});

function show(val)
{
    var box = document.getElementById(val);
    box.style.visibility = 'hidden';
}
</script>
