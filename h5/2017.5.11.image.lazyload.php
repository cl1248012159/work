<div class="clear-both">
    <div class="st-title">------------ 图片 懒加载 - 简介 --</div>
    <pre>
        网站性能优化，提高用户体验。
        页面如果有很多图片的时候，当你滚动到相应的行时，当前行的图片才即时加载的，这样子的话页面在打开只加可视区域的图片，而其它隐藏的图片则不加载。

        懒加载的原理
            先将img标签中的src链接设为同一张图片（空白图片），将其真正的图片地址存储再img标签的自定义属性中（比如data-src）。
            当js监听到该图片元素进入可视窗口时，即将自定义属性中的地址存储到src属性中，达到懒加载的效果。
            这样做能防止页面一次性向服务器响应大量请求导致服务器响应慢，页面卡顿或崩溃等问题。

        原理 － 代码实现:
        1.判断元素是否出现在可视范围内
            function isVisible($node){
                var winH = $(window).height(),
                    scrollTop = $(window).scrollTop(),
                    offSetTop = $(window).offSet().top;
                if (offSetTop < winH + scrollTop) {
                    return true;
                } else {
                    return false;
                }
            }
        2.浏览器的事件监听 - 让浏览器每次滚动就检查元素是否出现在窗口可视范围内
            var hasShowed = false;
            $(window).on("scroll", function{
                if (hasShowed) {
                    return;
                } else {
                    if (isVisible($node)) {
                        console.log(true);
                    }
                }
            })


        使用场合
        涉及到图片，falsh资源，iframe，网页编辑器(CK)，JS文件 等占用较大带宽，避免网页打开时加载过多资源，让用户等待太久。

        代码实现：
        1.导入JS插件(前提有 1.6.2.js文件)
            < script src="js\jquery.lazyload.js" type="text/javascript">< /script> 
        2.在你的页面中加入如下：
            < script type="text/javascript"> 
                $("img").lazyload();  
            < /script> 
            所以图片都延迟加载。
        3.设置敏感度区域
            插件提供了 threshold 选项
            $("#xd").lazyload({ threshold : 200 });  //表示滚动条在离目标位置还有200的高度时就开始加载图片,做到不让用户察觉
    </pre>
</div>