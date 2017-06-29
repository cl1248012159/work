<div class="clear-both">
    <div class="st-title">-- jQuery - $.extend() --</div>
    <pre>
        1.jQuery为开发插件提拱了两个方法，分别是： 
            jQuery.fn.extend(object); //给jQuery对象添加方法。
            jQuery.extend(object);    //为扩展jQuery类本身.为类添加新的方法。

        2.合并多个对象
            jQuery.extend(obj1,obj2,obj3,..) 

            案例1:
            var Css1={size: "10px",style: "oblique"} 
            var Css2={size: "12px",style: "oblique",weight: "bolder"} 
            $.extend(Css1,Css2) --->  {size: "12px",style: "oblique",weight: "bolder"} 

            //结果:Css1的size属性被覆盖,而且继承了Css2的weight属性

            案列2:
            jQuery.extend( 
                { name: "John", location: { city: "Boston" } }, 
                { last: "Resig", location: { state: "MA" } } 
            ); 
            // => { name: "John", last: "Resig", location: { state: "MA" } } 

            案列3:
            jQuery.extend( true, 
                { name: "John", location: { city: "Boston" } }, 
                { last: "Resig", location: { state: "MA" } } 
            ); 
            // => { name: "John", last: "Resig", location: { city: "Boston", state: "MA" } } 

        3.给jQuery添加静态方法
            $.extend({ 
                add:function(a,b){return a+b;}, 
                minus:function(a,b){return a-b}, 
                multiply:function(a,b){return a*b;}, 
                divide:function(a,b){return Math.floor(a/b);} 
            }); 
            var sum = $.add(3,5)+$.minus(3,5)+$.multiply(3,5)+$.divide(5,7); 
            console.log(sum); 
    </pre>
</div>