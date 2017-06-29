<div class="clear-both">
    <div class="st-title">-- js - jQuery － 特效 － 旋转木马 --</div>

    <pre>
        －－－－－面向对象开发模式－－－－－－－－－－
        1.匿名函数自执行的方式，封装一个类，实现局部作用域 
            (function(){})();
        2.基础插件结构 - 原生js－函数申明的方式－创建－类
            (function($){

                var Carousel = function(){};

                Carousel.prototype = {};

            })(jQuery);
        3.由于闭包，外部无法访问这个类，所以，需要将类注册到全局window对象上
            (function($){

                var Carousel = function(poster){};

                Carousel.prototype = {};

                window.Carousel = Carousel;

            })(jQuery);
            //页面中调用
            var carousel1 = new Carousel( $(".J_Poster").eq(0) );
        4.添加初始化方法，可以实现一次性实例化，避免页面中多次 new 操作
            页面中：
                Carousel.init( $(".J_Poster") );
            插件中，添加init方法
                (function($){

                    var Carousel = function(poster){};

                    Carousel.prototype = {};

                    Carousel.init = function(posters){ /*each 实例化*/ };

                    window.Carousel = Carousel;

                })(jQuery);
    </pre>

    <pre>
        －－－－－配置参数的 构建 和 传递－－－－－
        方法1.定义变量后传递［ 缺点：当有多个控件时，不能独立配置］
            var setting = {
                    width:1000,
                    height:200
                };
            Carousel.init( $(".J_Poster") , setting );
        方法2.节点属性配置参数
            将配置信息配置在各个控件节点的属性中，data-setting='{"width":1000,"height":200}'
            在js插件中，可以通过读取控件属性的方式，读取不同的配置信息
        方法3.默认配置参数
    </pre>
    
    <div class="wrap">
        <style type="text/css">
            .poster-main{width:100%;height:200px;position: relative;}

            .poster-list{width:100%;height:200px;}
            .poster-item{position: absolute;left:0;top:0;display: block;}
            .poster-item a,
            .poster-item img{display: block;width:100%;height:100%;}

            .poster-btn{position: absolute;width:50px;height:200px;top:0;z-index:1;font-size: 30px;text-align: center;line-height: 200px;}
            .poster-prev-btn{left:0;}
            .poster-next-btn{right:0;}
        </style>
        
        <div class="J_Poster poster-main" data-setting='{
                                                            "width":300,
                                                            "height":200,
                                                            "posterWidth":80,
                                                            "posterHeight":200,
                                                            "scale":0.9,
                                                            "speed":500,
                                                            "autoPlay":true,
                                                            "delay":5000,
                                                            "verticalAlign":"middle"
                                                        }'>
            <div class="poster-btn poster-prev-btn">&lt;</div>
            <ul class="poster-list">
                <li class="poster-item"><a href="#"><img src="image/1.jpg" alt="" width="100%" height="100%"></a></li>
                <li class="poster-item"><a href="#"><img src="image/2.jpg" alt="" width="100%" height="100%"></a></li>
                <li class="poster-item"><a href="#"><img src="image/3.jpg" alt="" width="100%" height="100%"></a></li>
                <li class="poster-item"><a href="#"><img src="image/4.jpg" alt="" width="100%" height="100%"></a></li>
                <li class="poster-item"><a href="#"><img src="image/5.jpg" alt="" width="100%" height="100%"></a></li>
                <li class="poster-item"><a href="#"><img src="image/6.jpg" alt="" width="100%" height="100%"></a></li>
                <li class="poster-item"><a href="#"><img src="image/7.jpg" alt="" width="100%" height="100%"></a></li>
                <li class="poster-item"><a href="#"><img src="image/8.jpg" alt="" width="100%" height="100%"></a></li>
                <!-- <li class="poster-item"><a href="#"><img src="image/9.jpg" alt="" width="100%" height="100%"></a></li> -->
            </ul>
            <div class="poster-btn poster-next-btn">&gt;</div>
        </div>

        <script type="text/javascript" data-name="class－插件开发">
            (function($){

                var Carousel = function(poster){
                    var self = this;
                    //poster:接收页面 实例化时的传递的参数 // var carousel = new Carousel( $(".J_Poster").eq(0) );
                    //保存单个旋转木马对象
                    this.poster = poster;
                    this.posterItemMain = poster.find(".poster-list");
                    this.prevBtn = poster.find(".poster-prev-btn");
                    this.nextBtn = poster.find(".poster-next-btn");
                    this.posterItems = this.posterItemMain.find(".poster-item");
                    if( this.posterItems.size() % 2 === 0 ){
                        this.posterItemMain.append( this.posterItems.eq(0).clone() );
                        this.posterItems = this.posterItemMain.children();
                    }
                    this.posterFirstItem = this.posterItems.first();
                    this.posterLastItem = this.posterItems.last();
                    this.rotateFlag = true;

                    //默认 配置参数
                    this.setting = {
                        width:300,
                        height:200,
                        posterWidth:200,
                        posterHeight:200,
                        scale:0.9,
                        speed:500,
                        autoPlay:false,
                        delay:5000,
                        verticalAlign:"middle"
                    };
                    $.extend( this.setting , this.getSetting() );

                    this.setSettingValue();
                    this.setPosterPos();

                    this.nextBtn.click(function(){
                        if(self.rotateFlag){
                            self.rotateFlag = false;
                            self.carouseRotate("left");
                        }
                    });
                    this.prevBtn.click(function(){
                        if(self.rotateFlag){
                            self.rotateFlag = false;
                            self.carouseRotate("right");
                        }
                    });

                    if(this.setting.autoPlay){
                        this.autoPlay();
                        this.poster.hover(function(){window.clearInterval(self.timer);},
                                          function(){self.autoPlay();});
                    }
                };

                Carousel.prototype = {
                    //获取人工配置参数
                    getSetting: function(){
                        var setting = this.poster.data("setting");
                        if(setting && setting !== ''){
                            return setting;
                        }else{
                            return {};
                        }
                    },
                    //设置配置参数 去 控制 控件 基本的宽度、高度等信息
                    setSettingValue: function(){
                        this.poster.css({
                            width:this.setting.width,
                            height:this.setting.height
                        });
                        this.posterItemMain.css({
                            width:this.setting.width,
                            height:this.setting.height
                        });

                        var w = (this.setting.width-this.setting.posterWidth)/2;
                        this.prevBtn.css({
                            width:w,
                            height:this.setting.height,
                            zIndex:Math.ceil(this.posterItems.size()/2)
                        });
                        this.nextBtn.css({
                            width:w,
                            height:this.setting.height,
                            zIndex:Math.ceil(this.posterItems.size()/2)
                        });

                        this.posterFirstItem.css({
                            width: this.setting.posterWidth,
                            height:this.setting.posterHeight,
                            left: w,
                            zIndex:Math.floor(this.posterItems.size()/2)
                        });
                    },
                    //设置垂直排列对齐
                    setVerticalAlign: function(height){
                        var verticalType = this.setting.vericalAlign,
                            top = 0;
                            switch(verticalType){
                                case 'top':
                                    top = 0;
                                    break;
                                case 'middle':
                                    top = (this.setting.height-height)/2;
                                    break;
                                case 'bottom':
                                    top = this.setting.height-height;
                                    break;
                                default:
                                    top = (this.setting.height-height)/2;
                                    break;
                            }
                            return top;
                    },
                    //设置剩余的帧的位置关系
                    setPosterPos: function(){
                        var self = this;
                        var sliceItems = this.posterItems.slice(1),
                            sliceSize = sliceItems.size()/2,
                            rightSlice = sliceItems.slice(0,sliceSize),
                            level = Math.floor(this.posterItems.size()/2),
                            leftSlice = sliceItems.slice(sliceSize);


                        //设置右边帧的位置关系、宽高、top等 
                        var rw = this.setting.posterWidth,
                            rh = this.setting.posterHeight,
                            gap = ((this.setting.width-this.setting.posterWidth)/2)/level;

                        var firstLeft = (this.setting.width-this.setting.posterWidth)/2;
                            fixOffsetLeft = firstLeft+rw;
                        rightSlice.each(function(i){
                            level--;
                            rw = rw * self.setting.scale;
                            rh = rh * self.setting.scale;
                            var j = i+1;
                            $(this).css({
                                width:rw,
                                height:rh,
                                opacity:1/j,
                                left:fixOffsetLeft+j*gap-rw,
                                top:self.setVerticalAlign(rh),
                                zIndex:level
                            });
                        });
                        //设置左边帧的位置关系、宽高、top等    
                        var lw = rightSlice.last().width(),
                            lh = rightSlice.last().height(),
                            oloop = Math.floor(this.posterItems.size()/2);

                        leftSlice.each(function(i){
                            
                            $(this).css({
                                width:lw,
                                height:lh,
                                opacity:1/oloop,
                                left:i*gap,
                                top:self.setVerticalAlign(lh),
                                zIndex:i
                            });
                            lw = lw/self.setting.scale;
                            lh = lh/self.setting.scale;
                            oloop--;
                        });
                    },
                    //旋转
                    carouseRotate: function(dir){
                        var _this_ = this;
                        var zIndexArr = [];
                        if('left' === dir){
                            this.posterItems.each(function(){
                                var self = $(this),
                                    prev = self.prev().get(0) ? self.prev() : _this_.posterLastItem,
                                    width=prev.width(),
                                    height = prev.height(),
                                    zIndex=prev.css("zIndex"),
                                    opacity = prev.css("opacity"),
                                    left = prev.css("left"),
                                    top = prev.css("top");
                                zIndexArr.push(zIndex);   
                                self.animate({
                                    width:width,
                                    height:height,
                                    opacity:opacity,
                                    left:left,
                                    top:top,
                                },
                                _this_.setting.speed,
                                function(){
                                    _this_.rotateFlag = true;
                                });
                            });
                            this.posterItems.each(function(i){
                                $(this).css("zIndex",zIndexArr[i]);
                            });
                        }else{
                            this.posterItems.each(function(){
                                var self = $(this),
                                    next = self.next().get(0) ? self.next() : _this_.posterFirstItem,
                                    width=next.width(),
                                    height = next.height(),
                                    zIndex=next.css("zIndex"),
                                    opacity = next.css("opacity"),
                                    left = next.css("left"),
                                    top = next.css("top");
                                zIndexArr.push(zIndex);   
                                self.animate({
                                    width:width,
                                    height:height,
                                    opacity:opacity,
                                    left:left,
                                    top:top,
                                },
                                _this_.setting.speed,
                                function(){
                                    _this_.rotateFlag = true;
                                });
                            });
                            this.posterItems.each(function(i){
                                $(this).css("zIndex",zIndexArr[i]);
                            });
                        }
                    },
                    //自动播放
                    autoPlay: function(){
                        var self = this;
                        this.timer = window.setInterval(function(){
                            self.nextBtn.click();
                        }, this.setting.delay);
                    }
                };

                Carousel.init = function(posters){
                    var _this_ = this;
                    posters.each(function(){
                        new _this_($(this));
                    });
                };

                window.Carousel = Carousel;

            })(jQuery);
        </script>

        <script type="text/javascript" data-name="dom">
            $(function(){
                //类 - Carousel
                //单个
                //var carousel1 = new Carousel( $(".J_Poster").eq(0) );
                //var carousel2 = new Carousel( $(".J_Poster").eq(1) );
                //多个
                Carousel.init( $(".J_Poster") );
            });
        </script>
    </div>
</div>