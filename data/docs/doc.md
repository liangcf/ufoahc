###这是文档
1、在config文件夹配置db.config.php；配置好数据库后到shell目录下

2、php命令方式执行ufoahc_db.php;如果中途没有失败，测试数据添加完毕

3、配置工作目录 工作目录为public目录

4、windows环境下双击`shell/webserver/start.bat`（linux环境运行`start.sh`）,然后打开浏览器访问：`http://localhost:8000/`
注：运行需要php环境


    ├─app 应用
    │   ├─src 后台的各个模块 后台代码等
    │       ├─indep 相对独立的模块
    │           ├─admin 后台模块
    │               ├─controller 控制器
    │               └─service 业务逻辑等
    │           ├─mobile 手机模块
    │               ├─controller
    │               └─service
    │           └─web 网页模块
    │               ├─controller
    │               └─service
    │       └─toge 共同应用到的
    │           ├─dao 共同操作的数据表
    │           ├─db 数据库链接
    │           └─utils 工具
    │   └─view 视图文件夹
    │       ├─indep 对应模块的视图
    │           ├─admin
    │           ├─mobile
    │           └─web
    │       ├─error 错误的页面
    │       └─layout 公共的顶部和底部
    │           ├─layout.admin.phtml 后台 admin
    │           ├─layout.mobile.phtml 手机
    │           └─layout.pc.phtml pc
    ├─config 配置文件夹
    │   ├─application.config.php 程序配置的文件
    │   └─run.config.php 数据库运行等配置文件
    ├─core 库
    ├─data 库
    │   ├─docs 文档脚本等文件夹
    │   └─logs 日志文件夹
    ├─public 工作目录
    │   └─index.php 入口文件
    ├─shell 后台命令执行的文件夹
    │   ├─lib 库
    │   ├─logs 日志
    │   ├─db_connect.php 测试数据库是否链接成功 
    │   └─ufoahc_db.php 在上一级的config文件夹内的db.config.php 数据库配置文件配置完毕启动php命令执行就可以测试使用
    ├─var 附加
    │   ├─cache 静态化页面的缓存
    └   └─error-page 错误提示页面

访问：
    http://xxxx:80/web/index/index

    注：http://xxxx:port/web/index/index
    
    0):端口
    1):web为模块名
    2):index为模块下的控制名称
    3):index(第二个index)为控制器名称的Action方法名称（除去Action）

