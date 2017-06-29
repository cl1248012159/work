<div class="clear-both">
    <div class="st-title">-- pc 2级menu 效果 --</div>

    <style type="text/css">
        .level1{width:100px;background: #000;}
        .level1 ul{list-style: none;}
        .level1 ul li{list-style: none;padding:0 5px;}
        .level1 ul li>a{text-decoration: none; line-height: 30px; font-size:10px; color:#fff;}
        .active-row{background: #ccc;}
        .level1 a:hover{color:#ff0000;}

        .level2{position: absolute;top:0;left:100px;width:150px;background: #ccc;}
        .display-none{display: none;}
    </style>

    <!-- 
    // mouseenter| mouseleave : 鼠标没有离开父元素，在其子元素上任意移动，不会出发这对事件［当鼠标指针穿过元素时，会发生 mouseenter 事件。］
    // mouseover | mouseout   : 鼠标移动到子元素上，即便没有离开父元素，也会触发这对事件
    -->
    <script type="text/javascript">
        $(document).ready(function(){
            $(".level1")
                .on('mouseenter',function(e){
                    $(this).find(".level2").removeClass('display-none');
                })
                .on('mouseleave',function(e){
                    $(this).find(".level2").addClass('display-none');
                    //
                    $("."+$(this).find(".active-row").data('id')).addClass('display-none');
                    $(this).find(".active-row").removeClass('active-row');
                });
        });
    </script>


    <div class="wrap">
        普通
        <script type="text/javascript">
            $(document).ready(function(){
                $(".putong").on("mouseenter","li",function(){
                    if($(".level1").find(".active-row")){
                        $("."+$(".level1").find(".active-row").data('id')).addClass('display-none');
                        $(".level1").find(".active-row").removeClass("active-row");
                    }
                    $(this).addClass("active-row");
                    $("."+$(".level1").find('.active-row').data('id')).removeClass('display-none');
                });
            }); 
        </script>
        <div class="level1 putong">
            <ul>
                <li data-id="a"><a href="">level1-1</a></li>
                <li data-id="b"><a href="">level1-2</a></li>
                <li data-id="c"><a href="">level1-3</a></li>
                <li data-id="d"><a href="">level1-4</a></li>
                <li data-id="e"><a href="">level1-5</a></li>
                <li data-id="f"><a href="">level1-6</a></li>
                <li data-id="g"><a href="">level1-7</a></li>
                <li data-id="h"><a href="">L1-8-noL2</a></li>
            </ul>
            <div class="level2 display-none">
                <div class="a display-none"> a<br>a<br>a<br>a<br> </div>
                <div class="b display-none"> b<br>b<br>b<br>b<br>b<br> </div>
                <div class="c display-none"> c<br>c<br>c<br>c<br>c<br>c<br> </div>
                <div class="d display-none"> d<br>d<br>d<br>d<br>d<br>d<br>d<br> </div>
                <div class="e display-none"> e<br>e<br>e<br>e<br>e<br>e<br>e<br>e<br> </div>
                <div class="f display-none"> f<br>f<br>f<br>f<br>f<br>f<br>f<br>f<br>f<br> </div>
                <div class="g display-none"> g<br>g<br>g<br>g<br>g<br>g<br>g<br>g<br>g<br>g<br> </div>
            </div>
        </div>
    </div>

    <div class="wrap">
        利用延迟 直线进入子菜单
        <script type="text/javascript">
            $(document).ready(function(){
                // 切换子菜单时，用setTimeout设置延迟
                var mouseInLevel2=false;
                $(".youhua1 .level2")
                    .on('mouseenter',function(e){
                        mouseInLevel2=true;
                    })
                    .on('mouseleave',function(e){
                        mouseInLevel2=false;
                    });

                var timer;
                $(".youhua1")
                    .on("mouseenter","li",function(){
                        if(!$(".level1").find(".active-row")){
                            $(this).addClass("active-row");
                            $("."+$(".level1").find('.active-row').data('id')).removeClass('display-none');
                            return;
                        }
                        var _this = $(this);
                        timer = setTimeout(function(){
                            //鼠标在level2中，不切换
                            if(mouseInLevel2){
                                return;
                            }
                            //去旧
                            $("."+$(".level1").find(".active-row").data('id')).addClass('display-none');
                            $(".level1").find(".active-row").removeClass("active-row");
                            //设新
                            _this.addClass("active-row");
                            $("."+$(".level1").find('.active-row').data('id')).removeClass('display-none');
                        }, 500);
                    });
            });
        </script>
        <div class="level1 youhua1">
            <ul>
                <li data-id="a"><a href="">level1-1</a></li>
                <li data-id="b"><a href="">level1-2</a></li>
                <li data-id="c"><a href="">level1-3</a></li>
                <li data-id="d"><a href="">level1-4</a></li>
                <li data-id="e"><a href="">level1-5</a></li>
                <li data-id="f"><a href="">level1-6</a></li>
                <li data-id="g"><a href="">level1-7</a></li>
                <li data-id="h"><a href="">L1-8-noL2</a></li>
            </ul>
            <div class="level2 display-none">
                <div class="a display-none"> a<br>a<br>a<br>a<br> </div>
                <div class="b display-none"> b<br>b<br>b<br>b<br>b<br> </div>
                <div class="c display-none"> c<br>c<br>c<br>c<br>c<br>c<br> </div>
                <div class="d display-none"> d<br>d<br>d<br>d<br>d<br>d<br>d<br> </div>
                <div class="e display-none"> e<br>e<br>e<br>e<br>e<br>e<br>e<br>e<br> </div>
                <div class="f display-none"> f<br>f<br>f<br>f<br>f<br>f<br>f<br>f<br>f<br> </div>
                <div class="g display-none"> g<br>g<br>g<br>g<br>g<br>g<br>g<br>g<br>g<br>g<br> </div>
            </div>
        </div>
    </div>

    <div class="wrap">
        debounce去抖技术 （在事件被频繁触发式，只执行一次处理）
        <script type="text/javascript">
            /*
                只执行最后一次
                var timer;
                timer = setTimeout(function(){
                    timer = null;
                },300);
            */
            $(document).ready(function(){
                var mouseInLevel2=false;
                $(".youhua2 .level2")
                    .on('mouseenter',function(e){
                        mouseInLevel2=true;
                    })
                    .on('mouseleave',function(e){
                        mouseInLevel2=false;
                    });

                var timer;
                $(".youhua2")
                    .on("mouseenter","li",function(){
                        if(!$(".level1").find(".active-row")){
                            $(this).addClass("active-row");
                            $("."+$(".level1").find('.active-row').data('id')).removeClass('display-none');
                            return;
                        }
                        if(timer){
                            clearTimeout(timer);
                        }
                        var _this = $(this);
                        timer = setTimeout(function(){
                            //鼠标在level2中，不切换
                            if(mouseInLevel2){
                                return;
                            }
                            //去旧
                            $("."+$(".level1").find(".active-row").data('id')).addClass('display-none');
                            $(".level1").find(".active-row").removeClass("active-row");
                            //设新
                            _this.addClass("active-row");
                            $("."+$(".level1").find('.active-row').data('id')).removeClass('display-none');
                            timer = null;
                        }, 500);
                    });
            });
        </script>
        <div class="level1 youhua2">
            <ul>
                <li data-id="a"><a href="">level1-1</a></li>
                <li data-id="b"><a href="">level1-2</a></li>
                <li data-id="c"><a href="">level1-3</a></li>
                <li data-id="d"><a href="">level1-4</a></li>
                <li data-id="e"><a href="">level1-5</a></li>
                <li data-id="f"><a href="">level1-6</a></li>
                <li data-id="g"><a href="">level1-7</a></li>
                <li data-id="h"><a href="">L1-8-noL2</a></li>
            </ul>
            <div class="level2 display-none">
                <div class="a display-none"> a<br>a<br>a<br>a<br> </div>
                <div class="b display-none"> b<br>b<br>b<br>b<br>b<br> </div>
                <div class="c display-none"> c<br>c<br>c<br>c<br>c<br>c<br> </div>
                <div class="d display-none"> d<br>d<br>d<br>d<br>d<br>d<br>d<br> </div>
                <div class="e display-none"> e<br>e<br>e<br>e<br>e<br>e<br>e<br>e<br> </div>
                <div class="f display-none"> f<br>f<br>f<br>f<br>f<br>f<br>f<br>f<br>f<br> </div>
                <div class="g display-none"> g<br>g<br>g<br>g<br>g<br>g<br>g<br>g<br>g<br>g<br> </div>
            </div>
        </div>
    </div>


    <div class="wrap">
        基于用户行为预测的 切换技术 ［数学知识应用］
        <script type="text/javascript">
            //算法 函数
            function vector(a,b){
                return {
                    x: b.x - a.x,
                    y: b.y - a.y
                };
            }

            function vectorProduct(v1,v2){
                return v1.x*v2.y - v2.x*v1.y;
            }

            function sameSigh(a,b){
                return (a ^ b) >=0;
            }

            function isPointInTrangle(p,a,b,c){
                var pa = vector(p,a);
                var pb = vector(p,b);
                var pc = vector(p,c);

                var t1 = vectorProduct(pa,pb);
                var t2 = vectorProduct(pb,pc);
                var t3 = vectorProduct(pc,pa);

                return sameSigh(t1,t2) && sameSigh(t2,t3);
            }
        </script>

        <script type="text/javascript">
            /*
                跟踪鼠标的移动
                用 鼠标当前位置 和 鼠标上一次位置 ，与 子菜单上下边缘形成的三角形区域 进行比较
                数学知识：
                    向量：Vab = Pb-Pa
                    二维向量叉乘公式：a(x1,y1) * b(x2,y2) = x1*y2 - x2*y1
                    用叉乘法 判断 点 在三角形 内
                最终效果：
                鼠标自然的移动 和 点击到子菜单 和 切换时无延迟
            */
            $(document).ready(function(){

                function needDelay(level2_elem , leftCorner , currMousePos){
                    var offset = level2_elem.offset();
                    var level2_elem_left_top = { x: offset.left , y: offset.top };
                    var level2_elem_left_bottom = { x: offset.left , y: offset.top+level2_elem.height() };
                    return isPointInTrangle(currMousePos,leftCorner,level2_elem_left_top,level2_elem_left_bottom);
                }

                var mouseTrack = [];
                $(".youhua4").parent().on('mousemove',function(e){
                    mouseTrack.push( {x:e.pageX , y:e.pageY} );
                    if(mouseTrack.length > 2){
                        mouseTrack.shift();
                    }
                });

                var mouseInLevel2=false;
                $(".youhua4 .level2")
                    .on('mouseenter',function(e){
                        mouseInLevel2=true;
                    })
                    .on('mouseleave',function(e){
                        mouseInLevel2=false;
                    });

                var timer;
                $(".youhua4")
                    .on("mouseenter","li",function(){
                        if(!$(".level1").find(".active-row")){
                            $(this).addClass("active-row");
                            $("."+$(".level1").find('.active-row').data('id')).removeClass('display-none');
                            return;
                        }
                        if(timer){
                            clearTimeout(timer);
                        }
                        var _this = $(this);
                        if(needDelay($(".youhua4 .level2"),mouseTrack[0],mouseTrack[1])){
                            timer = setTimeout(function(){
                                //鼠标在level2中，不切换
                                if(mouseInLevel2){
                                    return;
                                }
                                //去旧
                                $("."+$(".level1").find(".active-row").data('id')).addClass('display-none');
                                $(".level1").find(".active-row").removeClass("active-row");
                                //设新
                                _this.addClass("active-row");
                                $("."+$(".level1").find('.active-row').data('id')).removeClass('display-none');
                                timer = null;
                            }, 500);
                        }else{
                            //去旧
                            $("."+$(".level1").find(".active-row").data('id')).addClass('display-none');
                            $(".level1").find(".active-row").removeClass("active-row");
                            //设新
                            _this.addClass("active-row");
                            $("."+$(".level1").find('.active-row').data('id')).removeClass('display-none');
                        }
                    });
            });
        </script>

        <div class="level1 youhua4">
            <ul>
                <li data-id="a"><a href="">level1-1</a></li>
                <li data-id="b"><a href="">level1-2</a></li>
                <li data-id="c"><a href="">level1-3</a></li>
                <li data-id="d"><a href="">level1-4</a></li>
                <li data-id="e"><a href="">level1-5</a></li>
                <li data-id="f"><a href="">level1-6</a></li>
                <li data-id="g"><a href="">level1-7</a></li>
                <li data-id="h"><a href="">L1-8-noL2</a></li>
            </ul>
            <div class="level2 display-none">
                <div class="a display-none"> a<br>a<br>a<br>a<br> </div>
                <div class="b display-none"> b<br>b<br>b<br>b<br>b<br> </div>
                <div class="c display-none"> c<br>c<br>c<br>c<br>c<br>c<br> </div>
                <div class="d display-none"> d<br>d<br>d<br>d<br>d<br>d<br>d<br> </div>
                <div class="e display-none"> e<br>e<br>e<br>e<br>e<br>e<br>e<br>e<br> </div>
                <div class="f display-none"> f<br>f<br>f<br>f<br>f<br>f<br>f<br>f<br>f<br> </div>
                <div class="g display-none"> g<br>g<br>g<br>g<br>g<br>g<br>g<br>g<br>g<br>g<br> </div>
            </div>
        </div>
    </div>

</div>