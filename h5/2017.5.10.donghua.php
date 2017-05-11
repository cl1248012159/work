<div class="wrap">

    动画学习－3D动画效果

    <style type="text/css">
        #my3dspace{
            -webkit-perspective:800;
               -moz-perspective:800;
                -ms-perspective:800;
                 -o-perspective:800;
                    perspective:800;
            -webkit-perspective-origin:50% 50%;
               -moz-perspective-origin:50% 50%;
                -ms-perspective-origin:50% 50%;
                 -o-perspective-origin:50% 50%;
                    perspective-origin:50% 50%;
            overflow:hidden;
        }
        #pagegroup{
            position: relative;
            width:240px;height:240px;
            margin:0 auto;border:1px solid red;
            -webkit-transform-style:preserve-3d;
            -moz-transform-style:preserve-3d;
            -ms-transform-style:preserve-3d;
            -o-transform-style:preserve-3d;
            transform-style:preserve-3d;
        }
        .page{
            position: absolute;
            width:200px;height:200px;padding:20px;
            background:#000;color:#fff;
            font-size: 200px;line-height: 200px;font-weight: bold;text-align: center;
            -webkit-transform-origin:bottom;
            -webkit-transition:-webkit-transform 1s linear;
            -webkit-transform:rotateX(90deg);
        }
        #page1{
            -webkit-transform:rotateX(0deg);
        }
    </style>

    <script type="text/javascript">
        var currentIndex = 1;

        function next(){
            if(currentIndex==6){return;}
            document.getElementById("page"+currentIndex).style.webkitTransform="rotateX(-90deg)";
            currentIndex++;
            document.getElementById("page"+currentIndex).style.webkitTransform="rotateX(0deg)";
        }

        function prev(){
            if(currentIndex==1){return;}
            document.getElementById("page"+currentIndex).style.webkitTransform="rotateX(90deg)";
            currentIndex--;
            document.getElementById("page"+currentIndex).style.webkitTransform="rotateX(0deg)";
        }
    </script>
    
    <div id="my3dspace">
        <div id="pagegroup">
            <div class="page" id="page1">1</div>
            <div class="page" id="page2">2</div>
            <div class="page" id="page3">3</div>
            <div class="page" id="page4">4</div>
            <div class="page" id="page5">5</div>
            <div class="page" id="page6">6</div>
        </div>
    </div>

    <div id="op">
        <a href="javascript:prev();">previous</a>
        <a href="javascript:next();">next</a>
    </div>
</div>


    

    


    
