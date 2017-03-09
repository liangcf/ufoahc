###这是文档
1、在config文件夹配置db.config.php；配置好数据库后到shell目录下

2、php命令方式执行ufoahc_db.php;如果中途没有失败，测试数据添加完毕

3、配置工作目录 工作目录为public目录

4、windows环境下双击`shell/webserver/start.bat`（linux环境运行`start.sh`）,然后打开浏览器访问：`http://localhost:8000/`
注：运行需要php环境


    ├─app 应用
    │   ├─example 模块
    │       ├─src 后台业务
    │           ├─controller 控制器
    │           ├─dao 表对应的数据库
    │           ├─db 数据库读取配置
    │           ├─service 
    │           └─utils 工具
    │       └─view 视图文件夹
    │           ├─example 与模块名相同（小写）
    │               ├─index 域控制器名相同（小写，不要后缀）
    │                  └─index.phtml 域控制器Action对应的视图文件
    │           └─layout 公共的顶部和底部
    ├─config 配置文件夹
    │   ├─application.config.php 程序配置的文件
    │   └─run.config.php 数据库运行等配置文件
    ├─core 库
    ├─data 库
    │   ├─logs 日志文件夹
    │   ├─sub 附加的
    │   └─var 附加的错误页面等
    ├─public 工作目录
    │   └─index.php 入口文件
    ├─shell 后台命令执行的文件夹
    │   ├─lib 库
    │   ├─webserver 测试脚本存放文件夹
    │   ├─db_connect.php 测试数据库是否链接成功 
    └   └─ufoahc_db.php 在上一级的config文件夹内的db.config.php 数据库配置文件配置完毕启动php命令执行就可以测试使用
   

访问：
    http://xxxx:80/example/index/index

    注：http://xxxx:port/example/index/index
    
    0):端口
    1):example为模块名
    2):index为模块下的控制名称
    3):index(第二个index)为控制器名称的Action方法名称（除去Action）

