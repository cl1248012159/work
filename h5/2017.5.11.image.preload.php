<div class="clear-both">
    <div class="st-title">-------- 图片 预加载 - 简介 --</div>
    <pre>
        图片 预加载 ：
            预知用户将要发生的行为，提前加载用户所需要的图片
        图片 预加载 运用：
            1. 网站的Loading页（无序加载）
            2. 局部图片的加载 （无序加载）
            3. 预先加载下一页中的图片，打开下一页后，直接读取本地缓存图片（有序加载）

        创建一个Image对象：var a = new Image();    定义Image对象的 src : a.src=”xxx.gif”;    这样做就相当于给浏览器缓存了一张图片。
    </pre>
</div>

<div class="clear-both">
    <div class="st-title">-------- 图片 预加载 - Amazon使用的图片预加载js代码 --</div>
    <pre>
        amznJQ.available("jQuery", function() {  
            jQuery(window).load(function() { 
                setTimeout(function() {  
                    var imageAssets = new Array();  
                    var jsCssAssets = new Array();  
                    imageAssets.push("https://images-na.ssl-images-amazon.com/images/G/09/x-locale/common/buy-buttons/review-1-click-order._V171143523_.gif");  
                    imageAssets.push("https://images-na.ssl-images-amazon.com/images/G/09/x-locale/common/buttons/continue-shopping._V192262037_.gif");  
                    imageAssets.push("https://images-na.ssl-images-amazon.com/images/G/09/x-locale/common/buy-buttons/thank-you-elbow._V192261665_.gif");  
                    imageAssets.push("https://images-na.ssl-images-amazon.com/images/G/09/x-locale/communities/social/snwicons_v2._V383421867_.png");  
                    imageAssets.push("https://images-na.ssl-images-amazon.com/images/G/09/checkout/assets/carrot._V192555707_.gif");  
                    imageAssets.push("https://images-na.ssl-images-amazon.com/images/G/09/checkout/thank-you-page/assets/yellow-rounded-corner-sprite._V192555699_.gif");  
                    imageAssets.push("https://images-na.ssl-images-amazon.com/images/G/09/checkout/thank-you-page/assets/white-rounded-corner-sprite._V212531219_.gif");  
                    imageAssets.push("https://images-na.ssl-images-amazon.com/images/G/09/gno/beacon/BeaconSprite-JP-02._V393500380_.png");  
                    imageAssets.push("https://images-na.ssl-images-amazon.com/images/G/09/x-locale/common/transparent-pixel._V386942697_.gif");  
                    imageAssets.push("https://images-na.ssl-images-amazon.com/images/I/61AdS2XVkGL._SX35_.jpg");  
                    
                    jsCssAssets.push("https://images-na.ssl-images-amazon.com/images/G/01/browser-scripts/jp-site-wide-css-beacon/site-wide-6800426958._V1_.css");  
                    jsCssAssets.push("https://images-na.ssl-images-amazon.com/images/G/01/browser-scripts/navbarCSSJP-beacon/navbarCSSJP-beacon-min-583273174._V1_.css");  
                    jsCssAssets.push("https://images-na.ssl-images-amazon.com/images/G/01/browser-scripts/navbarJS-beacon/navbarJS-beacon-min-1773974689._V1_.js");  
                    jsCssAssets.push("https://images-na.ssl-images-amazon.com/images/G/01/browser-scripts/site-wide-js-1.2.6-beacon/site-wide-5626886881._V1_.js");  
              
                    // pre-fetching image assets  
                    for (var i=0; i < imageAssets.length; i++) {  
                       new Image().src = imageAssets[i];  
                    }  
                    // pre-fetching css and js assets based on different browser types  
                    var isIE = /*@cc_on!@*/0;  
                    var isFireFox = /Firefox/.test(navigator.userAgent);  
                    if (isIE) {  
                      for (var i=0; i < jsCssAssets.length; i++) {  
                        new Image().src = jsCssAssets[i];  
                      }  
                    }else if (isFireFox) {  
                      for (var i=0; i < jsCssAssets.length; i++) {  
                        var o =  document.createElement("object");  
                        o.data = jsCssAssets[i];  
                        o.width = o.height = 0;  
                        document.body.appendChild(o);  
                      }  
                    }  
                }, 2000); 
            });  
        });
    </pre>
</div>

<div class="clear-both">
    <div class="st-title">-------- 图片 预加载 - 相关 new Image()  --</div>
    <pre>
        new Image()
        图像对象：
        建立图像对象：图像对象名称=new Image([宽度],[高度])
        图像对象的属性： border complete height hspace lowsrc name src vspace width
        图像对象的事件：onabort onerror onkeydown onkeypress onkeyup onload
        注意：src 属性一定要写到 onload 的后面，否则程序在 IE 中会出错。
        参考代码：
        var img=new Image();  
            img.onload=function(){alert("img is loaded")};  
            img.onerror=function(){alert("error!")};  
            img.src="http://www.abaonet.com/img.gif";

            function show(){alert("body is loaded");};  
            window.onload=show; 
            运行上面的代码后，在不同的浏览器中进行测试，发现 IE 和 FF 是有区别的：
            在 FF 中，img 对象的加载包含在 body 的加载过程中，既是 img加载完之后，body 才算是加载完毕，触发 window.onload 事件。
            在 IE 中，img 对象的加载是不包含在 body 的加载过程之中的，body 加载完毕，window.onload 事件触发时，img对象可能还未加载结束，img.onload事件会在 window.onload 之后触发。
        
        在 window.onload 之后，执行new Image()，可预加载图片

        可以通过Image对象的complete 属性来检测图像是否加载完成（每个Image对象都有一个complete属性，当图像处于装载过程中时，该属性值false,当发生了onload、onerror、onabort中任何一个事件后，则表示图像装载过程结束（不管成没成功），此时complete属性为true）
        参考代码：
        var img = new Image();    
        img.src = oImg[0].src = this.src.replace(/small/,"big");    
        oDiv.style.display = "block";    
        img.complete ? oDiv.style.display = "none" : (oImg[0].onload = function() {oDiv.style.display = "none"})
    </pre>
</div>

<div class="clear-both">
    <div class="st-title">-------- 图片 预加载 - jQuery 插件 [学习插件开发]--</div>
    <pre>
        //(function(){})();闭包实现局部作用于
        ----------------------------------------------------------------
        //面向对象编程
        (function($){
            //1.构造函数
            function PreLoad(imgs , options){
                //接收参数－初始化
                this.imgs = (typeof imgs === 'string') ? [imgs] : imgs;
                this.opts = $.extend( {} , Preload.DEFAULTS , options );

                if( 'ordered' === this.opts.order){
                    this._ordered();
                }else{
                    this._unoredered();//无序加载
                }  
            }

            //2.默认参数
            Preload.DEFAULTS ={
                order:'unordered',//默认为 无序 预加载
                each:null, //每一张图片加载完毕后执行
                all:null   //所有图片加载完毕后执行
            };


            //3.面向对象  的方法 ，将其写在原型链上，这样，每次实例化的时候，可以保持它只有一份
            PreLoad.prototype._ordered = function(){
                //有序加载
                var opts = this.opts,
                    imgs = this.imgs,
                    len = imgs.length,
                    count = 0;
                load();
                function load(){
                    var imgObj = new Image();
                    $(imgObj).on('load error',function(){
                        opts.each && opts.each(count);
                        if(count >= len){
                            opts.all && opts.all();
                        }else{
                            load();
                        }
                        count++;
                    });
                    imgObj.src = imgs[count];
                }
            };
            PreLoad.prototype._unoredered = function(){
                //无序加载
                var imgs = this.imgs,
                    opts = this.opts,
                    count = 0,
                    len = imgs.length;


                $.each(imgs,function(i,src){
                    if(typeof src  != 'string'){ return;}
                    var imgObj = new Image();
                    $(imgObj).on('load error',function(){
                        opts.each && opts.each(count);//判断each是否有传递（默认为null），该方法 避免了if判断，简洁明了
                        if(count >= len-1){
                            opts.all && opts.all();
                        }
                        count++;
                    });
                });
                imgObj.src = src;//请求图片资源，缓存到本地
            };

            //以上 已完成 面向对象的编程
            //4.如何 将其变成 jQuery 的插件？
            //jQuery.fn.extend(object); --使用--> $('#img').preload();  //给jQuery对象添加方法。
            //jQuery.extend(object);    --使用--> $.preload();          //为扩展jQuery类本身.为类添加新的方法。
            $.extend({
                preload: function(imgs , opts){ new PreLoad(imgs , opts); }
            });
        })(jQuery);
        ----------------------------------------------------------------
        //插件的使用-无序
        $.preload( imgs , {
            each: function(count){
                $progress.html( Math.round((count+1)/len *100)  +'%' );
            },
            all:  function(){
                $('.loading').hide();
            }
        });
        //有序
        $.preload( imgs , {
            order:'ordered'
        });
    </pre>
</div>
