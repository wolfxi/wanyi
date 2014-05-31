
/**
 * [insertImages 多图片预览]
 * @param  {[type]} divid       [预览图片存放的容器]
 * @param  {[type]} inputfileid [图片上传按钮]
 * @param  {[type]} ingheight   [预览图片的高]
 * @param  {[type]} imgwidth    [预览图片的宽]
 * @return {[type]}             [void 无返回值]
 * 依赖插件：
 * <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
    <script src="js/vendor/jquery.ui.widget.js"></script>
    <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
    <script src="http://blueimp.github.io/JavaScript-Load-Image/js/load-image.min.js"></script>
    <!-- The Canvas to Blob plugin is included for image resizing functionality -->
    <script src="http://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
    <!-- Bootstrap JS is not required, but included for the responsive demo navigation -->

    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->

    <!-- The basic File Upload plugin -->
    <script src="js/jquery.fileupload.js"></script>
    <!-- The File Upload processing plugin -->
    <script src="js/jquery.fileupload-process.js"></script>
    <!-- The File Upload image preview & resize plugin -->
    <script src="js/jquery.fileupload-image.js"></script>
    <!-- The File Upload audio preview plugin -->
    <script src="js/jquery.fileupload-audio.js"></script>

 function insertImages(divid,inputfileid,imgwidth,ingheight) {
    $("#"+divid).empty();
    $('#'+inputfileid).fileupload({


        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 5000000, // 5 MB
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        previewMaxWidth: 160,
        previewMaxHeight: 160,
        previewCrop: true
    }).on('fileuploadadd', function (e, data) {
        data.context = $('<div class="col-md-3 center-block"><div/>').appendTo('#'+divid);
        $.each(data.files, function (index, file) {
            var node = $('<p/>')
                    .append($('<span/>').text(file.name));
            if (!index) {
            }
            node.appendTo(data.context);
        });
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.preview) {
            node
                .prepend('<br>')
                .prepend(file.preview);
        }
        if (file.error) {
            node
                .append('<br>')
                .append($('<span class="text-danger"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
            data.context.find('button')
                .text('Upload')
                .prop('disabled', !!data.files.error);
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
}

 */


















function choseImage(divid,inputname){
	var divelement=$("<div></div>");
        divelement.addClass('col-md-4');
	var inputfile=$("<input type='file'/>");
        inputfile.attr("name",inputname);
	var imgs=$("<img src=' '/> ");
        imgs.css({
            width:  250,
            height: 180 
        });
	imgs.appendTo(divelement);
	inputfile.appendTo(divelement);
	$("#"+divid).append(divelement);
    inputfile.hide();
	inputfile.click();
    inputfile.change(function(event) {
        previewImage(this,imgs);
    });
}



function previewImage(file,imgs)
{
    var viewImg  = $(imgs);
    if (file["files"] && file["files"][0])
    {
       // console.log("dddddddddd");
        var reader = new FileReader();
        reader.onload = function(evt){
           // porImg.attr({src : evt.target.result});
            viewImg.attr({src : evt.target.result});
        }
        reader.readAsDataURL(file.files[0]);
    }
    else
    {
        /*var sFilter='filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src="';
        file.select();
        var src = document.selection.createRange().text,
            mysrc = sFilter+src;
        porImg.filters.item('DXImageTransform.Microsoft.AlphaImageLoader').src = src;
       // porImg.attr({mysrc:"",class:"aaa"});
       */
        var ieImageDom = document.createElement("div");
        var proIeImageDom = document.createElement("div");
        $(ieImageDom).css({
            float: 'left',
            position: 'relative',
            overflow: 'hidden',
            width: '100px',
            height: '100px'
        }).attr({"id":"view"});
        $(proIeImageDom).attr({"id":"biuuu"});
        porImg.parent().prepend(proIeImageDom);
        porImg.remove();
        viewImg.parent().append(ieImageDom);
        viewImg.remove();
        file.select();
        path = document.selection.createRange().text;
        $(ieImageDom).css({"filter": "progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled='true',sizingMethod='scale',src=\"" + path + "\")"});
        $(proIeImageDom).css({"filter": "progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled='true',sizingMethod='scale',src=\"" + path + "\")"});
   // .style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled='true',sizingMethod='scale',src=\"" + path + "\")";//使用滤镜效果
        /*var imagePath = file.value;
        porImg.attr({
            src : "file://" + imagePath
        });*/
    }
}


/*
var Upload={
	var oFReader = new FileReader();
	var rFilter = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i,
	oFReader.onload = function (oFREvent) {
	  document.getElementById("uploadPreview").src = oFREvent.target.result;
	};

	loadImageFile:function () {
	  if (document.getElementById("uploadImage").files.length === 0) { return; }
	  var oFile = document.getElementById("uploadImage").files[0];
	  if (!rFilter.test(oFile.type)) { alert("You must select a valid image file!"); return; }
	  oFReader.readAsDataURL(oFile);
	}



}
*/

