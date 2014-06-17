net_info_publisher-SE_1_5
=========================

修改日志
-------------------------
> June 2, XWX 创建项目，并作适当css，页面的添加
> 
> June 9, XWX 基本完成 根据股票代码查询外数据库 功能
> 
> June 15 WJN 提交用户部分与充值部分
> 
> June 16, WCY 提交动态刷新，button在切换时改变的功能。
> 

User 说明
-------------------------
> View划分：
> > view文件夹下：html_header.php和html_footer.php,补全页面的html结构

> > view/header文件夹下：
> > > visiter_header.php:  未登录用户的顶部导航

> > > user_header.php:     已登录用户的顶部导航

> > view/user文件夹下：user部分相关页面

> > view/recharge文件夹下：用户充值部分相关界面

###########
> Controllers 
> 注：是不是没办法在控制器里直接交给另一个控制器处理？
> > user:
> > > login:  登录界面。会先判断是否已登录，如已登录则自动跳转到主页（未写载入哪个界面）

> > > register: 用户注册

> > > logout: 登出

> > > passwordforget: 忘记密码

> > > reset:  密码重置（需要以get方式提交特定token;链接通过邮件发给用户）

> > > message:  用户信息页

> > > searchlog:  显示"搜索记录"（需要根据实际搜索记录储存的数据表结构再进行调整）

> > > storelog: 显示"收藏记录"（需要根据实际收藏记录储存的数据表结构再进行调整）

> > recharge:
> > > index: 充值界面

> > > log: 充值记录

> > init
> > > index: 初始化（创建数据库）

###########
> libraries:

> > usermanager:
> > >if_login(): 判断是否登录；如果已登录，返回用户id，未登录返回FALSE

> > >keeplink(): 更新用户最后活动时间（存放用来判断用户是否登录的token的表里有一个字段存放用户最后活动时间，可通过这个辅助判断token是否已经失效）


##########
> models
> > userpermissionmodule
> > > check() : 判断用户是否拥有权限（是否已充值并有余额），若有余额，返回TRUE，否则返回FALSE


分工
-------------------------

### WJN：</h2><br/>
> 登录界面
> > 登陆
> > 
> > 注册
> > 
> > 忘记密码

> 主界面
> > 个人信息修改
> > 
> > 修改密码
> > 
> > 历史搜索记录查询
> > 
> > 用户收藏

> 充值及记录查询（充值写另一个controller)
> 
> 退出
> 
> 登陆session
> 
> 用户权限验证

-------------------------
### XWX，WCY：</h2><br/>
> 模糊search
> 
> 信息显示
> > 研究 highcharts， 并画出不同时段的曲线，K线...
> 
> 联系别的组，获取API，并做自己的信息处理
> > 根据股票代码查询metadata（XWX完成）
> > 
> > 根据股票名字查询metadata 
> 
> ajax 5s 刷新子模块价格

-------------------------
