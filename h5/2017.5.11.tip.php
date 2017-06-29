<div class="clear-both">
    <div class="st-title">-- 小技巧 判断 [ = | == | === ] --</div>
    <pre>
        if('id_str' === $(this).data('id')){
            'id_str' 写在判断的前面，可以规避 $(this).data('id')＝'id_str' 的无报错问题
        }
    </pre>
</div>

<div class="clear-both">
    <div class="st-title">-- 小技巧 步进边界判断 --</div>
    <pre>
        index--;
        if(index < 0){
            index=0;
        }
        -------优化写法：
        index = Math.max(0,--index);
        index = Math.min(length,++index);
    </pre>
</div>