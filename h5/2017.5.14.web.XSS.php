<div class="clear-both">
    <div class="st-title">-- Web安全 － XSS --</div>
    <pre>
        XSS 的攻击方式
            反射型
            存储型

            反射型：
                发出请求时，XSS代码出现在URL中，作为输入提交到服务器端，服务器端解析后响应，XSS代码随响应内容一起传回给浏览器，最后浏览器解析执行XSS代码。这个过程像一次反射，故叫反射型XSS。

                构建Node应用，演示反射型XSS攻击
                1.创建目录
                    mkdir /Applications/MAMP/htdocs/git_work/work/h5/xss
                2.使用express框架，作为web应用的架构
                    安装express:
                        npm init  //为你的应用创建一个 package.json 文件
                        npm install express --save //安装 Express 并将其保存到依赖列表中
                    Express 应用生成器:
                        sudo npm install express-generator -g  //快速创建一个应用的骨架

                    express -e ./    //在当前工作目录下创建应用骨架  | express myapp //在当前工作目录下创建一个命名为 myapp 的应用
                    npm install  //安装所有依赖包
                    npm start    //启动这个应用
                3.查看网站
                    http://localhost:3000/
                4.routes/index.js 接收xss
                    res.set('X_XSS_Protection',0); //不需要浏览器拦截XSS
                    res.render('index', { title: 'Express' , xss: req.query.xss });
                5.views/index.ejs 输出xss
                    <%- xss %>
                6.测试
                    http://localhost:3000/?xss=< img src="null" onerror="alert(1)" />        //自动触发
                    http://localhost:3000/?xss=< p src="null" onclick="alert(1)" />点我< /p>  //引诱触发
                    http://localhost:3000/?xss=< iframe src="//baidu.com/t.html"> < /iframe> //iframe
                －－－攻击成功－－－

            存储型：
                存储型XSS 和 反射型XSS 的差别 仅在于：提交的代码会存储在服务器端（数据库，内存，文件系统等），下次请求目标页面时不用在提交XSS代码。

        XSS 的防御
            编码：
                对用户输入的数据 进行 HTML Entity 编码
            过滤：
                移除用户上传的 DOM属性，如onerror等
                移除用户上传的Style节点。Script节点、Iframe节点等
            校正：
                避免直接对HTML Entity解码
                使用DOM Parse转换，校正不配对的DOM标签
    </pre>
</div>